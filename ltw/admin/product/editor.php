<?php
/**<div class="form-group">
<label for="email">Thumbnail:</label>
<input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>" onchange="updateThumbnail()">
<img id="thumbnail_img" src="<?=$thumbnail?>" style="max-height: 160px; display: block; margin-left: auto; margin-right: auto; margin-top: 15px; margin-bottom: 15px;">
</div>
- type: text đổi thành type: file
- accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*": chỉ cho phép upload những file này
- upload được file lên server: enctype="multipart/form-data"
*/
$title = 'Thêm/Sửa Sản Phẩm';
$baseUrl = '../';
require_once('../layouts/header.php');

$id = $thumbnail = $title = $price = $discount = $category_id = $description = $quantity = "";
//chạy chung lẫn hàm add và update
require_once('form_save.php');

//Check lấy thông tin người dùng để sửa
$id = getGet('id');
if($id != '' && $id > 0) {
	$sql = "select * from Product where id = '$id' and deleted = 0";
    $userItem = executeResult($sql, true);
	//Kiểm tra gán mã tồn tại
	if($userItem != null) {
		$thumbnail = $userItem['thumbnail'];
		$title = $userItem['title'];
		$price = $userItem['price'];
		$discount = $userItem['discount'];
		$category_id = $userItem['category_id'];
        $description = $userItem['description'];
		$quantity = $userItem['quantity'];
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<div class="row" style="margin-top: 20px;">
   
</div>
<script>
	//Nhúng summernote
      $('#description').summernote({
        placeholder: '...',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
<?php
require_once('../layouts/footer.php');
?>
    