<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

// $user = getUserToken();
// if($user == null) {
//     die();  
// }

if(!empty($_POST)) {
    $action = getPost('action');
    switch ($action) {
        case 'delete':
            deleteCategory();
            break;
    }
}
function deleteCategory() {
    //Code xóa tất cả các sản phẩm trong danh mục mới được xóa danh mục
    $id = getPost('id');
    $sql = "select count(*) as total from Product where category_id = $id and deleted = 0";
    $data = executeResult($sql, true);
    $total = $data['total'];
    if($total > 0) {
        echo 'Danh mục đang chứa sản phẩm, không được xóa!!!';
        die();
    }

    $sql = "delete from Category where id = $id";
    execute($sql);
}
?>