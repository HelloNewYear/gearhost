<?php
    $url = "http://tool.ccb.com/webtran/static/trendchart/getAccountData.gsp?dateType=timeSharing&sec_code=019999";
    header("User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36");
    header("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9");
    $content = file_get_contents($url);

    $content = str_replace(array("\n", "\r"), '', $content);
    //$content = preg_replace("/s/", '', $content);
    $content_json = json_decode($content);
    $filename = str_replace(array(" ", "-", ":"), "", $content_json->time) . "_" . number_format($content_json->new_pri, 2) . "_" . number_format($content_json->hig_pri, 2) . "_" . number_format($content_json->low_pri, 2) . ".csv";

    $rpt = $content_json->realTimePrice;
    $rpt_json = json_decode($rpt);
    $s = "time,new_pri,valueB,valueS,CURR_COD,price_chg\n";
    $l = count($rpt_json);
    for($i=0; $i<$l; $i++){
        $s = $s . str_replace(",", "", $rpt_json[$i]->time) . "," . number_format($rpt_json[$i]->new_pri, 2) . "," . number_format($rpt_json[$i]->valueB, 2) . "," .  number_format($rpt_json[$i]->valueS, 2) . "," . $rpt_json[$i]->CURR_COD . "," . number_format($rpt_json[$i]->price_chg, 2) . "\n";
    }

    $file = fopen($filename, "w") or die("Unable to open file!");
    fwrite($file, $s);
    fclose($file);

    $ch = curl_init();
