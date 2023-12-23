<?php
$title = 'Thêm/Sửa Banner';
$baseUrl = '../';
require_once('../layouts/header.php');

$id = $thumbnail = $category_id = "";
//chạy chung lẫn hàm add và update
require_once('form_save.php');

//Check lấy thông tin người dùng để sửa
$id = getGet('id');
if($id != '' && $id > 0) {
	$sql = "select * from Banner where id = '$id' and deleted = 0";
    $bannerItem = executeResult($sql, true);
	//Kiểm tra gán mã tồn tại
	if($bannerItem != null) {
		$thumbnail = $bannerItem['thumbnail'];
		$category_id = $bannerItem['category_id'];
	} else {
		$id = 0;
	}
} else {
	$id = 0;
}

//Chứa danh sách tất cả các quyền trong hệ thống
$sql = "select * from Category";
$categoryItems = executeResult($sql);
?>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12 table-responsive">
        <h3>THÊM/SỬA BANNER</h3>
        <div class="panel panel-primary">
			<div class="panel-body">
				<form action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-9 col-12">
					<div class="form-group">
                    <label for="email">Banner:</label>
					  <input required="true" type="file" class="form-control" id="thumbnail" name="thumbnail" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
					  <img id="thumbnail_img" src="<?=fixUrl($thumbnail)?>" style="max-height: 200px; display: block; margin-left: auto; margin-right: auto; margin-top: 15px; margin-bottom: 15px;">
					</div>
					<div class="form-group">
					</div>
					<button class="btn btn-success">Lưu</button>
					</div>
					<div class="col-md-3 col-12" style="border: solid gray 1px; padding-top: 10px; padding-bottom: 10px;">
					<div class="form-group">
					  <label for="usr">Danh Mục Sản Phẩm:</label>
					  <select class="form-control" name="category_id" id="category_id" required="true">
						<option value="">-- Chọn --</option>
						<?php
						foreach($categoryItems as $item) {
							//Kiểm tra role đã tồn tại
							if($item['id'] == $category_id) {
								echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
							}else {
								echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
							}
						}
						?>
                      </select>
					</div>		
					</div>
				</div>
			   </form>
			</div>
		</div>
    </div>
</div>
<?php
require_once('../layouts/footer.php');
?>