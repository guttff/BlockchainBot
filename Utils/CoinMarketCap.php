<?php
// namespace CoinMarketCap;

// use JsonBase;
use config\CoinMarketCapProperties;

require_once "Model/JsonBase.php";
require_once "config/CoinMarketCapProperties.php";

class CoinMarketCap extends JsonBase
{
    private $coinMarketCapProperties;
    private $tickerURL;
    private $btcURL;
    private $fgcBTC;
    private $fgcDataBTC;
    private $limit;
    private $limitStart;
    private $currency;
    private $fgc;
    private $fgcData;
    private $fgcDataQuotes;
    private $fgcDataQuotesUSD;
    private $fgcDataQuotesBTC;
    private $fgcDataQuotesUSDPercentChange7Day;
    
    function __construct($limit, $limitStart='', $currency = 'BTC'){
        $this->coinMarketCapProperties = new CoinMarketCapProperties();
        $this->limit        = $limit;
        $this->limitStart   = $limitStart;
        $this->currency     = $currency;
        $this->btcURL       = $this->coinMarketCapProperties->getCmc_BTC_URL()."&symbol=BTC&convert=USD";
        $this->fgcBTC       = json_decode(file_get_contents($this->btcURL), true);
        $this->fgcDataBTC   = $this->fgcBTC['data'];
        $this->tickerURL    = ($limitStart != '') ? $this->coinMarketCapProperties->getCmc_listings_URL()."&start=".$limitStart."&limit=".$limit."&convert=".$currency 
                                                  : $this->coinMarketCapProperties->getCmc_listings_URL()."&limit=".$limit."&convert=".$currency;
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
     * @return string
     */
    public function getBtcURL()
    {
        return $this->btcURL;
    }

    /**
     * @return mixed
     */
    public function getFgcBTC()
    {
        return $this->fgcBTC;
    }

    /**
     * @return mixed
     */
    public function getFgcDataBTC()
    {
        return $this->fgcDataBTC;
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
    /**
     * @return mixed
     */
    public function getFgcDataQuotesUSDPercentChange7Day()
    {
        return $this->fgcDataQuotesUSDPercentChange7Day;
    }

    /**
     * @param mixed $fgcDataQuotesUSDPercentChange7Day
     */
    public function setFgcDataQuotesUSDPercentChange7Day($fgcDataQuotesUSDPercentChange7Day)
    {
        $this->fgcDataQuotesUSDPercentChange7Day = $fgcDataQuotesUSDPercentChange7Day;
    }


    
    
}

