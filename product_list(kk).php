<?php
//PHP主頁
require_once("mysql(kk).php");
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta http-equiv="Content-Type" content="text/html" ; charset="utf-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="csslink.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

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
                <a href="product_list(kk).php?page=1&promo=0">
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
            <!-- 搜尋 -->
            <header class="navbar navbar-expand-lg navbar-dark indigo mb-4 color">

                <!-- <a class="navbar-brand" href="#">搜尋</a> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <form method="get" class="form-inline" action="">
                        <input class="form-control" type="text" placeholder="請輸入搜尋關鍵字" name="search_text" id="search_text" <?php
                                                                                                                            if (isset($_GET['search_text'])) { ?> value="<?= $_GET['search_text'] ?>" <?php
                                                                                                                            }
                                                                                                ?>>
                        <button class="btn btn-outline-success" type="submit" onclick="searchbtn()">搜尋</button>
                        <!-- 隱藏欄位記錄分頁欄位內的資料,如此分頁後再搜尋,才會以所選的分頁筆數來顯示搜尋後資料 -->
                        <input name="selectpage" type="hidden" value="<?= $_GET['selectpage'] ?>">
                    </form>
                </div>
            </header>
            <?php
            //顯示回傳的session，用來確認修改的內容
            if (isset($_SESSION['user_error'])) {
            ?><div>
                    <?= $_SESSION['action_result']; ?>
                    <?= $_SESSION['action_error']; ?>
                </div><?php
                    } else if (isset($_SESSION['action_result'])) {
                        ?><div>
                    <?= $_SESSION['action_result']; ?>
                </div><?php
                    }
                        ?>
            <div class="container ">
                <div class="table-responsive ">

                    <table class="table text-center align-bottom overflow-auto " id="table" align="center">
                        <div class="text-right"> 目前在第 <?= $page ?> 頁, 共 <?= $total_page ?> 頁 </div>
                        <div class="d-flex justify-content-start" style="margin-bottom:15px ">
                            <!-- 按鈕 -->
                            <!-- <p class="text-center new btn" id="new"><a style="color:black; text-decoration:none" href="promo_add.php?">新增</a></p> -->
                            <button type="button" class="new btn" id="new" onclick="self.location.href='promo_add.php?'">新增</button>
                            <!-- 用form把按鈕包起來，並設定id，就可讓按鈕抓取外部設定同樣id的input元件值 -->
                            <form id="form_multi_delete" action="do_delete(kk).php" method="post">
                                <input type="hidden" name="originPage" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                <button type="submit" class="del btn" id="multi_delete" onclick="return confirm('確定要進行批次刪除？')">刪除</button>
                                
                            </form>
                            
                        </div>

                        <thead class="thead-dark">
                            <tr class="text-nowrap" draggable="true">
                                <th class="px-0" width="130px">
                                <div>
                                <!-- checkAll -->
                                <input class="btn" style="color:#fff; width:50px;" type="button" value="全選" onclick="checkAll()" />
                                    <input class="btn" style="color:darkcyan; width:50px;" type="button" value="反選" onclick="unCheckAll()" />
                            </div>
                                </th>
                                <th>編號</th>
                                <th>優惠名稱</th>
                                <th>優惠金額</th>
                                <th>日期</th>
                                <th>截止日期</th>
                                <th>優惠時間</th>
                                <th>狀態</th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <?php if ($row['valid'] == 0) ?>
                                    <!--把所有check box加上form="form_id"的屬性，就可以在外部控制  -->
                                    <!-- 設定判斷式，若valid==0 不可選  -->
                                    <td class="align-middle">
                                        <input class="hobby" form="form_multi_delete" name="delete_id[]" value="<?= $row["id"] ?>" id="<?= $row["id"] ?>" type="checkbox" <?php if ($row["valid"] == 0) echo "disabled"; ?> />

                                    </td>
                                    <td class="align-middle"><?= $row["id"] ?></td>
                                    <td class="align-middle"><?= $row["name"] ?></td>
                                    <td class="align-middle"><?= $row["class"] ?></td>
                                    <td class="align-middle"><?= $row["date"] ?></td>
                                    <td class="align-middle"><?= $row["date_end"] ?></td>
                                    <td class="align-middle"><?= (strtotime($row["date_end"]) - strtotime($row["date"])) / (60 * 60 * 24) . "day"; ?></td>

                                    <td class="align-middle">
                                        <?php
                                        $day = round(strtotime($row["date_end"]) - strtotime($row["date"])) / (60 * 60 * 24);

                                        if ($day > 7) {
                                            $status = "優惠中";
                                            $color = "badge badge-success";
                                        } else if ($day <= 0) {
                                            $status = "優惠結束";
                                            $color = "badge badge-secondary";
                                        } else if ($day == $day) {
                                            $status = "即將結束";
                                            $color = "badge badge-danger";
                                        }
                                        ?>
                                        <span class="<?= $color ?>" id="www<$row['id']?>"><?= $status ?></span>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column twobtn">
                                            <form action="" method="post">
                                                <!-- <input type="button" id="<?= $row["id"] ?>" name="<?= $row["id"] ?>" onclick='promo_edite.php?promo.id=".$row["id"]"'> -->

                                                <!-- <p class="btn change"><a style="color:black; text-decoration:none" href='promo_edite.php?promo.id=<?= $row['id'] ?>'>修改</a></p> -->
                                                <input class="btn change" type="button" onclick="self.location.href='promo_edite.php?promo.id=<?= $row['id'] ?>'" value="修改">
                                                <?php
                                                ?>
                                            </form>
                                            <!-- <button type="button" class="del btn" id="del">刪除</button> -->
                                            <form action="do_delete(kk).php" method="post">
                                                <!-- name設定為同樣的陣列，可同時傳複數值給同一變數 -->
                                                <!-- 利用type = hidden 傳設定好的隱藏值 -->
                                                <!-- $_SERVER['REQUEST_URI'] 是當下的檔案名稱跟後面?的值 -->
                                                <input type="hidden" name="delete_id[]" value="<?= $row["id"] ?>">
                                                <input type="hidden" name="originPage" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                                <!-- 用return跳出確認視窗，若否則不會動作 -->
                                                <button type="submit" class="del btn" onclick="return confirm('確定要<?php
                                                                                                                    if ($row["valid"] == 0) {
                                                                                                                        echo "復原 ";
                                                                                                                    } else {
                                                                                                                        echo "刪除 ";
                                                                                                                    }
                                                                                                                    echo $row["name"] ?> ？')">
                                                    <!-- 用valid判斷要顯示刪除還是復原 -->
                                                    <?php if ($row['valid'] == 1) {
                                                        echo "刪除";
                                                    } else {
                                                        echo "復原";
                                                    } ?></button>
                                            </form>
                                        </div>
                                    </td>
                                <tr>
                            <?php
                            }
                        }
                            ?>

                    </table>
                    <nav id="page" aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li class="page-item <?php if ($i == $page) echo "active"; ?>">
                                    <a class="page-link" href="<?php
                                                                if (isset($search)) {
                                                                    echo "product_list(kk).php?page=" . $i . "&search_text=" . $search;
                                                                } else {
                                                                    echo "product_list(kk).php?page=" . $i;
                                                                }

                                                                ?>"><?= $i ?></a>

                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    function checkAll() {
        var hobby = document.getElementsByClassName("hobby");
        for (var i = 0; i < hobby.length; i++) {
            var h = hobby[i];
            h.checked = true;
        }
    }

    function unCheckAll() {
        var hobby = document.getElementsByClassName("hobby");
        for (var i = 0; i < hobby.length; i++) {
            var h = hobby[i];
            h.checked = false;

        }
    }
</script>

</html>
<?php
$connect->close();
?>