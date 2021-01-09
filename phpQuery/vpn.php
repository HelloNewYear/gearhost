<?php
    include 'phpQuery.php';
    $url = "http://vpnforgame.net/CN/?f=freevpn";
    phpQuery::newDocumentFile($url); 
    echo pq("table")->text();   
