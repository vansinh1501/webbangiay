<?php
if(!empty($_POST)) {
    $id = getPost('id');
    $title = getPost('title');
    $price = getPost('price');
    $discount = getPost('discount');
    $thumbnail = moveFile('thumbnail');
    $description = getPost('description');
    $category_id = getPost('category_id');
    $created_at = $updated_at = date('Y-m-d H:s:i');
    $quantity = getPost('quantity');

    if($id > 0) {
        //update
        //Nếu thumbnail mà khác null thì mới update, thumbnail không có file nào lựa chọn thì không update thumbnail giữ lại giá trị cũ
        if($thumbnail != '') {
        $sql = "update Product set thumbnail = '$thumbnail', title = '$title', price = $price, discount = $discount, description = '$description', category_id = '$category_id', updated_at = '$updated_at', quantity = $quantity where id = $id";
    } else {
        $sql = "update Product set title = '$title', price = $price, discount = $discount, description = '$description', category_id = '$category_id', updated_at = '$updated_at', quantity = $quantity where id = $id";
    }
        execute($sql);

        header('Location: index.php');
        die();
    } else {
        //insert
        $sql = "insert into Product(thumbnail, title, price, discount, description, category_id, updated_at, created_at, deleted, quantity) values ('$thumbnail', '$title', '$price', '$discount', '$description', $category_id, '$updated_at', '$created_at', 0, $quantity)";
        execute($sql);
        header('Location: index.php');
        die();
    }
}
?>