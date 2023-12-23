<?php
require_once('layout/header.php');

$sql = "select * from Product";
$product = executeResult($sql, true);
?>
<div class="danhmuc">
            <div class="font-danhmuc">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>/</li>
                    <li>Giỏ hàng</li>
                </ul>
            </div>
        </div>
        <div class="wrap-cart">
            <div class="cart1">
                <div class="grid-col1-cart-col2-thanhtoan">
                    <div class="grid-col1-cart">
                        <div class="grid-col1-col2-col3-col4">
                            <div class="col1-col2-col3-col4">
                                Sản phẩm
                            </div>
                            <div class="col1-col2-col3-col4">
                                Đơn giá
                            </div>
                            <div class="col1-col2-col3-col4">
                                Số lượng
                            </div>
                            <div class="col1-col2-col3-col4">
                                Tồn kho
                            </div>
                            <div class="col1-col2-col3-col4">
                                Thành tiền
                            </div>
                        </div>
                        <?php
                        if(!isset($_SESSION['cart'])) {
                            $_SESSION['cart'] = [];
                        }
                        foreach($_SESSION['cart'] as $item) {
                            echo '
                            <div class="grid-noidung-cart">
                            <div class="grid-col1-img-font-noidung-cart">
                                <div class="col1-img-cart">
                                <img src="'.$item['thumbnail'].'" alt="" style="height: 80px">
                                </div>
                                <div class="col1-font-cart">
                                    <h5>'.$item['title'].'</h5><br>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col2-money-cart">
                                <span>'.number_format($item['discount']).'₫</span>
                            </div>
                            <div class="col3-soluong-cart">
                            <div class="button-amount-detail-product">
                            <button class="button-subtraction" type="number" value="'.$item['num'].'" onclick="addMoreCart('.$item['id'].', -1)">-</button>
                            <input disabled class="text-amount" type="number" name="num" id="num_'.$item['id'].'" value="'.$item['num'].'" onchange="fixCartNum('.$item['id'].')">
                            <button class="button-addition" value="'.$item['id'].'"onclick="addMoreCart('.$item['id'].', 1)">+</button>
                            </div>
                            </div>
                            <div class="col4-thanhtien">
                                <span>'.$item['quantity'].'</span>
                            </div> 
                            <div class="col4-thanhtien">
                                <span>'.number_format($item['discount'] * $item['num']).'</span>
                            </div>  
                            <div class="del-product">
                            <button onclick="updateCart('.$item['id'].', 0)">
                            <i class="fa-solid fa-x"></i></button>
                            </div>                          
                        </div>
                        <div class="back-continue-buy">
                            
                        </div> ';
                        
                        }
                        ?>                        
                   </div>  
                   <div class="cart2">
                    <div class="grid-total-cart">
                        <div class="font-total-cart">
                            <label for="">Thành tiền</label>
                        </div>
                        <?php
             if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
             }
             $price = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $price += $item['discount'] * $item['num'];
                        }
                 ?>
                        <div class="price-total-cart">
                                        <?php
                                        echo '<span>'.number_format($price).'₫</span>'
                                        ?>
                        </div>
                    </div>
                    <div class="btn-cart">
                        <a href="checkout.php"><button type="submit">Thanh toán</button></a>
                    </div>
                </div>       
                </div>    
            </div>          
        </div>
<script type="text/javascript">
    //Bắt sự kiện số lượng tăng 1 và giảm đi 1 không về âm
    function addMoreCart(id, delta) {
        num = parseInt($('#num_' + id).val())
        num += delta
        if(num > <?php echo $product['quantity'] ?>) {
            num = <?php echo $product['quantity'] ?> ;
            alert("Số lượng sản phẩm tồn kho còn " + num +" sản phẩm")
        }
        $('#num_' + id).val(num)

        updateCart(id, num)
    }

    //Sự kiện vô tình nhấn âm vẫn trả về dương an toàn
    function fixCartNum(id) {
        $('#num_' + id).val(Math.abs($('#num_' + id).val()))

        updateCart(id, $('#num_' + id).val())
    }

    function updateCart(productId, num) {
        $.post('api/ajax_request.php', {
            'action': 'update_cart',
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