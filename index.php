<html>
<head>
<title>PHP</title>
<style type="text/css">
    #submit{
        float:left;
        height:62%;
        width:50%;
        text-align:center;
    }
    textarea{
        height:80%;
        width:96%;
        border:2px solid green;
        margin-bottom:15px;
    }
    
    #show{
        float:left;
        height:62%;
        width:45%;
        padding:1%;
        border:2px solid green;
    }
</style>
<link rel="stylesheet" href="https://www.bootcss.com/p/buttons/css/buttons.css" type="text/css" />
</head>
<body>
    <div id="submit">
        <form action="write.php" method="post">
            <textarea name="content" placeholder="有想对我说的话吗？请在此输入后submit！:)"></textarea>
            <input class="button button-glow button-rounded button-royal" value="Submit" type="submit"/>
        </form>
    </div>
    <div id="show">
        <?php
            /*
            $fileName = "test.txt";
            $myfile = fopen($fileName, "r") or die("Unable to open file!");
            echo fread($myfile,filesize($fileName));
            fclose($myfile);
            */
            include_once("ip.php");
            include_once("database.php");
        ?>
    </div>
    <script language="javascript">
        //window.location.href = "https://music.163.com/#/mv?id=5496522";
    </script>
</body>
</html>
