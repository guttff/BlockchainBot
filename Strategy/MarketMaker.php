<?php

namespace Strategy;
 


use Exchange\Bittrex\BittrexHelper;
use Exchange\Bittrex\BittrexTicker;
use Factory\CompareFactory;
use Factory\MarketHistoryContainerFactory;
use Factory\MarketHistoryFactory;
use Factory\MovingAverageContainerFactory;
use Factory\OrderBookFactory;
use Factory\OrderBookContainerFactory;
use Interfaces\Strategy;
use Model\JsonBase;
use Model\JsonParser;
use Model\Spread;
use Utils\CoinMarketCap;
use config\BittrexProperties;




// require_once 'config/BittrexProperties.php';
// require_once 'Exchange/Bittrex/BittrexHelper.php';
// require_once 'Exchange/Bittrex/BittrexTicker.php';
// require_once 'Factory/OrderBookFactory.php';
// require_once 'Factory/OrderBooksFactory.php';
// require_once 'Interfaces/Strategy.php';
// require_once "Model/JsonBase.php";
// require_once "Model/JsonParser.php";
// require_once 'Model/OrderBook.php';
// require_once 'Model/Spread.php';
// require_once 'ModelContainer/OrderBooks.php';
// require_once 'Utils/CoinMarketCap.php';
// require_once 'Utils/Logger.php';
// require_once "UtilsHelpers/MarketHistoryContainer.php";
// require_once 'Strategy/MarketMaker.php';
// require_once 'Tools/Compare.php';

Class MarketMaker extends JsonBase implements Strategy{
    
    private $limit;
    private $limitStart;
    private $aggression;
    private $spreadMin;
    private $spreadMax;
    private $excludeCoins;
    private $minUSDCost;
    private $maxUSDCost;
    private $percentChangeMax;
    private $percentChangeMin;
    private $profitUSDAmount;
    private $profitBTCAmount;
    private $profitPercent;
    
    private $upTime;
    private $startTime; // date()
    private $name;
    private $startingBalanceUSD;
    private $currentBalanceUSD;
    private $currentBalanceBTC;
    
    private $coinsToTrade = Array();
    
    private $coinsInBuyOrderList = Array();     // ['BTC-XRP', 'BTC-XLM']
    private $coinsInSellOrderList = Array();    // ['BTC-XRP', 'BTC-XLM']
    private $buyOrderList = Array();            // an array of buy order coin list
    private $sellOrderList = Array();           // an array of sell order coin list
    private $pendingBuyOrderList = Array();     // an array of open buy order
    private $pendingSellOrderList = Array();    // an array of open sell order
    
    public function expose() {
        return get_object_vars($this);
    }
    
    function __construct(Array $args){
        $this->limit                = (array_key_exists('limit', $args))               ? $args['limit']                         : null;
        $this->limitStart           = (array_key_exists('limitStart', $args))          ? $args['limitStart']                    : null;
        $this->aggression           = (array_key_exists('aggression', $args))          ? $args['aggression']                    : null;
        $this->spreadMin            = (array_key_exists('spreadMin', $args))           ? $args['spreadMin']                     : null;
        $this->spreadMax            = (array_key_exists('spreadMax', $args))           ? $args['spreadMax']                     : null;
        $this->excludeCoins         = (array_key_exists('excludecoins', $args))        ? $args['excludecoins']                  : array();
        $this->minUSDCost           = (array_key_exists('minUSDCost', $args))          ? number_format($args['minUSDCost'],8)   : null;
        $this->maxUSDCost           = (array_key_exists('maxUSDCost', $args))          ? number_format($args['maxUSDCost'],8)   : null;
        $this->percentChangeMax     = (array_key_exists('percentChangeMax', $args))    ? $args['percentChangeMax']              : null;
        $this->percentChangeMin     = (array_key_exists('percentChangeMin', $args))    ? $args['percentChangeMin']              : null;
        
    }
    
    public function run() {
        
        $compare        = CompareFactory::create();
        $movingAverages = MovingAverageContainerFactory::create();
        $bittrexProp    = new BittrexProperties();
        $bittrexHelper  = new BittrexHelper();
        $bittrexTicker  = new BittrexTicker();
        $smallestSpread = new Spread();
        $orderBooks     = OrderBookContainerFactory::create();
        $marketHistories = MarketHistoryContainerFactory::create();
        $coinMarketCap  = new CoinMarketCap($this->limit, $this->limitStart, 'USD');
        
//         echo "<pre>";
//         echo '$coinMarketCap data: <br/>';
//         echo $coinMarketCap->toJSON();
//         echo "</pre>";
        
        $balance_BTC        = $bittrexHelper->getBittrexBalance($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexBalanceBTCURL());
//         $balance_USD        = null;
        
        foreach($coinMarketCap->getFgcData() as $data) {
            $coinMarketCap->setFgcDataQuotes($data['quote']);
//             $coinMarketCap->setFgcDataQuotesBTC($coinMarketCap->getFgcDataQuotes()['BTC']);
            $coinMarketCap->setFgcDataQuotesUSD($coinMarketCap->getFgcDataQuotes()['USD']);
            $coinMarketCap->setFgcDataQuotesUSDPercentChange7Day($coinMarketCap->getFgcDataQuotesUSD()["percent_change_7d"]);
            
            // only trade on coin with last 7 day percent change are in the specified range
            if(($coinMarketCap->getFgcDataQuotesUSDPercentChange7Day() > $this->percentChangeMin && 
                $coinMarketCap->getFgcDataQuotesUSDPercentChange7Day() < $this->percentChangeMax)){
                
                $symbol             = $data['symbol'];
                $market             = 'BTC-' .$symbol;
                $cost_USD           = number_format($coinMarketCap->getFgcDataQuotesUSD()["price"], 8);
                $cost_BTC           = number_format($coinMarketCap->getFgcDataQuotesBTC()["price"], 8);
//                 $fifthBal           = number_format(($balance_BTC / 5), 8);
//                 $amountToBuy        = number_format(($fifthBal / $cost_BTC), 8);
                
                $bittrexTicker = $bittrexHelper->getBittrexTicker($bittrexProp->getBittrexTickerURL(), $market);
                
             
                
                // do not trade anything higher or lower than the price min and max or are in the exclusion array
                if(!($compare->isGreatherOrEqual($cost_USD, $this->minUSDCost) && 
                    $compare->isLessOrEqual($cost_USD, $this->maxUSDCost) )      || 
                    (array_search($symbol,$this->excludeCoins) !== false)        || 
                    $bittrexTicker->getBid() == null)
                    continue;
                  
                    
                // the lower the spread the higher the volume
                $spreadPercent = $this->getSpreadPercent($bittrexTicker->getBid(), $bittrexTicker->getAsk(), $bittrexTicker->getLast());
                
                // store smallest spread data
                if($smallestSpread->getSpreadPercent() == null ||
                    $smallestSpread->getSpreadPercent() > $spreadPercent){
                        $smallestSpread->setSpreadPercent($spreadPercent);
                        $smallestSpread->setCost_BTC($cost_BTC);
                        $smallestSpread->setCost_USD($cost_USD);
                        $smallestSpread->setMarket($market);
                        $smallestSpread->setSymbol($symbol);
                }
                
                echo "<br/>";
                echo '$symbol : '       . $symbol       . "<br/>";
                echo '$market : '       . $market       . "<br/>";
                echo '$balance_BTC : '  . $balance_BTC  . "<br/>";
                echo '$cost_BTC : '     . $cost_BTC     . "<br/>";
                echo '$cost_USD : '     . $cost_USD     . "<br/>";
                echo "<br/>";
                
                echo "<pre>";
                echo '$bittrexTicker for market :' .$market . '<br/>';
                echo $bittrexTicker->toJSON();
                echo "<br/>";
                echo 'spread percent :' . $spreadPercent .' % <br/>';
                echo "</pre>";
                
                
                $buyOrderBook = $bittrexHelper->getBittrexOrderBook($bittrexProp->getBittrexOrderBookURL(), $market, 'buy');
                
                $ob = OrderBookFactory::create();
                $ob->build($buyOrderBook);
                $ob->setMarket($market);
                $ob->setType('buy');
                
                $orderBooks->add($ob);
                
                
                
                $marketHistory = $bittrexHelper->getBittrexMarketHistory($bittrexProp->getBittrexMarketHistoryURL(), $market);
                
//                 echo var_dump($marketHistory);
                
                $mh = MarketHistoryFactory::create();
                $mh->setMarket($market);
                $mh->build($marketHistory);
                
                $marketHistories->add($mh);
                
                echo "<br/>";
                
                echo "<pre>";
                echo '$buyOrderBook Mean for market :' .$market . '<br/>';
                echo $ob->getOrderBookMean()->toJSON();
                echo "<br/>";
                echo '$buyOrderBook median for market :' .$market . '<br/>';
                echo $ob->getOrderBookMedian()->toJSON();
                echo "<br/>";
                
//                 echo var_dump($marketHistoryContainer->getMarketHistory());
//                 echo json_encode($marketHistoryContainer->getMarketHistory(),JSON_PRETTY_PRINT);
//                 echo $marketHistoryContainer->toJSON();
                
                
//                 echo '$marketHistoryContainer getMarketHistories for market :' .$market . '<br/>';
//                 echo JsonParser::toJSON($marketHistoryContainer->getMarketHistories());
//                 echo "<br/>";
                echo '$marketHistory Mean for market :' .$market . '<br/>';
                echo $mh->getMarketHistoryMean()->toJSON();
                echo "<br/>";
                echo '$marketHistory median for market :' .$market . '<br/>';
                echo $mh->getMarketHistoryMedian()->toJSON();
                echo "<br/>";
                echo '$marketHistory minimum for market :' .$market . '<br/>';
                echo $mh->getMarketHistoryMinimum()->toJSON();
                echo "<br/>";
                echo '$marketHistory maximum for market :' .$market . '<br/>';
                echo $mh->getMarketHistoryMaximum()->toJSON();
                echo "<br/>";
                echo "-------------------------------------------------------";
                echo "-------------------------------------------------------";
                echo "</pre>";
                
                
            }
        }
    }
    
    
    
    
    
    /**
     * @return $limit
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return @limitStart
     */
    public function getLimitStart()
    {
        return $this->limitStart;
    }

    /**
     * @param @limitStart
     */
    public function setLimitStart($limitStart)
    {
        $this->limitStart = $limitStart;
    }

    /**
     * @return $aggression
     */
    public function getAggression()
    {
        return $this->aggression;
    }

    /**
     * @param $aggression
     */
    public function setAggression($aggression)
    {
        $this->aggression = $aggression;
    }

    /**
     * @return $spreadMin
     */
    public function getSpreadMin()
    {
        return $this->spreadMin;
    }

    /**
     * @param $spreadMin
     */
    public function setSpreadMin($spreadMin)
    {
        $this->spreadMin = $spreadMin;
    }

    /**
     * @return $spreadMax
     */
    public function getSpreadMax()
    {
        return $this->spreadMax;
    }

    /**
     * @param $spreadMax
     */
    public function setSpreadMax($spreadMax)
    {
        $this->spreadMax = $spreadMax;
    }

    /**
     * @return $excludeCoins
     */
    public function getExcludeCoins()
    {
        return $this->excludeCoins;
    }

    /**
     * @param $excludeCoins
     */
    public function setExcludeCoins($excludeCoins)
    {
        $this->excludeCoins = $excludeCoins;
    }

    /**
     * @return $minUSDCost
     */
    public function getMinUSDCost()
    {
        return $this->minUSDCost;
    }

    /**
     * @param $minUSDCost
     */
    public function setMinUSDCost($minUSDCost)
    {
        $this->minUSDCost = $minUSDCost;
    }

    /**
     * @return $maxUSDCost
     */
    public function getMaxUSDCost()
    {
        return $this->maxUSDCost;
    }

    /**
     * @param $maxUSDCost
     */
    public function setMaxUSDCost($maxUSDCost)
    {
        $this->maxUSDCost = $maxUSDCost;
    }

    /**
     * @return $percentChangeMax
     */
    public function getPercentChangeMax()
    {
        return $this->percentChangeMax;
    }

    /**
     * @param $percentChangeMax
     */
    public function setPercentChangeMax($percentChangeMax)
    {
        $this->percentChangeMax = $percentChangeMax;
    }

    /**
     * @return $percentChangeMin
     */
    public function getPercentChangeMin()
    {
        return $this->percentChangeMin;
    }

    /**
     * @param $percentChangeMin
     */
    public function setPercentChangeMin($percentChangeMin)
    {
        $this->percentChangeMin = $percentChangeMin;
    }

    /**
     * @return $profitUSDAmount
     */
    public function getProfitUSDAmount()
    {
        return $this->profitUSDAmount;
    }

    /**
     * @param $profitUSDAmount
     */
    public function setProfitUSDAmount($profitUSDAmount)
    {
        $this->profitUSDAmount = $profitUSDAmount;
    }

    /**
     * @return $profitBTCAmount
     */
    public function getProfitBTCAmount()
    {
        return $this->profitBTCAmount;
    }

    /**
     * @param $profitBTCAmount
     */
    public function setProfitBTCAmount($profitBTCAmount)
    {
        $this->profitBTCAmount = $profitBTCAmount;
    }

    /**
     * @return $profitPercent
     */
    public function getProfitPercent()
    {
        return $this->profitPercent;
    }

    /**
     * @param $profitPercent
     */
    public function setProfitPercent($profitPercent)
    {
        $this->profitPercent = $profitPercent;
    }

    /**
     * @return $upTime
     */
    public function getUpTime()
    {
        return $this->upTime;
    }

    /**
     * @param $upTime
     */
    public function setUpTime($upTime)
    {
        $this->upTime = $upTime;
    }

    /**
     * @return $startTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return $startingBalanceUSD
     */
    public function getStartingBalanceUSD()
    {
        return $this->startingBalanceUSD;
    }

    /**
     * @param $startingBalanceUSD
     */
    public function setStartingBalanceUSD($startingBalanceUSD)
    {
        $this->startingBalanceUSD = $startingBalanceUSD;
    }

    /**
     * @return $currentBalanceUSD
     */
    public function getCurrentBalanceUSD()
    {
        return $this->currentBalanceUSD;
    }

    /**
     * @param $currentBalanceUSD
     */
    public function setCurrentBalanceUSD($currentBalanceUSD)
    {
        $this->currentBalanceUSD = $currentBalanceUSD;
    }

    /**
     * @return $currentBalanceBTC
     */
    public function getCurrentBalanceBTC()
    {
        return $this->currentBalanceBTC;
    }

    /**
     * @param $currentBalanceBTC
     */
    public function setCurrentBalanceBTC($currentBalanceBTC)
    {
        $this->currentBalanceBTC = $currentBalanceBTC;
    }

    /**
     * @return $coinsToTrade:
     */
    public function getCoinsToTrade()
    {
        return $this->coinsToTrade;
    }

    /**
     * @param $coinsToTrade
     */
    public function setCoinsToTrade($coinsToTrade)
    {
        $this->coinsToTrade = $coinsToTrade;
    }

    /**
     * @return $coinsInBuyOrderList
     */
    public function getCoinsInBuyOrderList()
    {
        return $this->coinsInBuyOrderList;
    }

    /**
     * @param $coinsInBuyOrderList
     */
    public function setCoinsInBuyOrderList($coinsInBuyOrderList)
    {
        $this->coinsInBuyOrderList = $coinsInBuyOrderList;
    }

    /**
     * @return $coinsInSellOrderList
     */
    public function getCoinsInSellOrderList()
    {
        return $this->coinsInSellOrderList;
    }

    /**
     * @param $coinsInSellOrderList
     */
    public function setCoinsInSellOrderList($coinsInSellOrderList)
    {
        $this->coinsInSellOrderList = $coinsInSellOrderList;
    }

    /**
     * @return $buyOrderList
     */
    public function getBuyOrderList()
    {
        return $this->buyOrderList;
    }

    /**
     * @param $buyOrderList
     */
    public function setBuyOrderList($buyOrderList)
    {
        $this->buyOrderList = $buyOrderList;
    }

    /**
     * @return $sellOrderList
     */
    public function getSellOrderList()
    {
        return $this->sellOrderList;
    }

    /**
     * @param $sellOrderList
     */
    public function setSellOrderList($sellOrderList)
    {
        $this->sellOrderList = $sellOrderList;
    }

    /**
     * @return $pendingBuyOrderList
     */
    public function getPendingBuyOrderList()
    {
        return $this->pendingBuyOrderList;
    }

    /**
     * @param $pendingBuyOrderList
     */
    public function setPendingBuyOrderList($pendingBuyOrderList)
    {
        $this->pendingBuyOrderList = $pendingBuyOrderList;
    }

    /**
     * @return $pendingSellOrderList
     */
    public function getPendingSellOrderList()
    {
        return $this->pendingSellOrderList;
    }

    /**
     * @param $pendingSellOrderList
     */
    public function setPendingSellOrderList($pendingSellOrderList)
    {
        $this->pendingSellOrderList = $pendingSellOrderList;
    }

    function isUpTrend($marketHistory){
        $isUpTrend = false;
        
        return $isUpTrend;
    }
    
    function getSpreadPercent($bid, $ask, $price){
        return number_format((abs($bid - $ask)/$price),4);
    }
}
?>