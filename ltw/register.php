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