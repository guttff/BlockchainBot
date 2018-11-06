# BlockchainBot

Order = {
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

#	-------------------------------

public void main(String[] args){
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



		
				