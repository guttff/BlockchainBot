<?php


// use BittrexHelper;
// use BittrexProperties;
// use BittrexTicker;
// use CoinMarketCap;
// use Logger;
// use MarketMaker;
// use OrderBook;
// use SmallestSpread;

// include 'config/BittrexProperties.php';
// include 'Bittrex/BittrexHelper.php';
// include 'Bittrex/BittrexTicker.php';
include 'Strategy/MarketMaker.php';
// include 'Utils/CoinMarketCap.php';
// include 'Utils/Logger.php';
// include 'Utils/OrderBook.php';
// include 'Utils/SmallestSpread.php';

ini_set('max_execution_time', 300);
    
    echo '<b>BlockChain Trading Bot</b> <br/><br/><br/>';
    
    
    $marketMakerBot    = new MarketMaker(Array( 'limit'             => 20,
                                                'limitStart'        => 1,
                                                'aggression'        => 3,
                                                'minUSDCost'        => 0.0001,
                                                'maxUSDCost'        => 4,
                                                'spreadMax'         => 7,
                                                'spreadMin'         => 7,
                                                'percentChangeMax'  => 40,
                                                'percentChangeMin'  => -40,
                                                'excludecoins'      => array('USDT', 'TUSD')
                                        ));
    $marketMakerBot->run();
    
    /*
   
//     $Logger         = new Logger;
    
//     echo $bittrexProp->getBittrexBalanceAll();
    
    
//     $bittrex_open_order         = $bittrexHelper->getBittrexOpenOrder($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexOpenOrderURL());
       $bittrex_bal_all            = $bittrexHelper->getBittrexBalances($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexBalanceAllURL());
//     $market_summaries_Array     = $bittrexHelper->getBittrexMarketSummaries($bittrexProp->getBittrexMarketSummariesURL());
//     $market_Array               = $bittrexHelper->getBittrexMarkets($bittrexProp->getBittrexMarketURL());
    
//     echo "<pre>";
//     echo json_encode($market_Array, JSON_PRETTY_PRINT);
//     echo "</pre>";
    
    $balance_BTC        = $bittrexHelper->getBittrexBalance($bittrexProp->getBittrexAPISecret(), $bittrexProp->getBittrexBalanceBTCURL());
    
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