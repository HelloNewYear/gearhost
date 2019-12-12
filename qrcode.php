<html>
<head>
<link rel="stylesheet" href="https://www.bootcss.com/p/buttons/css/buttons.css" type="text/css" />
</head>
<body>
<?php
    $data = "01,10,042001800311,92220891,257.52,20191005,52791651903408788835,4C2F";
    function generateQRfromqrserver($data,$widhtHeight ='150')
    {
    	$chl = urlencode($chl);
    	echo '<img src="https://api.qrserver.com/v1/create-qr-code/?data='.$data.'"/>';
    }
    generateQRfromqrserver($data);
    
    function a()
    {
        echo '<button></button>';
    }
    echo '<button type="button" class="button button-glow button-rounded button-royal" onclick=alert("abc")></button>';
?>
</body>
</html>
