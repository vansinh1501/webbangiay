<?php
//Lấy id và tên danh mục sản phẩm
if(!empty($_POST)) {
    $id = getPost("id");
    $name = getPost("name");

    if($id > 0) {
        //Update
        $sql = "update Category set name = '$name' where id = $id";
        execute($sql); 
    } else {
        //insert
        $sql = "insert into Category(name) values ('$name')";
        execute($sql);
    }
} 
?>