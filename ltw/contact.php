<?php
   require_once("layout/header.php");
   if(!empty($_POST)) {
    $first_name = getPost('first_name');
    $last_name = getPost('last_name');
    $email = getPost('email');
    $phone_number = getPost('phone');
    $subject_name = getPost('subject_name');
    $note = getPost('note');
    $created_at = $updated_at = date('Y-m-d H:i:s');

    $sql = "insert into Feedback(firstname, lastname, email, phone_number, subject_name, note, status, created_at, updated_at) values ('$first_name', '$last_name', '$email', '$phone_number', '$subject_name', '$note', 0, '$created_at', '$updated_at')";
    execute($sql);
   }
?>
<div class="danhmuc">
    <div class="font-danhmuc">
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li>/</li>
            <li>Liên hệ</li>
        </ul>
    </div>
</div>

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

<script type="text/javascript">
    function completeFeedback() {
        alert("Đã gửi phản hồi!");
    }
</script>

</html>