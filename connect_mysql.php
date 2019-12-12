<?php
function insert_into_blackwidow($ip, $server){
    $con = mysqli_connect("den1.mysql2.gear.host", "blackwidow", "natasha.");
    if(!$con){
        die("Couldn't connect mySQL : " . mysqli_error($con));
    }
    else{
        echo("connect mysql success!<br>");
    }

    mysqli_select_db($con, "blackwidow") or die("Can't use blackwidow : " . mysqli_error($con));
    echo("connect blackwidow success!<br>");

    $table_name = "access_log";
    $result = mysqli_query($con, "SHOW TABLES LIKE '" . $table_name . "';");
    if(mysqli_num_rows($result)==0){
        $create_table_sql = "CREATE TABLE " . $table_name . "
        (
            id bigint(100) PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT 'auto_increment id index',
            create_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            update_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            ip varchar(15),
            server TEXT
        );";
        #echo $create_table_sql."<br>";
        if(mysqli_query($con, $create_table_sql)){
            echo("create table success!<br>");
        }
        unset($create_table_sql);
    }
    unset($table_name, $result);

    $insert_table_sql = "INSERT INTO login_log(ip, server) VALUES('" . $ip . "', '" . $server . "');";
    #echo $insert_table_sql."<br>";
    mysqli_query($con, $insert_table_sql) or die("Error : " . mysqli_error($con));
    echo("insert into table success!<br>");
    unset($insert_table_sql);

    mysqli_close($con);
}
