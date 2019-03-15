<?php

// namespace BittrexHelper;

// use BittrexTicker;

// require_once "Bittrex/BittrexTicker.php";

Class BittrexHelper{
    
    function cancelBittrexOrder($apisecret, $bittrex_cancel_order, $ORDER_UUID){
        
        $nonce=time();
        $uri=$bittrex_cancel_order.'&uuid'.$ORDER_UUID.'&nonce='.$nonce;
        $sign=hash_hmac('sha512',$uri,$apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $execResult = curl_exec($ch);
        $obj = json_decode($execResult, true);
        
        return $obj;
    }
    
    function getBittrexBalance($apisecret, $bittrex_balance_BTC){
        $nonce=time();
        $uri= $bittrex_balance_BTC . '&nonce=' . $nonce;
        $sign=hash_hmac('sha512',$uri,$apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $execResult = curl_exec($ch);
        $obj = json_decode($execResult, true);
        $balance = number_format($obj["result"]["Available"], 8); // format the result to 8 decimal places for the satoshi value
        return $balance;
    }
    
    function getBittrexBalances($apisecret, $bittrex_balance_all){
        $bal_Array = array();
        $nonce=time();
        $uri= $bittrex_balance_all . '&nonce=' . $nonce;
        $sign=hash_hmac('sha512',$uri,$apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $execResult = curl_exec($ch);
        $obj = json_decode($execResult, true);
        
        if($obj['success']){
            $fgc_result = $obj['result'];
            foreach($fgc_result as $item) {
                $available_bal = number_format($item['Available'], 8); // format the result to 8 decimal places for the satoshi value
                if($available_bal > 0)
                    array_push($bal_Array,$item);
            }
        }
        
        return $bal_Array;
    }
    
    function getBittrexMarkets($bittrex_markets){
        $market_Array = array();
        $obj = json_decode(file_get_contents($bittrex_markets), true);
        
        if($obj['success']){
            $fgc_result = $obj['result'];
            foreach($fgc_result as $item) {
                $BaseCurrency = $item['BaseCurrency'];
                if($BaseCurrency === 'BTC')
                    array_push($market_Array,$item);
            }
        }
            
        return $market_Array;
    }
    
    function getBittrexMarketHistory($bittrex_market_history, $market){
        $nonce=time();
        $bittrex_market_history .= $market . '&nonce=' . $nonce;
        $marketHistoryArray = array();
        $obj = json_decode(file_get_contents($bittrex_market_history), true);
        
        if($obj['success']){
            $fgc_result = $obj['result'];
            foreach($fgc_result as $item) {
                array_push($marketHistoryArray,$item);
            }
        }
        
        return $marketHistoryArray;
    }
    
    function getBittrexMarketSummaries($bittrex_market_summaries){
        $market_Array = array();
        $obj = json_decode(file_get_contents($bittrex_market_summaries), true);
        
        if($obj['success'])
            $market_Array = $obj['result'];
            
        return $market_Array;
    }
    
    function getBittrexMarketSummary($bittrex_market_summary, $market){
        $nonce=time();
        $bittrex_market_summary .= $market . '&nonce=' . $nonce;
        $marketSummaryArray = array();
        $obj = json_decode(file_get_contents($bittrex_market_summary), true);
        
        if($obj['success']){
            $fgc_result = $obj['result'];
            foreach($fgc_result as $item) {
                array_push($marketSummaryArray,$item);
            }
        }
        
        return $marketSummaryArray;
    }
    
    function getBittrexOpenOrder($apisecret, $bittrex_open_order){
        $nonce=time();
        $uri=$bittrex_open_order.'&nonce='.$nonce;
        $sign=hash_hmac('sha512',$uri,$apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $execResult = curl_exec($ch);
        $obj = json_decode($execResult, true);
        
        return $obj["result"];
    }
    
    function getBittrexOrderBook($bittrex_order_book_URL, $market, $type){
        $nonce=time();
        if($type === '')
            $type = 'both';
        
        $bittrex_order_book_URL .= $market . '&type=' . $type . '&nonce=' . $nonce;
        $orderBookArray = array();
        $obj = json_decode(file_get_contents($bittrex_order_book_URL), true);
        
        if($obj['success']){
            $fgc_result = $obj['result'];
            foreach($fgc_result as $item) {
                array_push($orderBookArray,$item);
            }
        }
        
        return $orderBookArray;
    }
    
    function placeBittrexBuyLimitOrder($apisecret, $bittrex_buy_limit, $symbol, $quantity, $rate){
        
        $nonce=time();
        $uri=$bittrex_buy_limit.'&market=BTC-'.$symbol.'&quantity='.$quantity.'&rate='.$rate.'&nonce='.$nonce;
        $sign=hash_hmac('sha512',$uri,$apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $execResult = curl_exec($ch);
        $obj = json_decode($execResult, true);
        
        return $obj;
    }
    
    function placeBittrexSellLimitOrder($apisecret, $bittrex_sell_limit, $symbol, $quantity, $rate){
        
        $nonce=time();
        $uri=$bittrex_sell_limit.'&market=BTC-'.$symbol.'&quantity='.$quantity.'&rate='.$rate.'&nonce='.$nonce;
        $sign=hash_hmac('sha512',$uri,$apisecret);
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $execResult = curl_exec($ch);
        $obj = json_decode($execResult, true);
        
        return $obj;
    }
    
    function getBittrexTicker($bittrex_ticker, $market){
        $nonce=time();
        $bittrex_ticker .= $market . '&nonce=' . $nonce;
        $bt = new BittrexTicker();
        $obj = json_decode(file_get_contents($bittrex_ticker), true);
        
        if($obj['success']){
            $tickerData = $obj['result'];
            $bt->setAsk($tickerData['Ask']);
            $bt->setBid($tickerData['Bid']);
            $bt->setLast($tickerData['Last']);
        }
           
        return $bt;
    }
}


?>