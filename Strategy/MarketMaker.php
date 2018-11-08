<?php

require_once 'config/BittrexProperties.php';
require_once 'Bittrex/BittrexHelper.php';
require_once 'Bittrex/BittrexTicker.php';
require_once 'Strategy/MarketMaker.php';
require_once 'Utils/CoinMarketCap.php';
require_once 'Utils/Logger.php';
require_once 'Utils/OrderBook.php';
require_once 'Utils/SmallestSpread.php';

require_once "Utils/JsonBase.php";

Class MarketMaker extends JsonBase{
    
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
    
    public function expose() {
        return get_object_vars($this);
    }
    
    function __construct(Array $args){
        $this->limit                = (isset($args['limit']))               ? $args['limit']            : null;
        $this->limitStart           = (isset($args['limitStart']))          ? $args['limitStart']       : null;
        $this->aggression           = (isset($args['aggression']))          ? $args['aggression']       : null;
        $this->spreadMin            = (isset($args['spreadMin']))           ? $args['spreadMin']        : null;
        $this->spreadMax            = (isset($args['spreadMax']))           ? $args['spreadMax']        : null;
        $this->excludeCoins         = (isset($args['excludeCoins']))        ? $args['excludeCoins']     : array();
        $this->minUSDCost           = (isset($args['minUSDCost']))          ? $args['minUSDCost']       : null;
        $this->maxUSDCost           = (isset($args['maxUSDCost']))          ? $args['maxUSDCost']       : null;
        $this->percentChangeMax     = (isset($args['percentChangeMax']))    ? $args['percentChangeMax'] : null;
        $this->percentChangeMin     = (isset($args['percentChangeMin']))    ? $args['percentChangeMin'] : null;
            
    }
    
    public function run() {
        
        $bittrexProp    = new BittrexProperties();
        $bittrexHelper  = new BittrexHelper();
        $bittrexTicker  = new BittrexTicker();
        $smallestSpread = new SmallestSpread();
        $coinMarketCap  = new CoinMarketCap($this->limit, $this->limitStart, 'BTC');
        
//         echo "<pre>";
//         echo '$coinMarketCap data: <br/>';
//         echo $coinMarketCap->toJSON();
//         echo "</pre>";
        
        
        $balance_BTC        = $bittrexHelper->getBittrexBalance($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexBalanceBTCURL());
        foreach($coinMarketCap->getFgcData() as $data) {
            $coinMarketCap->setFgcDataQuotes($data['quotes']);
            $coinMarketCap->setFgcDataQuotesBTC($coinMarketCap->getFgcDataQuotes()['BTC']);
            $coinMarketCap->setFgcDataQuotesUSD($coinMarketCap->getFgcDataQuotes()['USD']);
            $coinMarketCap->setFgcDataQuotesUSDPercentChange7Day($coinMarketCap->getFgcDataQuotesUSD()["percent_change_7d"]);
            
            // only trade on coin with last 7 day percent change are in the specified range
            if($coinMarketCap->getFgcDataQuotesUSDPercentChange7Day() > $this->percentChangeMin && 
                $coinMarketCap->getFgcDataQuotesUSDPercentChange7Day() < $this->percentChangeMax){
                
                $symbol             = $data['symbol'];
                $market             = 'BTC-' .$symbol;
                $cost_USD           = number_format($coinMarketCap->getFgcDataQuotesUSD()["price"], 8);
                $cost_BTC           = number_format($coinMarketCap->getFgcDataQuotesBTC()["price"], 8);
//                 $fifthBal           = number_format(($balance_BTC / 5), 8);
//                 $amountToBuy        = number_format(($fifthBal / $cost_BTC), 8);
                
                $bittrexTicker = $bittrexHelper->getBittrexTicker($bittrexProp->getBittrexTickerURL(), $market);
                
                
                // do not trade anything higher or lower than the price min and max or are in the exclusion array
                if(($cost_USD > $this->minUSDCost && $cost_USD < $this->maxUSDCost )|| 
                    array_search($symbol,$this->excludeCoins)  || 
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
                
            }
        }
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