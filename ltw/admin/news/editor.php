<?php
$title = 'Thêm/Sửa Tin Tức';
$baseUrl = '../';
require_once('../layouts/header.php');

$id = $thumbnail = $title = $description = "";
//chạy chung lẫn hàm add và update
require_once('form_save.php');

//Check lấy thông tin người dùng để sửa
$id = getGet('id');
if($id != '' && $id > 0) {
	$sql = "select * from News where id = '$id'";
    $newsItem = executeResult($sql, true);
	//Kiểm tra gán mã tồn tại
	if($newsItem != null) {
		$thumbnail = $newsItem['thumbnail'];
		$title = $newsItem['title'];
		$description = $newsItem['description'];
	} else {
		$id = 0;
	}
} else {
	$id = 0;
}
?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12 table-responsive">
        <h3>THÊM/SỬA TIN TỨC</h3>
        <div class="panel panel-primary">
			<div class="panel-body">
				<form action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-9 col-12">
					<div class="form-group">
					  <label for="usr">Tiêu đề: </label>
					  <input required="true" type="text" class="form-control" id="usr" name="title" value="<?=$title?>">
					  <input type="text" name="id" value="<?=$id?>" hidden="true">
					</div>
					<div class="form-group">
					  <label for="pwd">Nội dung:</label>
					  <textarea class="form-control" name="description" id="description" cols="30" rows="5"><?=$description?></textarea>
					</div>
					<button class="btn btn-success">Lưu</button>
					</div>
					<div class="col-md-3 col-12"  style="border: solid gray 1px; padding-top: 10px; padding-bottom: 10px;">
					<div class="form-group">
					<div class="form-group">
					  <label for="email">Thumbnail:</label>
					  <input required="true" type="file" class="form-control" id="thumbnail" name="thumbnail" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
					  <img id="thumbnail_img" src="<?=fixUrl($thumbnail)?>" style="max-height: 140px; display: block; margin-left: auto; margin-right: auto; margin-top: 15px; margin-bottom: 15px;">
					</div>
					</div>
					</div>
				</div>
			   </form>
			</div>
		</div>
    </div>
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
    