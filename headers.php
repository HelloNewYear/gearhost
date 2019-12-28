<?php
    $headers = apache_request_headers();
    ksort($headers);
    foreach($headers as $header => $value){
        echo "$header: $value <br/>";
    }
    echo "<br/><br/>";

    ksort($_SERVER);
    foreach($_SERVER as $key => $value){
        echo "$key => $value <br/>";
    }
