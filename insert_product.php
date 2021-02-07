<?php
//建構資料表
require_once("db_connect.php");

$stmt = $connect->prepare("INSERT INTO promo(name, class, date, date_end, promo_id, valid) VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param('sissii', $name, $class, $date, $date_end, $promo_id, $valid);

$name = "PHP崩潰禮卷";
$class = 777;
$date = "2020-11-01";
$date_end= "2020-11-19";
$promo_id = 6;
$valid =1;
$stmt->execute();

$name = "雙十一禮卷";
$class = 111;
$date = "2020-11-11";
$date_end= "2020-11-12";
$promo_id = 7;
$valid =1;
$stmt->execute();

$name = "聖誕禮卷";
$class = 200;
$date = "2020-11-25";
$date_end= "2021-01-01";
$promo_id = 8;
$valid =1;
$stmt->execute();

$name = "88優惠禮卷";
$class = 100;
$date = "2020-11-11";
$date_end= "2020-11-20";
$promo_id = 4;
$valid =1;
$stmt->execute();

$name = "99優惠禮卷";
$class = 99;
$date = "2020-11-19";
$date_end= "2020-12-19";
$promo_id = 5;
$valid =1;
$stmt->execute();

$stmt->close();
