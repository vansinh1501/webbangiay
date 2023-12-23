<?php
function fixSqlInject($sql) {
    $sql = str_replace('\\','\\\\', $sql);
    $sql = str_replace('\'', '\\\'', $sql);
    return $sql;
}

function getGet($key) {
    $value = '';
    if(isset($_GET[$key])){
        $value = $_GET[$key];
        //Không chạy luôn mà phải chạy qua fixSqlInjection 1 lần cho an toàn
        $value = fixSqlInject($value);
    }
    //trim để hủy tất cả các ký tự đặc biệt
    return trim($value);
}

function getPost($key) {
    $value = '';
    if(isset($_POST[$key])){
        $value = $_POST[$key];
        $value = fixSqlInject($value);
    }
    return trim($value);
}

function getCookie($key) {
    $value = '';
    if(isset($_COOKIE[$key])){
        $value = $_COOKIE[$key];
        $value = fixSqlInject($value);
    }
    return trim($value);
}

function getRequest($key) {
    $value = '';
    if(isset($_REQUEST[$key])){
        $value = $_REQUEST[$key];
        $value = fixSqlInject($value);
    }
    return trim($value);
}

//Custom MD5
function getSecurityMD5($pwd) {
    return md5(md5($pwd).PRIVATE_KEY);
}

//Validate login auto
function getUserToken() {
    if(isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    $token = getCookie('token');
    $sql = "select * from Tokens where token = '$token'";
    $item = executeResult($sql, true);
    if($item != null) {
        $userId = $item['user_id'];
        $sql = "select * from User where id = '$userId' and deleted = 1"; //deleted = 1 là những tài khoản đã xóa không cho login 
        $item = executeResult($sql, true);
        if($item != null) {
            $_SESSION['user'] = $item;
            return $item;
        }
    }
    return null;
}

//Lưu file 
function moveFile($key, $rootPath = "../../") {
    if(!isset($_FILES[$key]) || !isset($_FILES[$key]['name']) || $_FILES[$key]['name'] == '') {
        return '';
    }

    $pathTemp = $_FILES[$key]["tmp_name"];

    $filename = $_FILES[$key]['name'];

    $newPath = "assets/img/".$filename;

    move_uploaded_file($pathTemp, $rootPath.$newPath);

    return $newPath;
}

//Fix đường dẫn hình
function fixUrl($thumbnail, $rootPath = "../../") {
    if(stripos($thumbnail, 'http://') !== false || stripos($thumbnail, 'https://') !== false) {

    } else {
        $thumbnail = $rootPath.$thumbnail;
    }
    return $thumbnail;
}
?>