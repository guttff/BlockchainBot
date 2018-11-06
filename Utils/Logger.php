<?php

// namespace Logger;

Class Logger{
    private $logFile;
    
    function __construct(){
        $this->logFile = fopen('Logs/LogData_'. '20'. date("y_m_d"). '.txt', 'a');
    }
    
    function add($data){
        fwrite($this->logFile, $data ."\n");
    }
    
    function close(){
        fclose($this->logFile);
    }
}

?>