<?php
include('layout/header.php');

require_once('utils/utility.php');
require_once('database/dbhelper.php');
require_once('authen/process_form_register.php');

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
        <div class="wrap-register">
            <form method="post" onsubmit="return validateForm();">
            <div class="form-register">
                <div class="grid-form-register">
                    <div class="title-register">
                        <h1>Đăng ký</h1> <h5 class="text-center"><?=$msg2?></h5> 
                    </div>
                    <div class="grid-form-detail-register">
                            <div class="font-form-detail-register">
                                <label for="">HỌ & TÊN: </label><br>
                                <input class="control-register" type="text" id="usr" required="true" name="fullname" value="<?=$fullname?>">
                            </div>
                            <div class="font-form-detail-register">
                                <label for="">EMAIL: </label><br>
                                <input class="control-register" type="email" id="email" required="true" name="email" value="<?=$email?>">
                            </div>
                            <div class="font-form-detail-register">
                                <label for="">MẬT KHẨU: </label><br>
                                <input class="control-register" type="password" id="pwd" required="true" name="password" minlength="6">
                            </div>
                            <div class="font-form-detail-register">
                                <label for="">NHẬP LẠI MẬT KHẨU: </label><br>
                                <input class="control-register" type="password" id="confirm_pwd" required="true" minlength="6" name="repassword">
                            </div>
                    </div>
                    <div class="register-action">
                        <input class="button-register" type="submit" value="Đăng ký"></input>
                        Bạn đã có tài khoản?<a href="login.php" class="font-register-action"><b>Đăng nhập</b></a>
                    </div>
                </div>
            </div>
        </form>
        </div>

            <div id="backtop">
                <i class="fa-solid fa-chevron-up"></i>
            </div>
<?php
include('layout/footer.php');
?>
    <script type="text/javascript">
        function validateForm() {
            $pwd = $('#pwd').val();
            $confirmPwd = $('#confirm_pwd').val();
            if($pwd != $confirmPwd) {
                alert("Mật khẩu không khớp, vui lòng kiểm tra lại")
                return false
            }
            return true
        }
    </script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(window).scroll(function(){
            if($(this).scrollTop()){
                $('#backtop').fadeIn();
            }else {
                $('#backtop').fadeOut();
            }
        });
        $('#backtop').click(function(){
            $('html,body').animate({
                scrollTop: 0
            }, 800);
        });
    });
</script>
</html>