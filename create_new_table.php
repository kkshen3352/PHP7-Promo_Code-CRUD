<?php
//新增資料表
require_once("db_connect.php");
$sql="CREATE TABLE Promo_Code LIKE users";
if($connect->query($sql)===TRUE){
    echo "資料表新增成功";
}else{
    echo "資料表新增失敗".$connect->error;
}
?>