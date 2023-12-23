<?php
require_once('layout/header.php');

$sql = "select * from News";
$news = executeResult($sql);
?>

 <div class="danhmuc">
            <div class="font-danhmuc">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>/</li>
                    <li>Tin tức</li>
                </ul>
            </div>
        </div>
        <div class="wrap-news">
            <div class="grid-news">
                
                </div>
            </div>
        </div>
<?php
require_once('layout/footer.php');
?>