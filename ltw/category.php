<?php
require_once('layout/header.php');

$category_id = getGet('id');

$sql = "select * from Category";
$data = executeResult($sql);

if ($category_id == null || $category_id == '') {
    $sql = "select Product.*, Category.name as category_name = from Product left join Category on Product.category_id = Category.id order by Product.updated_at desc limit 0,12";
} else {
    $sql = "select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id where Product.category_id = $category_id order by Product.updated_at desc limit 0,12";
}

$lastestItems = executeResult($sql);

$sql = "select Banner.*, Category.name as category_name from Banner left join Category on Banner.category_id = Category.id";
$banner = executeResult($sql);


?>
<div class="danhmuc">
    <div class="font-danhmuc">
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li>/</li>
            <li><a href="">Danh mục</a></li>
            <li>/</li>
            <li><?php
                foreach ($data as $item) {
                    if ($item['id'] == $category_id) {
                        echo $item['name'];
                    }
                }
                ?></li>
        </ul>
    </div>
</div>
<div class="wrap-danhmuc">
    <div class="grid-danhmuc">
        <div class="grid-search-danhmuc">
            <ul class="font-gia-thuonghieu-size">
                <h4 class="font-title-danhmuc">GIÁ</h4>
                <li>
                    <label for="">
                        <input type="radio" name="price" value='0' onclick="layTien(this)">
                        <span>Tất cả</span>
                    </label>
                </li>
                <li>
                    <label for="">
                        <input type="radio" name="price" value='1' onclick="layTien(this)">
                        <span> Dưới 1,000,000₫</span>
                    </label>
                </li>
                <li>
                    <label for="">
                        <input type="radio" name="price" value='2' onclick="layTien(this)">
                        <span> 1,000,000₫- 2,000,000₫</span>
                    </label>
                </li>
                <li>
                    <label for="">
                        <input type="radio" name="price" value='3' onclick="layTien(this)">
                        <span>2,000,000₫- 3,000,000₫</span>
                    </label>
                </li>
                <li>
                    <label for="">
                        <input type="radio" name="price" value='4' onclick="layTien(this)">
                        <span>3,000,000₫- 4,000,000₫</span>
                    </label>
                </li>
                <li>
                    <label for="">
                        <input type="radio" name="price" value='5' onclick="layTien(this)">
                        <span> Trên 4,000,000₫</span>
                    </label>
                </li>

            </ul>
            <ul class="font-gia-thuonghieu-size">
                <h4 class="font-title-danhmuc">THƯƠNG HIỆU</h4>
                <li>
                    <label for="">
                        <input type="checkbox" name="thuonghieu">
                        <span><?php
                                foreach ($data as $item) {
                                    if ($item['id'] == $category_id) {
                                        echo $item['name'];
                                    }
                                }
                                ?></span>
                    </label>
                </li>
            </ul>
        </div>
        <div class="grid-product-danhmuc">
            <div class="background-danhmuc">
                <?php
                foreach ($banner as $item) {
                    if ($item['category_id'] == $category_id) {
                        echo '
                            <img src="' . $item['thumbnail'] . '" alt="">
                            ';
                    }
                }
                ?>
            </div>
            <div class="grid-2-col-giayconhantao-danhmuc">
                <div class="font-first-col-giayconhantao-danhmuc">
                    <h1>GIÀY CỎ NHÂN TẠO <?php
                                            foreach ($data as $item) {
                                                if ($item['id'] == $category_id) {
                                                    echo $item['name'];
                                                }
                                            }
                                            ?></h1>
                </div>
                <!-- <div class="second-col-sapxeptheo-giayconhantao-danhmuc">
                    <label for="">Sắp xếp theo: </label>
                </div> -->
                <!-- <form>
                    <div class="third-col-sapxeptheo-giayconhantao-danhmuc">
                        <select name="sort">
                            <option value="0" onclick="sort(this)">Sản phẩm nổi bật</option>
                            <option value="1" onclick="sort(this)">Giá: Tăng dần</option>
                            <option value="2" onclick="sort(this)">Giá: Giảm dần</option>
                            <option value="3" onclick="sort(this)">Tên: A-Z</option>
                            <option value="4" onclick="sort(this)">Tên: Z-A</option>
                        </select>
                    </div>
                </form> -->
            </div>
            <div class="grid-product" id='app'>               
                <script type="text/javascript">
                    var app=document.getElementById('app');
                    app.innerHTML= `<?php
                            foreach ($lastestItems as $item) {
                                echo '
                                <div class="rows-product-danhmuc">
                                <a href="detail.php?id='.$item['id'].'">
                                <img src="'.$item['thumbnail'].'"></a>
                                <div class="font-giayconhantao-danhmuc">
                                <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                                </div>
                                <div class="price-product">
                                <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                                </div>
                                </div>';
                            }
                            ?>`

                    function layTien(event) {
                        if (event.value == "0") {
                            app.innerHTML = `
                            <?php
                            foreach ($lastestItems as $item) {
                                echo '
                                <div class="rows-product-danhmuc">
                                <a href="detail.php?id='.$item['id'].'">
                                <img src="'.$item['thumbnail'].'"></a>
                                <div class="font-giayconhantao-danhmuc">
                                <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                                </div>
                                <div class="price-product">
                                <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                                </div>
                                </div>';
                            }
                            ?>`
                        }

                        if (event.value == "1") {
                            app.innerHTML = `
                            <?php
                            $bien = 0;
                            foreach ($lastestItems as $item) {
                                if($item['discount'] <= 1000000)
                                {
                                    $bien++;
                                    echo '
                                    <div class="rows-product-danhmuc">
                                    <a href="detail.php?id='.$item['id'].'">
                                    <img src="'.$item['thumbnail'].'"></a>
                                    <div class="font-giayconhantao-danhmuc">
                                    <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                                    </div>
                                    <div class="price-product">
                                    <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                                    </div>
                                    </div>';
                                }
                            }
                            if($bien == 0){
                                echo '<h3>Không có sản phẩm</h3>';
                            }
                            ?>`
                        }
                        
                        if (event.value == "2") {
                            app.innerHTML = `
                            <?php
                            $bien = 0;
                            foreach ($lastestItems as $item) {
                                if($item['discount'] >= 1000000 && $item['discount'] <= 2000000)
                                {
                                    $bien++;
                                    echo '
                                    <div class="rows-product-danhmuc">
                                    <a href="detail.php?id='.$item['id'].'">
                                    <img src="'.$item['thumbnail'].'"></a>
                                    <div class="font-giayconhantao-danhmuc">
                                    <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                                    </div>
                                    <div class="price-product">
                                    <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                                    </div>
                                    </div>';
                                }
                            }
                            if($bien == 0){
                                echo '<h3>Không có sản phẩm</h3>';
                            }
                            ?>`
                        }

                        if (event.value == "3") {
                            app.innerHTML = `
                            <?php
                            $bien = 0;
                            foreach ($lastestItems as $item) {
                                if($item['discount'] >= 2000000 && $item['discount'] <= 3000000)
                                {
                                    $bien++;
                                    echo '
                                    <div class="rows-product-danhmuc">
                                    <a href="detail.php?id='.$item['id'].'">
                                    <img src="'.$item['thumbnail'].'"></a>
                                    <div class="font-giayconhantao-danhmuc">
                                    <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                                    </div>
                                    <div class="price-product">
                                    <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                                    </div>
                                    </div>';
                                }
                            }
                            if($bien == 0){
                                echo '<h3>Không có sản phẩm</h3>';
                            }
                            ?>`
                        }

                        if (event.value == "4") {
                            app.innerHTML = `
                            <?php
                            $bien = 0;
                            foreach ($lastestItems as $item) {
                                if($item['discount'] >= 3000000 && $item['discount'] <= 4000000)
                                {
                                    $bien++;
                                    echo '
                                    <div class="rows-product-danhmuc">
                                    <a href="detail.php?id='.$item['id'].'">
                                    <img src="'.$item['thumbnail'].'"></a>
                                    <div class="font-giayconhantao-danhmuc">
                                    <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                                    </div>
                                    <div class="price-product">
                                    <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                                    </div>
                                    </div>';
                                }
                            }
                            if($bien == 0){
                                echo '<h3>Không có sản phẩm</h3>';
                            }
                            ?>`
                        }

                        if (event.value == "5") {
                            app.innerHTML = `
                            <?php
                            $bien = 0;
                            foreach ($lastestItems as $item) {
                                if($item['discount'] >= 4000000)
                                {
                                    $bien++;
                                    echo '
                                    <div class="rows-product-danhmuc">
                                    <a href="detail.php?id='.$item['id'].'">
                                    <img src="'.$item['thumbnail'].'"></a>
                                    <div class="font-giayconhantao-danhmuc">
                                    <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                                    </div>
                                    <div class="price-product">
                                    <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                                    </div>
                                    </div>';
                                }
                            }
                            if($bien == 0){
                                echo '<h3>Không có sản phẩm</h3>';
                            }
                            ?>`
                        }                        
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<?php
require_once('layout/footer.php');
?>