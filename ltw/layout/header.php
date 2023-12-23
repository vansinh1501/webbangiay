<?php
session_start();
require_once('utils/utility.php');
require_once('database/dbhelper.php');
require_once('authen/process_form_register.php');
require_once('authen/process_form_login.php');

//Lấy dữ liệu từ db
$sql = "select * from Category";
$menuItems = executeResult($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="icon" type="image/png" href="https://www.iconpacks.net/icons/1/free-soccer-shoe-icon-469-thumb.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="responsive-carousel-riot/riot-slider.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="responsive-carousel-riot/riot-slider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
</head>

<body>

    <div class="wrap">
        <div class="menu">
            <div class="header-menu">
                <ul>
                    <li>
                        <p class="slogan-menu">STORE - SINCE 2022 - LUÔN CAM KẾT HÀNG CHÍNH HÃNG</p>
                    </li>
                    <li class="account">Tài khoản<i class="fa-solid fa-caret-down"></i>
                        <div class="sub-list-account">
                            <ul class="sub-menu-account">
                                <?php
                                $user_id = getCookie('user_id');

                                if ($user_id == '') {
                                    $sql = "select * from User ";
                                    $userItems = executeResult($sql, true);
                                    echo '
                                        <li><a href="register.php">Đăng ký</a></li>
                                        <li><a href="login.php">Đăng nhập</a></li>
                                        ';
                                } else if($user_id != '') {
                                    $sql = "select * from User where id = $user_id";
                                $userItems = executeResult($sql, true);
                                echo '
                                        <li><a href="">' . $userItems['fullname'] . '</a></li>
                                        <li><a href="logout.php">Đăng xuất</a></li>
                                    ';
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="bottom-menu">
                <div class="search-menu">
                    <div class="search"><input class="input" type="text" placeholder="Bạn đang tìm kiếm...">
                        <button class="button-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <?php
                //Kiểm tra không tồn tại gán mã rỗng
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                $count = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $count += $item['num'];
                }
                ?>
                <span class="icon-cart">
                    <a href="cart.php">
                        <span class="cart_count"><?= $count ?></span>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </span>
                <div class="product-menu">
                    <ul class="product-menu--navbar">
                        <li><a href="index.php" title="TRANG CHỦ"><span>TRANG CHỦ</span></a></li>
                        <li>
                            <a href="" title="GIÀY BÓNG ĐÁ">
                                <span>GIÀY BÓNG ĐÁ</span><i class="fa-solid fa-caret-down"></i>
                            </a>
                            <div class="sub-list">
                                <ul class="sub-menu">
                                    <?php
                                    foreach ($menuItems as $item) {
                                        echo
                                        '<li><a href="category.php?id=' . $item['id'] . '">' . $item['name'] . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                        <li><a href="news.php" title="TIN TỨC GIÀY"><span>TIN TỨC GIÀY</span></a></li>
                        <li><a href="" title="KHÁCH HÀNG"><span>KHÁCH HÀNG</span></a></li>
                        <li><a href="contact.php" title="LIÊN HỆ"><span>LIÊN HỆ</span></a></li>
                    </ul>
                </div>
            </div>
        </div>