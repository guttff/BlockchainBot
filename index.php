<?php


// use BittrexHelper;
// use BittrexProperties;
// use BittrexTicker;
// use CoinMarketCap;
// use Logger;
// use MarketMaker;
// use OrderBook;
// use SmallestSpread;

include 'config/BittrexProperties.php';
include 'Bittrex/BittrexHelper.php';
include 'Bittrex/BittrexTicker.php';
include 'Strategy/MarketMaker.php';
include 'Utils/CoinMarketCap.php';
include 'Utils/Logger.php';
include 'Utils/OrderBook.php';
include 'Utils/SmallestSpread.php';

ini_set('max_execution_time', 300);
    
    echo '<b>BlockChain Trading Bot</b> <br/><br/><br/>';
    
    
    $marketMakerBot    = new MarketMaker(Array( 'limit'         => 20,
                                                'limitStart'    => 1,
                                                'aggression'    => 3,
                                                'spreadMax'     => 7,
                                                'spreadMin'     => 7,
                                                'excludecoins'  => ['USDT', 'TUSD']
                                        ));
    $marketMakerBot->run();
    
    /*
    $bittrexProp    = new BittrexProperties();
    $bittrexHelper  = new BittrexHelper();
    $bittrexTicker  = new BittrexTicker();
    $smallestSpread = new SmallestSpread();
    
//     $Logger         = new Logger;
    
//     echo $bittrexProp->getBittrexBalanceAll();
    
    
//     $bittrex_open_order         = $bittrexHelper->getBittrexOpenOrder($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexOpenOrderURL());
       $bittrex_bal_all            = $bittrexHelper->getBittrexBalances($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexBalanceAllURL());
//     $market_summaries_Array     = $bittrexHelper->getBittrexMarketSummaries($bittrexProp->getBittrexMarketSummariesURL());
//     $market_Array               = $bittrexHelper->getBittrexMarkets($bittrexProp->getBittrexMarketURL());
    
//     echo "<pre>";
//     echo json_encode($market_Array, JSON_PRETTY_PRINT);
//     echo "</pre>";
    
    $cnmkt = "https://api.coinmarketcap.com/v2/ticker/?limit=20&convert=BTC";
    $fgc = json_decode(file_get_contents($cnmkt), true);
    $fgc_data = $fgc['data'];
    $counter = 0;
    $showOrderBook =  true;
    $balance_BTC        = $bittrexHelper->getBittrexBalance($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexBalanceBTCURL());
    foreach($fgc_data as $item) {
        $fgc_data_quotes        = $item['quotes'];
        $fgc_data_quotes_USD    = $fgc_data_quotes['USD'];
        $fgc_data_quotes_BTC    = $fgc_data_quotes['BTC'];
        
        $counter++;
        if($counter < count($fgc_data)){
            $percent_change_7d = $fgc_data_quotes_USD["percent_change_7d"];
            if($percent_change_7d > -40 && $percent_change_7d < 40){
                $symbol             = $item['symbol'];
                $cost_USD           = number_format($fgc_data_quotes_USD["price"], 8);
                $cost_BTC           = number_format($fgc_data_quotes_BTC["price"], 8);
//              $balance_BTC_USD    = number_format(($balance_BTC * $BTC_USD_cost), 8);
                $fifthBal           = number_format(($balance_BTC / 5), 8);
                $amountToBuy        = number_format(($fifthBal / $cost_BTC), 8);
                $market             = 'BTC-' .$symbol;
                
                
                
                $bittrexTicker = $bittrexHelper->getBittrexTicker($bittrexProp->getBittrexTickerURL(), $market);
                
                
                // dont buy anything over 4 dollars || USDT (Theter)
                if($cost_USD > 4 || $symbol == 'TUSD' || $bittrexTicker->getBid() == null)
                    continue;
                    
                    
                    
                    echo "<br/>";
                    echo '$counter : '      . $counter      . "<br/>";
                    echo '$symbol : '       . $symbol       . "<br/>";
                    echo '$market : '       . $market       . "<br/>";
                    echo '$balance_BTC : '  . $balance_BTC  . "<br/>";
                    echo '$fifthBal : '     . $fifthBal     . "<br/>";
                    echo '$cost_BTC : '     . $cost_BTC     . "<br/>";
                    echo '$cost_USD : '     . $cost_USD     . "<br/>";
                    echo '$amountToBuy : '  . $amountToBuy  . "<br/>";
                    echo "<br/>";
                    
                    if($showOrderBook){
                        $buyOrderBook = $bittrexHelper->getBittrexOrderBook($bittrexProp->getBittrexOrderBookURL(), $market, 'buy');
                        $sellOrderBook = $bittrexHelper->getBittrexOrderBook($bittrexProp->getBittrexOrderBookURL(), $market, 'sell');
                        
                        $orderBook = new OrderBook($buyOrderBook);
                        
//                         echo "<pre>";
//                         echo 'sell order book: '.count($sellOrderBook).'<br/>';
//                         echo 'buy order book: '.count($buyOrderBook).'<br/>';
//                         echo json_encode($buyOrderBook, JSON_PRETTY_PRINT);
//                         echo "</pre>";
                        $showOrderBook = false;
                    }
                    
                    
                    
                // the lower the spread the higher the volume
                $spreadPercent = $marketMaker->getSpreadPercent($bittrexTicker->getBid(), $bittrexTicker->getAsk(), $bittrexTicker->getLast());
                echo "<pre>";
                echo '$bittrexTicker for market :' .$market . '<br/>';
                echo $bittrexTicker->toJSON();
                echo "<br/>";
                echo 'spread percent :' . $spreadPercent .' % <br/>';
                echo "</pre>";
                
                // store smallest spread data
                if($smallestSpread->getSpreadPercent() == null || 
                   $smallestSpread->getSpreadPercent() > $spreadPercent){
                    $smallestSpread->setSpreadPercent($spreadPercent);
                    $smallestSpread->setCost_BTC($cost_BTC);
                    $smallestSpread->setCost_USD($cost_USD);
                    $smallestSpread->setMarket($market);
                    $smallestSpread->setSymbol($symbol);
                }
                
                echo "<pre>";
                echo 'smallest Spread : <br/>';
                echo $smallestSpread->toJSON();
                echo "</pre>";
                
//                 $buyOrderBook = $bittrexHelper->getBittrexOrderBook($bittrexProp->getBittrexOrderBookURL(), $market, 'buy');
//                 $sellOrderBook = $bittrexHelper->getBittrexOrderBook($bittrexProp->getBittrexOrderBookURL(), $market, 'sell');
                
//                 $marketHistory = $bittrexHelper->getBittrexMarketHistory($bittrexProp->getBittrexMarketHistoryURL(), $market);
                
//                 echo "<pre>";
//                 echo 'market history :' .$market .'<br/>';
//                 echo 'market history size:' .count($marketHistory).'<br/>';
//                 echo json_encode($marketHistory, JSON_PRETTY_PRINT);
//                 echo "</pre>";
//                 $bittrexHelper->placeBittrexBuyLimitOrder($apisecret, $bittrexProp->getBittrexBuyLimitURL(), $symbol, $amountToBuy, $cost_BTC);
                
            }
            
        }
    }
    */
    
    
    
    
    
?>