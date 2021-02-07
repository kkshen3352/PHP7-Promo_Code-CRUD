<?php
require_once("db_connect.php");

if (!isset($_GET["page"])) {
    $page = 1;
} else {
    $page = $_GET["page"];
}
//設定頁數
$promo_page = 5;
$start = ($page - 1) * $promo_page;

//如果搜尋 那麼資料庫...
if (isset($_GET["search_text"])) {
    $search = $_GET["search_text"];

    //資料庫
    $sql = "SELECT promo.* From promo WHERE valid=1 AND ( name LIKE '%".$search."%' OR class LIKE '%".$search."%' OR date LIKE '%".$search."%' OR date_end LIKE '%".$search."%' ) 
    LIMIT $start, $promo_page";
} else {
    $sql = "SELECT promo. * FROM promo 
    WHERE valid = 1
    LIMIT $start, $promo_page";
}
$result = $connect->query($sql);

if (isset($search)) {
    $sql_promo = "SELECT promo. * From promo WHERE valid=1 AND(name LIKE '%" . $search . "%'
    OR class LIKE '%" . $search . "%' 
    OR date LIKE '%" . $search . "%' 
    OR date_end LIKE '%" . $search . "%' )";
} else {
    $sql_promo = "SELECT * FROM promo WHERE valid=1";
}
$result_promo = $connect->query($sql_promo);

//搜尋 與 無搜尋的頁面整合
$total_promo = $result_promo->num_rows;
//分頁計算
$total_page = floor($total_promo / $promo_page) + 1;
if ($total_promo % $promo_page == 0) $total_page = $total_page - 1;
$first_promo = ($page - 1) * $promo_page + 1;

$last_promo = $page * $promo_page;

//if($last_promo => $total_promo) $last_promo = $total_promo;
?>