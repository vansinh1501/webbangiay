<?php
require_once('layout/header.php');

//PHÂN TRANG 1
$sql = 'select count(id) as number from Product';
$result = executeResult($sql);
$number = 0;
if($result != null && count($result) > 0) {
    $number = $result[0]['number'];
}
$pages = ceil($number / 20);

$current_page = 1;
if(isset($_GET['page'])) {
    $current_page = $_GET['page'];
}
//Tránh trường hợp cho bừa id page
if($current_page <= 0) {
    $current_page = 1;
}
$index = ($current_page - 1) * 4;
$sql = 'select * from Product limit '.$index.', 4';
$result = executeResult($sql);

//Sản phẩm hot
$sql = "select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id order by updated_at desc limit 0,4";//4 là lấy ra 4 sản phẩm
$lastestItems = executeResult($sql);

$sql = "select * from News limit 0,3";
$news = executeResult($sql);

?>
        <div class="slider">
            <div class="slider-wrapper">
                <ul class="riot-slider" data-do-console-log="true" data-use-material-icons="true"
                    data-is-auto-play="true" data-do-show-buttons="false" data-do-swipe-on-touchscreen="true"
                    data-button-number-display="default" data-previous-next-display="sides" data-theme="default"
                    data-slide-hold-seconds="6">
                    <li>
                        <img src="images/backgrounds/background-nike-lucent-pack.PNG" alt="Alt Text" />
                    </li>
                    <li>
                        <img src="images/backgrounds/background-adidas-diamond-edge.PNG" alt="Alt Text" />
                    </li>
                    <li>
                        <img src="images/backgrounds/background-puma-fastest-pack.PNG" alt="Alt Text" />
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="content-title">
                <h2>SẢN PHẨM HOT</h2>
            </div>
            <div class="product-grid">
                    <?php
                    foreach($result as $item) {
                        echo'
                        <div class="product">
                        <a href="detail.php?id='.$item['id'].'">
                        <img src="'.$item['thumbnail'].'"></a>
                        <div class="detail-mini-product">
                        <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                        </div>
                        <div class="price-product">
                        <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                        </div>
                        </div>';
                    }
                    ?> 
            </div>
            <ul class="pagination">
                <?php
                if($current_page > 1) {
                    echo '
                    <li><a href="?page=' . ($current_page - 1) . '">«</a></li>
                    ';
                }
                
                for ($i=1; $i <= $pages && $pages > 1; $i++) {
                    if($i == $current_page) {
                        echo '<li class="active"><a href="?page='.$i.'">'.$i.'</a></li>';
                    } else {
                        echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                    }                                             
                }
                if($current_page < $pages) {
                    echo '
                    <li><a href="?page='.($current_page + 1).'">»</a></li>
                    '; 
                }   
                ?> 
            </ul>
        </div>
        <div class="content">
            <div class="content-title">
                <h2>THƯƠNG HIỆU</h2>
            </div>
            <div class="thuonghieu-grid">
                <div class="images-thuonghieu">
                    <a href="#" title="GIÀY ĐÁ BANH NIKE"><img src="images/thuonghieu/Giày đá banh Nike.PNG" alt=""></a>
                    <div class="font-thuonghieu"><a href="#" title="GIÀY ĐÁ BANH NIKE">GIÀY ĐÁ BANH NIKE</a></div>
                </div>
                <div class="images-thuonghieu">
                    <a href="#" title="GIÀY ĐÁ BANH ADIDAS"><img src="images/thuonghieu/Giày đá banh adidas.PNG"
                            alt=""></a>
                    <div class="font-thuonghieu"><a href="#" title="GIÀY ĐÁ BANH ADIDAS">GIÀY ĐÁ BANH ADIDAS</a></div>
                </div>

                <div class="images-thuonghieu">
                    <a href="#" title="GIÀY ĐÁ BANH PUMA"><img src="images/thuonghieu/Giày đá banh Puma.PNG" alt=""></a>
                    <div class="font-thuonghieu" title="GIÀY ĐÁ BANH PUMA"><a href="#">GIÀY ĐÁ BANH PUMA</a></div>
                </div>

                <div class="images-thuonghieu">
                    <a href="#" title="GIÀY ĐÁ BANH MIZUNO"><img src="images/thuonghieu/Giày đá banh Mizuno.PNG"
                            alt=""></a>
                    <div class="font-thuonghieu"><a href="category_mizuno.php" title="GIÀY ĐÁ BANH MIZUNO">GIÀY ĐÁ BANH MIZUNO</a></div>
                </div>

                <div class="images-thuonghieu">
                    <a href="#" title="GIÀY ĐÁ BANH ASICS"><img src="images/thuonghieu/GIÀY ĐÁ BANH ASICS.PNG"
                            alt=""></a>
                    <div class="font-thuonghieu"><a href="#" title="GIÀY ĐÁ BANH ASICS">GIÀY ĐÁ BANH ASICS</a></div>
                </div>
                <div class="images-thuonghieu">
                    <a href="#" title="GIÀY ĐÁ BANH KAMITO"><img src="images/thuonghieu/Giày đá banh Kamito.PNG"
                            alt=""></a>
                    <div class="font-thuonghieu"><a href="#" title="GIÀY ĐÁ BANH KAMITO">GIÀY ĐÁ BANH KAMITO</a></div>
                </div>
            </div>
        </div>
        <div class="tintuc">
            <div class="content-title">
                <h2>TIN TỨC GIÀY</h2>
            </div>
            <div class="tintuc-grid">
                <?php
                foreach($news as $item){
                echo '
                <div class="tintuc-picture">
                    <a href=""><img src='.$item['thumbnail'].' alt=""></a>
                    <div class="tintuc-font">
                        <a href="">
                            <h3>'.$item['title'].'
                            </h3>
                            <span>'.$item['description'].'</span>
                        </a>
                        
                    </div>
                </div>';}
                ?>
            </div>
            <div class="xemtatca">
                <div class="xemtatca-font">
                    <a href="news.php">XEM TẤT CẢ <i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
<?php
require_once('layout/footer.php');
?>