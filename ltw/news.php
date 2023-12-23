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
			 <?php
                foreach($news as $item) {
                    echo '
                    <div class="grid-rows-news">
                    <div class="img-news"><a href=""><img src='.$item['thumbnail'].'></a></div>
                    <div class="font-news">
                    <h3><a href="">'.$item['title'].'</a></h3>
                    <span class="description-font">'.$item['description'].'</span>
                    </div>
                    </div>
                    ';
                }
                ?>
                </div>
            </div>
        </div>
<?php
require_once('layout/footer.php');
?>