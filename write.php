<html>
<head>
    <title>write</title>
</head>
<body>
    <?php
        $time = date("Y-m-d h:i:sa");
        $content = $time . "\r\n" . $_POST["content"] . "\r\n\r\n";
        echo $content;
        $fileName = "test.txt";
        $file = fopen($fileName, "a") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    ?>
</body>
</html>
