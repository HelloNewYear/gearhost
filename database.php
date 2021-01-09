<?php
    //connect server
    echo "a";
    $con = mysqli_connect("den1.mysql3.gear.host", "blackwidow", base64_decode("bmF0YXNoYS4="));
    if(!$con){die("Couldn't connect mySQL : " . mysqli_error($con));}
    echo "b";

    //connect database
    $database_name = "blackwidow";
    mysqli_select_db($con, $database_name;) or die("Can't use blackwidow : " . mysqli_error($con));

    $table_name = "access_log";
    $result = mysqli_query($con, "SHOW TABLES LIKE '" . $table_name . "';");
    if(mysqli_num_rows($result)==0){
        $create_table_sql = "CREATE TABLE " . $table_name . "(
            id bigint(100) PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT 'auto_increment id index',
            create_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            update_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            server TEXT
        );";
        echo $create_table_sql."<br>";
        mysqli_query($con, $create_table_sql);
        unset($create_table_sql);
    }
    unset($result);

    $insert_table_sql = "INSERT INTO " . $table_name . "(server) VALUES('" . json_encode($_SERVER) . "');";
    echo $insert_table_sql."<br>";
    mysqli_query($con, $insert_table_sql) or die("Error : " . mysqli_error($con));

    unset($insert_table_sql, $table_name);
    mysqli_close($con);
