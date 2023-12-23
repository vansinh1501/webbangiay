<?php
$title = 'Thêm/Sửa Tài Khoản Người Dùng';
$baseUrl = '../';
require_once('../layouts/header.php');

$id = $msg = $fullname = $email = $phone_number = $address = $role_id = '';
//chạy chung lẫn hàm add và update
require_once('form_save.php');

//Check lấy thông tin người dùng để sửa
$id = getGet('id');
if($id != '' && $id > 0) {
	$sql = "select * from User where id = '$id'";
    $userItem = executeResult($sql, true);
	//Kiểm tra gán mã tồn tại
	if($userItem != null) {
		$fullname = $userItem['fullname'];
		$email = $userItem['email'];
		$phone_number = $userItem['phone_number'];
		$address = $userItem['address'];
		$role_id = $userItem['role_id'];
	} else {
		$id = 0;
	}
} else {
	$id = 0;
}

//Chứa danh sách tất cả các quyền trong hệ thống
$sql = "select * from Role";
$roleItems = executeResult($sql);
?>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12 table-responsive">
        <h3>THÊM/SỬA TÀI KHOẢN NGƯỜI DÙNG</h3>
        <div class="panel panel-primary">
			<div class="panel-heading">
				<h5 style="color: red;"><?=$msg?></h5>
			</div>
			<div class="panel-body">
				<form method="post" onsubmit="return validateForm();">
					<div class="form-group">
					  <label for="usr">Họ & Tên:</label>
					  <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?=$fullname?>">
					  <!--Form phân biệt đâu là trang đăng ký đâu là trang sửa-->
					  <input type="text" name="id" value="<?=$id?>" hidden="true">
					</div>
                    <div class="form-group">
					  <label for="usr">Role:</label>
					  <select class="form-control" name="role_id" id="role_id" required="true">
						<option value="">-- Chọn --</option>
						<?php
						foreach($roleItems as $role) {
							//Kiểm tra role đã tồn tại
							if($role['id'] == $role_id) {
								echo '<option selected value="'.$role['id'].'">'.$role['name'].'</option>';
							}else {
								echo '<option value="'.$role['id'].'">'.$role['name'].'</option>';
							}
						}
						?>
                      </select>
					</div>
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input required="true" type="email" class="form-control" id="email" name="email" value="<?=$email?>">
					</div>
                    <div class="form-group">
					  <label for="phone_number">Số điện thoại:</label>
					  <input required="true" type="tel" class="form-control" id="phone_number" name="phone_number" value="<?=$phone_number?>">
					</div>
                    <div class="form-group">
					  <label for="address">Địa chỉ:</label>
					  <input required="true" type="text" class="form-control" id="address" name="address" value="<?=$address?>">
					</div>  
					<div class="form-group">
					  <label for="pwd">Mật Khẩu:</label>
					  <input <?=($id > 0 ? '' : 'required="true"')?>type="password" class="form-control" id="pwd" name="password" minlength="6">
					</div>
					<div class="form-group">
					  <label for="confirmation_pwd">Xác Minh Mật Khẩu:</label>
					  <input <?=($id > 0 ? '' : 'required="true"')?> type="password" class="form-control" id="confirm_pwd" minlength="6">
					</div>
					<button class="btn btn-success">Đăng Ký</button>
				</form>
			</div>
		</div>
    </div>
</div>
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
<?php
require_once('../layouts/footer.php');
?>
    