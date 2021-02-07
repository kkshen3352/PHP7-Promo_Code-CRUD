<?php
//登入用
$server_name="localhost";
$user_name="root";
$password="h30352418";
$db_name="Promo_Code";

$connect=new mysqli($server_name, $user_name, $password, $db_name);
if($connect->connect_error){
    die("連線錯誤:". $connect->connect_error);
}
//echo "連線成功";
//$sql = 'CREATE DATABASE member';
//$retval = mysqli_query($conn,$sql);
if($connect->connect_error){
    die('連線失敗: '. mysqli_error($connect));
}
//echo "資料庫 $sql 新增成功\n";

?>

<?php
//$dbhost = 'localhost';  // mysql伺服器主機地址
//$dbuser = 'root';            // mysql使用者名稱
//$dbpass = 'h30352418';          // mysql使用者名稱密碼
//$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
//if(! $conn )
//{
//    die('連線錯誤: ' . mysqli_error($conn));
//}
//echo '連線成功<br />';
//$sql = 'CREATE DATABASE ITREAD01';
//$retval = mysqli_query($conn,$sql );
//if(! $retval )
//{
//    die('新增資料庫失敗: ' . mysqli_error($conn));
//}
//echo "資料庫 ITREAD01 新增成功\n";
//mysqli_close($conn);
//?>
