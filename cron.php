<?php
    ignore_user_abort();  //关掉测览器,PHP脚本也可以继续执行
    set_time_limit(0);    //通过set_time_limit(0)可以让程序无限制的执行下去
    $interval=60*30;      //每隔半小时运行
    do{
        $run = include('cron_switch.php');
        if(!$run)die('process abort');
        echo("once\n");
        sleep($interval);
    }while(true);
