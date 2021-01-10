<?php
    $url = "http://tool.ccb.com/webtran/static/trendchart/getAccountData.gsp?dateType=timeSharing&sec_code=019999";
    $UA = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36";
    $AC = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
    $opt = array("http"=>array(
        "method"=>"GET",
        "header"=>array($UA, $AC)
        )
    );
    $context = stream_context_create($opt);
    $content = file_get_contents($url, false, $context);

    $content = str_replace(array("\n", "\r"), '', $content);//$content = preg_replace("/s/", '', $content);
    $content_json = json_decode($content);
    $rtp = $content_json->realTimePrice;
    if(is_null($rtp)) die("Closed");
    $rtp_json = json_decode($rtp);
    $s = "time,new_pri,valueB,valueS,CURR_COD,price_chg\n";
    $l = count($rtp_json);
    for($i=0; $i<$l; $i++){
        $s = $s . str_replace(",", "", $rtp_json[$i]->time) . "," . number_format($rtp_json[$i]->new_pri, 2) . "," . number_format($rtp_json[$i]->valueB, 2) . "," .  number_format($rtp_json[$i]->valueS, 2) . "," . $rtp_json[$i]->CURR_COD . "," . number_format($rtp_json[$i]->price_chg, 2) . "\n";
    }
    //echo gettype(content_json);
    is_dir("./CCB") or mkdir("CCB");
    $filename = "./CCB/" . str_replace(array(" ", "-", ":"), "", $content_json->time) . "_" . number_format($content_json->new_pri, 2) . "_" . number_format($content_json->hig_pri, 2) . "_" . number_format($content_json->low_pri, 2) . ".csv.txt";
    $file = fopen($filename, "w") or die("Unable to open file!");
    fwrite($file, $s);
    fclose($file);
