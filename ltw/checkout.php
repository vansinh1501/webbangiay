<?php
session_start();
require_once('utils/utility.php');
require_once('database/dbhelper.php');

//Lấy dữ liệu từ db
$sql = "select * from Category";
$menuItems = executeResult($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/font-awesome.min.css">
</head>
<body>
    <div class="wrap">
        <div class="grid-checkout">
        
            <div class="grid-checkout-left">
                <div class="title-checkout">
                    <h2>Giày đá banh chính hãng</h2>
                </div>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index.html">Giỏ hàng</a></li>
                        <li>></li>
                        <li>Thông tin giao hàng</li>
                        <li>></li>
                        <li>Phương thức thanh toán</li>
                    </ul>
                </div> 
             <div class="info-checkout">
                <h3>Thông tin giao hàng</h3>
             </div> 
        <div class="fieldset">
             <form method="post" onsubmit=" return completeCheckout();">
                <div class="field field-required">
                    <div class="field-input-wrapper">
                        <input  type="text" placeholder="Họ và tên" class="field-input" id="usr" name="fullname" oninvalid="this.setCustomValidity('Vui lòng nhập thông tin!')" required="true">
                    </div>
                </div>
                <div class="field field-required">
                    <div class="field-input-wrapper">
                        <input required="true" type="email" placeholder="Email" class="field-input"  id="email" name="email" oninvalid="this.setCustomValidity('Vui lòng nhập thông tin!')">
                    </div>
                </div>
                <div class="field field-required">
                    <div class="field-input-wrapper">
                        <input required="true" type="tel" placeholder="Số điện thoại" class="field-input"  id="phone" name="phone" oninvalid="this.setCustomValidity('Vui lòng nhập thông tin!')">
                    </div>
                </div>
                <div class="field field-required">
                    <div class="field-input-wrapper">
                        <input required="true" type="text" placeholder="Địa chỉ" class="field-input"  id="address" name="address" oninvalid="this.setCustomValidity('Vui lòng nhập thông tin!')">
                    </div>
                </div>
                <div class="field field-required field-four-fives">
                    <div class="field-input-wrapper">
                        <textarea class="field-input2" placeholder="Ghi chú" id="note", name="note"></textarea>
                    </div>
                </div>
                <div class="grid-step-footer">
                   <div class="btn-back-cart">
                    <a href="cart.php">Giỏ hàng</a>
                   </div>
                      <div class="btn-thanhtoan">
                    <a href="checkout.php">
                        <button type="submit" class="btn">
                        <span class="btn-content">Thanh Toán</span>
                         </button></a>
                      </div>            
                </div>
             </form>
        </div>  
        </div>
          <div class="grid-checkout-right">
          <form method="post" onsubmit=" return completeCheckout();">
            <div class="sidebar-content">            
             <?php
             if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
             }
             $price = 0;
           foreach($_SESSION['cart'] as $item){
                 $price += $item['discount'] * $item['num'];
            echo '
            <div class="grid-checkout-row1">
                <div class="thumbnail-checkout-right">
                    <img src="'.$item['thumbnail'].'" alt="">
                </div>
                <span class="product-thumbnail-quantity">'.$item['num'].'</span>
                <div class="font-checkout-right">'.$item['title'].'</div>
                <div class="price-checkout">
                    <span>'.number_format($item['discount'] * $item['num']).'₫</span>
                </div>
            </div>';
          }
           ?>
           <div class="grid-checkout-row2">
                <div class="font-num-checkout">
                    <span>Tạm tính: </span>
                    <?php
                    echo '<span class="num-checkout">'.number_format($price).'₫</span>'
                    ?>   
                </div>
            </div>
            <div class="grid-checkout-row2">
                <div class="font-num-checkout">
                    <span>Phí vận chuyển: </span>
                    <span class="num-checkout">30,000₫</span>
                </div>
            </div>
            <div class="grid-checkout-row2">
                <div class="font-num-checkout">
                    <span>Tổng giá: </span>
                    <!-- <span class="num-all-price-checkout"><?=$price + 30000?></span> -->
                    <?php
                    echo '<span class="num-all-price-checkout">'.number_format($price + 30000).'₫</span>'
                    ?>   
                    <span class="payment">VND</span>                  
                </div>
                </div>
            </div>
          </form>
          </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="./js/menu.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(window).scroll(function(){
            if($(this).scrollTop()){
                $('#backtop').fadeIn();
            }else {
                $('#backtop').fadeOut();
            }
        });
        $('#backtop').click(function(){
            $('html,body').animate({
                scrollTop: 0
            }, 800);
        });
    });
</script>

<script type="text/javascript">
    function completeCheckout() {
        $.post('api/ajax_request.php', {
             'action': 'checkout',
             'fullname': $('[name=fullname]').val(),
             'email': $('[name=email]').val(),
             'phone_number': $('[name=phone]').val(),
             'address': $('[name=address]').val(),
             'note': $('[name=note]').val()
        }, function (){
            window.open('index.php', '_self');
            alert("Đặt hàng thành công!");
        })
        return false; 
    }
</script>

<?php
if(!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
}
$count = 0;
foreach($_SESSION['cart'] as $item) {
	$count += $item['num'];
}
?>
<script type="text/javascript">
	function addCart(productId, num) {
		$.post('api/ajax_request.php', {
			'action': 'cart',
			'id': productId,
			'num': num
		}, function(data) {
			location.reload()
		})
	}
</script>

</html>