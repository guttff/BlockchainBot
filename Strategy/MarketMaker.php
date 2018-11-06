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
    
    public function expose() {
        return get_object_vars($this);
    }
    
    function __construct(Array $args){
        $this->limit        = (isset($args['limit']))           ? $args['limit']            : null;
        $this->limitStart   = (isset($args['limitStart']))      ? $args['limitStart']       : null;
        $this->aggression   = (isset($args['aggression']))      ? $args['aggression']       : null;
        $this->spreadMin    = (isset($args['spreadMin']))       ? $args['spreadMin']        : null;
        $this->spreadMax    = (isset($args['spreadMax']))       ? $args['spreadMax']        : null;
        $this->excludeCoins = (isset($args['excludeCoins']))    ? $args['excludeCoins']     : array();
        $this->minUSDCost   = (isset($args['minUSDCost']))      ? $args['minUSDCost']       : null;
        $this->maxUSDCost   = (isset($args['maxUSDCost']))      ? $args['maxUSDCost']       : null;
            
    }
    
    public function run() {
        
        $bittrexProp    = new BittrexProperties();
        $bittrexHelper  = new BittrexHelper();
        $coinMarketCap  = new CoinMarketCap($this->limit, $this->limitStart, 'BTC');
        
        echo "<pre>";
        echo '$coinMarketCap data: <br/>';
        echo $coinMarketCap->toJSON();
        echo "</pre>";
        
        
        $balance_BTC        = $bittrexHelper->getBittrexBalance($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexBalanceBTCURL());
        foreach($coinMarketCap->getFgcData() as $data) {
            $coinMarketCap->setFgcDataQuotes($data['quotes']);
            $coinMarketCap->setFgcDataQuotesBTC($coinMarketCap->getFgcDataQuotes()['BTC']);
            $coinMarketCap->setFgcDataQuotesUSD($coinMarketCap->getFgcDataQuotes()['USD']);
            
            
            
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