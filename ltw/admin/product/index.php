<?php
$title = 'Quản Lý Sản Phẩm';
$baseUrl = '../';
require_once('../layouts/header.php');

$page = 1;
if(isset($_GET['page'])) {  
    $page = $_GET['page'];
}
//Tránh trường hợp cho bừa id page
if($page <= 0) {
    $page = 1;
}
$currentIndex = ($page - 1) * PAGE_NUMBER_MAX;

$sql = "select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id where Product.deleted = 0 limit $currentIndex, " . PAGE_NUMBER_MAX;
if(isset($_POST['search'])){
  $s = $_POST['txtsearch'];
  $sql = "select Product.*, Category.name as category_name from Product join Category on Product.category_id = Category.id where Product.title like '%$s%' Order By id desc";
}
$data = executeResult($sql);

$sql = "select count(*) as 'Total' from Product";
$count = executeResult($sql);
//Tổng số bảng ghi
$total = $count[0]['Total'];
$numpage = ceil($total / PAGE_NUMBER_MAX);
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12 table-responsive">
        <h3>QUẢN LÝ SẢN PHẨM</h3>
        <a href="editor.php"><button class="btn btn-success">Thêm Sản Phẩm</button></a>  
<form class="form-control form-control-dark w-100" method="post" action="index.php?act=sanpham">
  <input type="text" placeholder="Tìm kiếm" name="txtsearch"/>
  <input type="submit" name="search" value="Search"/>
  </form>
        <table class="table table-bordered table-hover" style="margin-top: 20px;"> 
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Thumbnail</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Tồn kho</th>    
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
                    <td>'.$item['title'].'</td>
                    <td>'.number_format($item['discount']).'₫</td>
                    <td>'.$item['category_name'].'</td>
                    <td>'.$item['quantity'].'</td>
                    <td style="width: 50px;">
                      <a href="editor.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
                    </td> 
                    <td style="width: 50px;">
                        <button onclick="deleteProduct('.$item['id'].')" class="btn btn-danger">Xóa</button>
                    </td>    
                </tr>';
                }
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
  <ul class="pagination">
    
    <?php
    if($page > 1) {
      echo '<li class="page-item">
      <a class="page-link" href="?page='.($page - 1).'" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';      
    }

    //Trường hợp xuất hiện 1 vài page tránh quá dài 
    $pageAvailabel = [ 1 , 2 , $page - 1, $page , $page + 1, $numpage - 1, $numpage];
    $isFirst = false;
    $isBefore = false;

    //Trường hợp hiển thị hết toàn bộ sản phẩm , sẽ mất luôn số page : $numpage > 1
    for($i = 1 ; $i <= $numpage && $numpage > 1 ; $i++) {
      //Trường hợp xuất hiện 1 vài page tránh quá dài 
      if(!in_array($i, $pageAvailabel)) {
        if($i < $page && !$isFirst) {
          echo '<li class="page-item"><a class="page-link" href="?page='.($page - 2).'">...</a></li>';
          $isFirst = true;
        }
        if($i > $page && !$isBefore) {
          echo '<li class="page-item"><a class="page-link" href="?page='.($page + 2).'">...</a></li>';
          $isBefore = true;
        }
        continue;
      }

      if($i == $page) {
        echo '<li class="page-item active"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
      } else {
        echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
      }    
    }
    if($page < $numpage) {
      echo '<li class="page-item">
      <a class="page-link" href="?page='.($page + 1).'" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>';      
    }
    ?>   
  </ul>
</nav>
    </div>
</div>
<script type="text/javascript">
    function deleteProduct(id) {
        option = confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
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
