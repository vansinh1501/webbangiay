<?php
if(!empty($_POST)) {
    $id = getPost('id'); 
    $thumbnail = moveFile('thumbnail');
    $title = getPost('title');
    $description = getPost('description');

    if($id > 0) {
        //update
        //Nếu thumbnail mà khác null thì mới update, thumbnail không có file nào lựa chọn thì không update thumbnail giữ lại giá trị cũ
        if($thumbnail != '') {
        $sql = "update News set thumbnail = '$thumbnail', title = '$title', description = '$description' where id = $id";
    } else {
        $sql = "update News set title = '$title', description = '$description' where id = $id";
    }
        execute($sql);

        header('Location: index.php');
        die();
    } else {
        //insert
        $sql = "insert into News(thumbnail, title, description) values ('$thumbnail', '$title', '$description')";
        execute($sql);
        header('Location: index.php');
        die();
    }
}
?>