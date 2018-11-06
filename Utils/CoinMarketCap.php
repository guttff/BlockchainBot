<?php
// namespace CoinMarketCap;

// use JsonBase;
require_once "Utils/JsonBase.php";

class CoinMarketCap extends JsonBase
{
    private $tickerURL;
    private $limit;
    private $limitStart;
    private $currency;
    private $fgc;
    private $fgcData;
    private $fgcDataQuotes;
    private $fgcDataQuotesUSD;
    private $fgcDataQuotesBTC;
    
    function __construct($limit, $limitStart='', $currency = 'BTC'){
        $this->limit        = $limit;
        $this->limitStart   = $limitStart;
        $this->currency     = $currency;
        $this->tickerURL    = ($limitStart != '') ? "https://api.coinmarketcap.com/v2/ticker/?start=".$limitStart."&limit=".$limit."&convert=".$currency 
                                                  : "https://api.coinmarketcap.com/v2/ticker/?limit=".$limit."&convert=".$currency;
        $this->fgc          = json_decode(file_get_contents($this->tickerURL), true);
        $this->fgcData      = $this->fgc['data'];
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    /**
     * @return string
     */
    public function getTickerURL()
    {
        return $this->tickerURL;
    }

    /**
     * @param string $tickerURL
     */
    public function setTickerURL($tickerURL)
    {
        $this->tickerURL = $tickerURL;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    public function getLimitStart()
    {
        return $this->limitStart;
    }

    /**
     * @param string $limitStart
     */
    public function setLimitStart($limitStart)
    {
        $this->limitStart = $limitStart;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getFgc()
    {
        return $this->fgc;
    }

    /**
     * @param mixed $fgc
     */
    public function setFgc($fgc)
    {
        $this->fgc = $fgc;
    }

    /**
     * @return mixed
     */
    public function getFgcData()
    {
        return $this->fgcData;
    }

    /**
     * @param mixed $fgcData
     */
    public function setFgcData($fgcData)
    {
        $this->fgcData = $fgcData;
    }

    /**
     * @return mixed
     */
    public function getFgcDataQuotes()
    {
        return $this->fgcDataQuotes;
    }

    /**
     * @param mixed $fgcDataQuotes
     */
    public function setFgcDataQuotes($fgcDataQuotes)
    {
        $this->fgcDataQuotes = $fgcDataQuotes;
    }

    /**
     * @return mixed
     */
    public function getFgcDataQuotesUSD()
    {
        return $this->fgcDataQuotesUSD;
    }

    /**
     * @param mixed $fgcDataQuotesUSD
     */
    public function setFgcDataQuotesUSD($fgcDataQuotesUSD)
    {
        $this->fgcDataQuotesUSD = $fgcDataQuotesUSD;
    }

    /**
     * @return mixed
     */
    public function getFgcDataQuotesBTC()
    {
        return $this->fgcDataQuotesBTC;
    }

    /**
     * @param mixed $fgcDataQuotesBTC
     */
    public function setFgcDataQuotesBTC($fgcDataQuotesBTC)
    {
        $this->fgcDataQuotesBTC = $fgcDataQuotesBTC;
    }

    
    
}

