<?php
function getIp()
{
    if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER["REMOTE_ADDR"]))
    {
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else
    {
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    echo $cip;
    unset($cips, $cip);
}
