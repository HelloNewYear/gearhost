<?php
    $url = $_GET["url"];
    $UA = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36";
    $AC = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
    $opt = array("http"=>array(
        "method"=>"GET",
        "header"=>array($UA, $AC)
        )
    );
    $context = stream_context_create($opt);
    $content = file_get_contents($url, false, $context);
    echo $content;
