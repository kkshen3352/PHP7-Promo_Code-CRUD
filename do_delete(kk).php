<?php
//刪除/復原(kk)
session_start();//在此頁啟用session

unset($_SESSION['action_result']);

if(isset($_POST['delete_id'])){//確認是否有收到前台傳來的id陣列
    require_once("db_connect.php");
    $page = $_POST['originPage'];//抓取原先所在的頁面地址
    $id = $_POST['delete_id'];//抓取delete_id陣列
    $_SESSION['action_result'] = "刪除完成: <br>";
    foreach ($id as $value){
        $sql = "SELECT * FROM promo WHERE id=$value";
        $result = $connect->query($sql);
        if($result->num_rows<1){
            $_SESSION['action_error']="操作錯誤01，請重試";//如果沒抓到資料，在session中存入錯誤訊息
            header("Location: $page");//跳轉回原先頁面
        }else{
            $promo = $result->fetch_assoc();
            //確認valid的值，選擇進行刪除或復原
            ($promo['valid']==0)? $sql_delete = "UPDATE promo SET valid=1 WHERE id=$value" : $sql_delete = "UPDATE promo SET valid=0 WHERE id=$value";
            if($connect->query($sql_delete)==TRUE){
                //若成功，回傳影響的資料
                $_SESSION['action_result'] .= "優惠名稱:".$promo['name']." 優惠金額: ".$promo['class']."<br>";
                //將錯誤訊息清空
                unset($_SESSION['action_error']);
                header("Location: $page");
            }else{
                $_SESSION['action_error']="操作錯誤02，請重試";
                header("Location: $page");
            }
        }
    }
}else{
    $_SESSION['action_error']="操作錯誤03，請重試";
    header("Location: product_list(kk).php?");
}

////
////PDO version
////
//if(isset($_POST['delete_id'])) {
//    require_once("PDO_connect.php");
//    $id = $_POST['delete_id'][0];
//    $page = $_POST['delete_id'][1];
//    $sql = "SELECT * FROM promo WHERE id=$id";
//
//    $stmt = $db_host->prepare($sql);
//
//    try {
//        $stmt->execute();
//        $rowCount = $stmt->rowCount();
//        if ($rowCount < 1) {
//            $_SESSION['action_error'] = "操作錯誤01，請重試";
//            header("Location: order_manage.php");
//        } else {
//            $promo = $stmt->fetch();
//            $sql_delete = "UPDATE promo SET valid=? WHERE id=?";
//            $stmt = $db_host->prepare($sql_delete);
//            try {
//                $promo['valid'] == 0 ? $stmt->execute(["1", $id]) : $stmt->execute(["0", $id]);
//                $_SESSION['action_result'] = "修改完成 <br>影響內容： id:" . $promo['id'] . " 姓名: " . $promo['name'];
//                unset($_SESSION['action_error']);
//                header("Location: order_manage.php?page=$page");
//            } catch (PDOException $e) {
//                $_SESSION['action_error'] = "操作錯誤02，請重試";
//                header("Location: order_manage.php");
//                echo "error: " . $e->getMessage();
//                $db_host = NULL;
//                exit;
//            }
//        }
//    } catch (PDOException $e) {
//        $_SESSION['action_error'] = "操作錯誤03，請重試";
//        header("Location: order_manage.php");
//        echo "預處理陳述式執行失敗! <br>";
//        echo "error :" . $e->getMessage() . "<br>";
//        $db_host = NULL;
//        exit;
//    }
//}



?>
