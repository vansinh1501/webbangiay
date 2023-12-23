<?php
if(!empty($_POST)) {
    $id = getPost('id');
    $thumbnail = moveFile('thumbnail');
    $category_id = getPost('category_id');

    if($id > 0) {
        //update
        //Nếu thumbnail mà khác null thì mới update, thumbnail không có file nào lựa chọn thì không update thumbnail giữ lại giá trị cũ
        if($thumbnail != '') {
        $sql = "update Banner set thumbnail = '$thumbnail', category_id = '$category_id' where id = $id";
    } else {
        $sql = "update Banner set category_id = '$category_id' where id = $id";
    }
        execute($sql);

        header('Location: index.php');
        die();
    } else {
        //insert
        $sql = "insert into Banner(thumbnail, category_id, deleted) values ('$thumbnail', $category_id, 0)";
        execute($sql);
        header('Location: index.php');
        die();
    }
}
?>