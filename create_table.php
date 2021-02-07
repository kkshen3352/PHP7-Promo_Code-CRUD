<?php
//建資料表
require_once("db_connect.php");

$sql="CREATE TABLE promo(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
class VARCHAR(50),
date DATE,
date_end DATE,
promo_id VARCHAR(30),
valid VARCHAR(4)
)";

if($connect->query($sql)===TRUE){
    echo "資料表 promo 建立完成";
}else{
    echo "資建立資料表錯誤:".$connect->error;
}

$connect->close();

?>