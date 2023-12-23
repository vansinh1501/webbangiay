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
<div class="container-contact">
            <form method="post">
            <div class="wrap-contact">
                <div class="title-contact">
                    LIÊN HỆ                    
                </div>
                <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
	<form method="post">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <input required="true" type="text" class="form-control2" id="usr" name="first_name" placeholder="Nhập tên">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <input required="true" type="text" class="form-control2" id="usr" name="last_name" placeholder="Nhập họ">
					</div>
				</div>
			</div>
			<div class="form-group">
			  <input required="true" type="email" class="form-control2" id="email" name="email" placeholder="Nhập email">
			</div>
			<div class="form-group">
			  <input required="true" type="tel" class="form-control2" id="phone" name="phone" placeholder="Nhập sđt">
			</div>
			<div class="form-group">
			  <input required="true" type="text" class="form-control2" id="subject_name" name="subject_name" placeholder="Nhập chủ đề">
			</div>
			<div class="form-group">
			  <label for="pwd">Nội dung:</label>
			  <textarea class="form-control2" rows="3" name="note"></textarea>
			</div>
			<button class="contact-submit" onclick="completeFeedback();">GỬI</button>
		</div>
		<div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d245.01149750836305!2d106.61861264538626!3d10.720290190670648!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752de59fbc5591%3A0x249067e45c9368d8!2zSOG6u20gMTE5IEFuIETGsMahbmcgVsawxqFuZywgQW4gTOG6oWMsIELDrG5oIFTDom4sIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1669820124117!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</form>
</div>
            </div>
         </form>
        </div>

<?php
require_once("layout/footer.php");
?>
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