<?php
require_once('layout/header.php');

$productId = getGet('id');

$sql = "select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id where Product.id = $productId";
$product = executeResult($sql, true);

$category_id = $product['category_id'];
$sql = "select Product.*, Category.name as category_name from Product left join Category on Product.category_id = Category.id where Product.category_id = $category_id order by Product.updated_at desc limit 0,4";

$lastestItems = executeResult($sql);

$format_sale = ((($product['price'] - $product['discount']) / $product['price']) * 100);
?>
        <div class="danhmuc">
            <div class="font-danhmuc">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>/</li>
                    <li><?=$product['title']?></li>
                </ul>
            </div>
        </div>
        <div class="wrap-detail-product"> 
            <div class="grid-detail-left">
                <div class="grid-details-left-slider">
                    <ul id="">
                        <li>
                            <img class="" src="<?=$product['thumbnail']?>" style="width: 400px">                            
                        </li>                     
                    </ul>
                </div>
                <div class="detail-info-product">
                    <h1><?=$product['title']?></h1>
                    <p>Loại: <?=$product['category_name']?></p>
                    <span><?=number_format($product['discount'])?>₫</span><br>
                    <?php 
                    if($product['discount'] < $product['price'] ) { ?>
                    <del style="font-size: 15px; color: grey; margin-top: 15px; margin-bottom: 15px;"><?=number_format($product['price'])?>₫</del>
                    <span style="background: #d9121f; color: #fff; font-size: 16px; padding: 5px 7px; border-radius: 0px;">-<?=round($format_sale)?>%</span>
                    <?php } ?>
                    <!-- <h4>Kích thước: </h4> -->
                    <!-- <div class="size-detail-product">
                        <label for="">
                            <input type="radio" name="size" value="40" id="40">40</input>
                        </label>
                        <label for="">
                            <input type="radio" name="size" value="43" id="43">43</input>
                        </label>
                    </div>      -->
                    <div class="amount-detail-product">
                        <label for="">Tồn kho:</label>
                        <label for="" id="tonkho"><?php echo $product['quantity']?></label>
                    </div>               
                    <?php
                    if($product['quantity'] > 0) { ?>
                    <div class="amount-detail-product">
                    </div>
                    <div>
                        <button class="add-cart" onclick="addCart(<?=$product['id']?>, $('[name=num]').val())"><a href="">Thêm vào giỏ</a></button>
                    </div>
                    <?php } else { ?>
                        <span class="error-hethang">Hết hàng</span>
                        <?php } ?>
                    <div class="amount-detail-product">
                        <label for="">Số lượng:</label>
                    </div>
                    <div class="button-amount-detail-product">
                    <button class="button-subtraction" onclick="addMoreCart(-1)">-</button>
                        <input disabled class="text-amount" type="number" name="num" step="1" value="1" onchange="fixCartNum()">
                        <button class="button-addition" onclick="addMoreCart(1)">+</button>
                    </div>
                    <div class="grid-uudai">
                        <div class="icon-uudai">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div class="grid-detail-uudai">
                            <div class="title-uudai">
                                <h3>ƯU ĐÃI TẶNG KÈM</h3>
                            </div>
                            <div class="policy-uudai">
                                <span>Tặng kèm vớ dệt kim và balô chống thấm đựng giày cho mỗi đơn hàng Giày đá bóng trên 1 triệu.</span>
                            </div>
                        </div>
                        <div class="icon-uudai">
                            <i class="fa-solid fa-rotate"></i>
                        </div>
                        <div class="grid-detail-uudai">
                            <div class="title-uudai">
                                <h3>ĐỔI HÀNG DỄ DÀNG</h3>
                            </div>
                            <div class="policy-uudai">
                                <span>Hỗ trợ khách hàng đổi size hoặc mẫu trong vong 7 ngày. (Sản phẩm chưa qua sử dụng).</span>
                            </div>
                        </div>
                        <div class="icon-uudai">
                            <i class="fa-solid fa-truck"></i>
                        </div>
                        <div class="grid-detail-uudai">
                            <div class="title-uudai">
                                <h3>CHÍNH SÁCH GIAO HÀNG</h3>
                            </div>
                            <div class="policy-uudai">
                                <span>TCOD Toàn quốc | Freeship toàn quốc khi khách hàng thanh toán chuyển khoản trước với đơn hàng Giày đá bóng trên 1 triệu.</span>
                            </div>
                        </div>
                        <div class="icon-uudai">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M20 4H4c-1.103 0-2 .897-2 2v2h20V6c0-1.103-.897-2-2-2zM2 18c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-6H2v6zm3-3h6v2H5v-2z"></path></svg>
                        </div>
                        <div class="grid-detail-uudai">
                            <div class="title-uudai">
                                <h3>THANH TOÁN TIỆN LỢI</h3>
                            </div>
                            <div class="policy-uudai">
                                <span>Chấp nhận các loại hình thanh toán bằng thẻ, tiền mặt, chuyển khoản.</span>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
            <div class="content">
                <div class="content-title">
                    <h2>MÔ TẢ SẢN PHẨM</h2>
                </div>
                <div class="description">
                    <p><span><?=$product['description']?></span></p>
                </div>
            </div>
            <div class="content">
                <div class="content-title">
                    <h2>SẢN PHẨM LIÊN QUAN</h2>
                </div>
                <div class="grid-sanphamlienquan">
                <?php
                    foreach($lastestItems as $item) {
                        echo'
                        <div class="rows-product-danhmuc">
                        <div class="img-product-sanphamlienquan">
                        <a href="detail.php?id='.$item['id'].'">
                        <img src="'.$item['thumbnail'].'"></a>
                        <div class="font-sanphamlienquan">
                        <p><a href="detail.php?id='.$item['id'].'">'.$item['title'].'</a></p>
                        </div>
                        <div class="price-sanphamlienquan">
                        <p><a href="detail.php?id='.$item['id'].'">'.number_format($item['discount']).'₫</a></p>
                        </div>
                        </div>
                        </div>';
                    }
                    ?> 
                </div>
                <div class="button-xemthem">
                    <a href="<?php
                     echo 'category.php?id='.$lastestItems[0]['category_id'].'';
                     ?>">Xem thêm</a>
                </div>
            </div>
        </div>
<script type="text/javascript">
    //Bắt sự kiện số lượng tăng 1 và giảm đi 1 không về âm
    function addMoreCart(delta) {
        num = parseInt($('[name=num]').val())
        num += delta
        if (num < 1 ) 
             num = 1;
        if(num > <?php echo $product['quantity'] ?>){
            num = <?php echo $product['quantity'] ?> ;
            alert("Số lượng sản phẩm tồn kho còn " + num +" sản phẩm")
        }
        $('[name=num]').val(num)
    }

    //Sự kiện vô tình nhấn âm vẫn trả về dương an toàn
    function fixCartNum() {
        $('[name=num]').val(Math.abs($('[name=num]').val()))       
    }

<?php $user_id = getCookie('user_id');
$a = 0;
if ($user_id != 0) {
    $a = $user_id;
} ?>
    //Hàm giỏ hàng
    function addCart(productId, num) {
        //Sử dụng công nghệ ajax để đẩy dữ liệu lên
        console.log(document.getElementById('tonkho'))
        if(<?php echo $a?> == 0){
            alert('Bạn cần phải đăng nhập để mua hàng!')
            return;
        }
         else if(num > <?php echo $product['quantity'] ?>){
            num = <?php echo $product['quantity'] ?> ;
            alert("Số lượng sản phẩm tồn kho còn " + num +" sản phẩm")
        }
            $.post('api/ajax_request.php', {
            'action': 'cart',
            'id': productId,
            'num': num
        }, function(data) {
            location.reload()
        }) 
    }
</script>

<?php
require_once('layout/footer.php');
?>

