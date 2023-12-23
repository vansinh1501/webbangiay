<?php
$title = 'Quản Lý Banner';
$baseUrl = '../';
require_once('../layouts/header.php');

$sql = "select Banner.*, Category.name as category_name from Banner left join Category on Banner.category_id = Category.id where Banner.deleted = 0";
$data = executeResult($sql);
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12 table-responsive">
        <h3>QUẢN LÝ BANNER</h3>
        <a href="editor.php"><button class="btn btn-success">Thêm Banner</button></a>  
<form class="form-control form-control-dark w-100" method="post" action="index.php?act=banner">
  </form>
        <table class="table table-bordered table-hover" style="margin-top: 20px;"> 
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Thumbnail</th>
                    <th>Danh mục</th>
                    <th style="width: 50px;"></th>
                    <th style="width: 50px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 0;
                foreach($data as $item) {
                    echo '<tr>
                    <th>'.(++$index).'</th>
                    <td><img src="'.fixUrl($item['thumbnail']).'" style="height: 100px"/></td>
                    <td>'.$item['category_name'].'</td>
                    <td style="width: 50px;">
                      <a href="editor.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
                    </td> 
                    <td style="width: 50px;">
                        <button onclick="deleteBanner('.$item['id'].')" class="btn btn-danger">Xóa</button>
                    </td>    
                </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Cho phép xóa người dùng -->
<script type="text/javascript">
    function deleteBanner(id) {
        option = confirm('Bạn có chắc chắn muốn xóa banner này không?');
        if(!option) return;
        $.post('form_api.php', {
            'id': id,
            'action': 'delete'
        }, function(data) {
            location.reload()
        })
    }
</script>

<?php
require_once('../layouts/footer.php');
?>

