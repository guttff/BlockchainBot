# BlockchainBot

BaseOrder = {
		rate 		: 0.0123,
		quantity 	: 300
	}
	
OrderBook = [
				{
					rate 		: 0.0123,
					quantity 	: 300
				},
				{
					rate 		: 0.0123,
					quantity 	: 300
				}
			]
			
SmallestSpread = {
			spreadPercent 	: 0.001,
			market			: "BTC-XRP",
			symbol			: "XRP",
			cost_USD		: 0.45,
			cost_BTC		: 0.00007319
		}	


marketHistory = {
			"Id" : 319435,
			"TimeStamp" : "2014-07-09T03:21:20.08",
			"Quantity" : 0.30802438,
			"Price" : 0.01263400,
			"Total" : 0.00389158,
			"FillType" : "FILL",
			"OrderType" : "BUY"
		}


# -------------------------------
#	getTicker()
#	getTrend()
#	isUpTrend()
#	isDownTrend()
#	getVolume()
#	isHighVolume()
#	getAverageBuyOrder()
#	getAverageSellOrder()
#	getBuyOrderWall()
#	getSellOrderWall()

# 	getSimpleMovingAverage()
#	getExponentialMovingAverage()

#	-------------------------------

#	SMA = simple moving average
#	SMA = mean of values over time period
# 	For example, to calculate a basic 10-day moving average 
#	you would add up the closing prices from the past 10 days
# 	and then divide the result by 10.

#	EMA = (P * a) + (previous EMA * (1-a))
#	P = current price
#	a = smoothing factor = 2 / (1 + N)
# 	N = number of time periods
#	use SMA when previous EMA is unknown

#	-------------------------------


public static void main(String[] args){

	botManagerThread(); // spin up new bot singleton
	buildCoinToTradeThread();
	buyCoinToTradeThread();
	sellCoinToTradeThread();

}

#	-------------------------------

class JsonParser
{
    public static function expose($obj) {
        return get_object_vars($obj);
    }
    
    public static function toJSON($obj){
        return json_encode($obj, JSON_PRETTY_PRINT);
    }
}

#	-------------------------------

class JsonBase
{
    public function toJSON(){
        return json_encode($this->expose(), JSON_PRETTY_PRINT);
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
}

#	-------------------------------


class botManagerThread() extends JsonBase{

	private $totalProfitUSD		= 0;
	private $profitPercent		= 0;
	private $startingBalanceUSD	= 0;
	private $currentBalanceUSD	= 0;
	private $upTime				= 0;
	private $totalDeficitUSD	= 0;
	private $startTime			= now();
	private $botsArray      	= Array();
	private $profitBotsArray  	= Array();
	private $deficitBotsArray  	= Array();
	private $coinsToTradeArray 	= Array();
}


#	-------------------------------

Inteface strategy{

	public function run();
}

#	-------------------------------


class Bot extends JsonBase implements Strategy{


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
	private $startTime;
	private $name;
	private $startingBalanceUSD;
	private $currentBalanceUSD;
	private $currentBalanceBTC;
	
    private $coinsToTrade = Array(); // ['BTC-XRP', 'BTC-XLM']
    private $coinsInBuyOrderList = Array(); // ['BTC-XRP', 'BTC-XLM']
    private $coinsInSellOrderList = Array(); // ['BTC-XRP', 'BTC-XLM']
    private $buyOrderList = Array(); // an array of buy order coin list
    private $sellOrderList = Array(); // an array of sell order coin list
    private $pendingBuyOrderList = Array(); // an array of open buy order
    private $pendingSellOrderList = Array(); // an array of open sell order
    
	

}

#	-------------------------------

class BaseOrder extends JsonBase{

	public $rate;
	public $quantity;
	
}


#	-------------------------------

class Order extends BaseOrder{

	private $market;
	private $time;
	private $fillType; 	// partial || Full
	private $OrderType;		// buy || sell
	private $filledAmount;
	
}

#	-------------------------------

class MovingAverage extends JsonBase{


    #	SMA = simple moving average
    #	SMA = mean of values over time period
    # 	For example, to calculate a basic 10-day moving average
    #	you would add up the closing prices from the past 10 days
    # 	and then divide the result by 10.
    
    #	EMA = (P * a) + (previous EMA * (1-a))
    #	P = current price
    #	a = smoothing factor = 2 / (1 + N)
    # 	N = number of time periods
    #	use SMA when previous EMA is unknown
    
    private $SMA;
    private $EMA;
    private $previousEMA;
    private $N_timePeriods;
    private $a_smoothingfactor;
    private $P_currPrice;
    private $marketHistory;
    private $runningTotal;
    
 	getSimpleMovingAverage()
	getExponentialMovingAverage()

}

#	-------------------------------


public static void main(String[] args){
	$order = new Order();
	$order->getQuantity();
	
	// get Ticker - list of coins
	
		// get coin market cap ticker
		
		$coinMarketCap = new CoinMarketCap(market, limit);
		
		// get smallest spread
	
	// get buy order book
	
	// get sell order book
	
	// get trend
	
	// buy on early uptrend
		
		//log transaction
			
	// sell at 10% of the trend
	
		//log transaction
		
	// rinse and repeat
	
	
}


# --------------------------------

 $botRisky = new Bot( array(
	'limit' => '100',
	'spreadMin' => '0.02,
	'spreadMax' => '0.02,
	//'excludeCoin' =>['USDT', 'TUSDT'],
	'aggression' => 10,
	'something' => ''
 ));
 
 $botRisky.run();

#	--------------------------------
#	Strategy() interface
#		run()
#	MarketMaker extends JsonBase implements Strategy 
#  		get list of coins
#		filter possible trading coins list
#		get next coin to trade (smallest spread)
#		
#			get the order book
#			determine isUpTrend
#			determine candle
#			place buy order
#
#
#		get next coin to trade (smallest spread) from filter possible trading coins list
#		
#			get the order book
#			determine isUpTrend
#			determine candle
#			place buy order


		
				