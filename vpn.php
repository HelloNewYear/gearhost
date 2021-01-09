<?php
    include(dirname(__FILE__).'/phpQuery/phpQuery.php');
    $url = "http://vpnforgame.net/CN/?f=freevpn";
    phpQuery::newDocumentFile($url); 
    echo pq("table")->text();   
