<?php
    $url = "http://tool.ccb.com/webtran/static/trendchart/getAccountData.gsp?dateType=timeSharing&sec_code=019999";
    header("User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36");
    header("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9");
    $content = file_get_contents($url);

    $content = str_replace(array("\n", "\r"), '', $content);
    //$content = preg_replace("/s/", '', $content);
    $content_json = json_decode($content);
    //echo gettype(content_json);
    $filename = str_replace(array(" ", "-", ":"), "", $content_json->time) . "_" . number_format($content_json->new_pri, 2) . "_" . number_format($content_json->hig_pri, 2) . "_" . number_format($content_json->low_pri, 2) . ".csv.txt";

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
    $post_data = array (
        "upload" => $filename
    );
    $destination = "http://localhost/test/curl/curl_post.php";
    curl_setopt($ch, CURLOPT_URL, $destination);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
    curl_setopt($ch, CURLOPT_HEADER, 0);//参数设置，是否显示头部信息，1为显示，0为不显示
    curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com");//伪造网页来源地址,伪造来自百度的表单提交
    curl_setopt($ch, CURLOPT_POST, 1);//表单数据，是正规的表单设置值为非0
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);//设置curl执行超时时间最大是多少
    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_exec($ch);
    curl_close($ch);//释放cURL句柄
