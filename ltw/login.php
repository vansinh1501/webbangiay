<?php
include('layout/header.php');

require_once('utils/utility.php');
require_once('database/dbhelper.php');
require_once('authen/process_form_login.php');

?>
<div class="danhmuc">
            <div class="font-danhmuc">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>/</li>
                    <li><a href="">Tài khoản</a></li>
                </ul>
            </div>
        </div>
	<div class="wrap-login">
            <form method="post">
            <div class="form-login">
                <div class="grid-form-login">
                    <div class="title-login">
                        <h1>Đăng nhập</h1>
                        <h5 class="text-center"><?=$msg?></h5>
                    </div>
                    <div class="grid-form-detail-login">
                            <div class="font-form-detail-login">
                                <label for="">EMAIL: </label><br>
                                <input class="control-register" type="text" placeholder="Nhập Email của bạn" id="email" required="true" name="email" value="">
                            </div>
                            <div class="font-form-detail-login">
                                <label for="">MẬT KHẨU: </label><br>
                                <input class="control-login" type="password" placeholder="Nhập Mật khẩu" id="pwd" name="password" required="true" value="">
                            </div>
                    </div> 
                    <div class="login-action">
                        <input class="button-login" type="submit" value="Đăng nhập"></input>
                        Bạn chưa có tài khoản?<a href="register.php" class="font-login-action"> <b>Đăng ký ngay</b></a><br>
                    </div>
                </div>
            </div>
         </form>
        </div>
<?php

include('layout/footer.php');
?>