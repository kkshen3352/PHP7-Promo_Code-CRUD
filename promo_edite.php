<?php
//session_start(); //在此頁啟用session

require_once("db_connect.php");

//include("connMysqlObj.php");
if (isset($_POST["action"]) && $_POST["action"] == "update") {
    require_once("promo_edite.php");

    $sql_query = "UPDATE promo SET name=?, class=?, date=?,date_end=?, promo_id=?, valid=? WHERE id=?";
    $stmt = $connect->prepare($sql_query);
    $stmt->bind_param(
        'ssssiii',
        $_POST['name'],
        $_POST['class'],
        $_POST['date'],
        $_POST['date_end'],
        $_POST['promo_id'],
        $_POST['valid'],
        $_POST['id']
    );
    $stmt->execute();
    $stmt->close();
    $connect->close();
    //
    header("Location: product_list(kk).php?page=1&promo=0");
}
$sql_select = "SELECT * FROM promo WHERE id=?";
$stmt = $connect->prepare($sql_select);
$stmt->bind_param('i', $_GET["promo_id"]);
$stmt->execute();
$stmt->bind_result($id, $name, $class, $date,$date_end, $promo_id, $valid);
$stmt->fetch();
?>

<!doctype html>
<html lang="en">

<head>
    <title>修改資料</title>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html" ; charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="csslink.css">
    <style>
        header {
            max-width: 100%;
            width: 1140px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <aside class="d-flex flex-column  left text-center">
            <div class="hi">
                <p>HI 管理者</p>
                <div class="line"></div>
            </div>

            <div class="select d-flex flex-column">

                <a href="">
                    <div class="box">
                        <figure class="svg">
                            <img src="img/user.svg" alt="">
                        </figure>
                        <p>會員資料</p>
                    </div>
                </a>
                <a href="">
                    <div class="box">
                        <figure class="svg">
                            <img src="img/Order.svg" alt="">
                        </figure>
                        <p>訂單管理</p>
                    </div>
                </a>
                <a href="">
                    <div class="box">
                        <figure class="svg">
                            <img src="img/shop.svg" alt="">
                        </figure>
                        <p>商品</p>
                    </div>
                </a>
                <a href="product_list.php?page=1&promo=0">
                    <div class="box">
                        <figure class="svg">
                            <img src="img/coupon.svg" alt="">
                        </figure>
                        <p>優惠券</p>
                    </div>
                </a>
                <a href="">
                    <div class="box">
                        <figure class="svg">
                            <img src="img/schdule.svg" alt="">
                        </figure>
                        <p>行程</p>
                    </div>
                </a>
                <a href="">
                    <div class="box">
                        <figure class="svg">
                            <img src="img/team.svg" alt="">
                        </figure>
                        <p>揪團</p>
                    </div>
                </a>

            </div>
        </aside>
        <div class="d-flex flex-column">
            <header class="navbar navbar-expand-lg navbar-dark indigo mb-4 color">

                <a class="navbar-brand" href="#">搜尋</a>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <form class="form-inline ml-auto">
                        <div class="md-form my-0">
                            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                        </div>
                        <button href="#!" class="btn btn-outline-white btn-md my-0 ml-sm-2" type="submit">Search</button>
                    </form>

                </div>

            </header>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="card mt-3 p-2">
                            <div>
                                <h1 class=" text-center">優惠卷-修改資料</h1>
                                <p class="text-center"><a href="product_list(kk).php?page=1&promo=0">返回</a></p>
                                <div class="text-danger text-center">
                                </div>
                                <div class="text-center form-group">
                                    <form action="" method="post" name="formFix" id="formFix">
                                        <table class="text-center" border="1" align="conter" cellpadding="4">

                                            <tr>
                                                <th>欄位</th>
                                                <th>資料</th>
                                            </tr>
                                            <tr>
                                                <td>ID</td>
                                                <td><input type="text" name="id" id="id" value="<?php echo $id; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>優惠名稱</td>
                                                <td><input type="text" name="name" id="name" value="<?php echo $name; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>禮卷金額</td>
                                                <td><input type="text" name="class" id="class" value="<?php echo $class; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>日期</td>
                                                <td><input type="text" name="date" id="date" value="<?= $date ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>截止日期</td>
                                                <td><input type="text" name="date_end" id="date_end" value="<?= $date_end ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>禮卷編號</td>
                                                <td><input type="text" name="promo_id" id="promo_id" value="<?= $promo_id ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>valid</td>
                                                <td><input type="text" name="valid" id="valid" value="<?= $valid ?>"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="center">
                                                    <input name="id" type="hidden" value="<?php echo $id ?>" />
                                                    <input name="action" type="hidden" value="update" />
                                                    <input class="new btn" type="submit" name="button" id="button" value="更新資料" onclick=""/>
                                                    <input class="btn change" type="reset" name="button2" value="重新填寫" />
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
// @$stmt->close();
// @$db_link->close();
?>

</html>