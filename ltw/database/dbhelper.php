<?php
//chứa các thư viện function dùng chung cho cả dự án (chỉ dành cho các dự án nhỏ và vừa)
require_once('config.php');

// SQL: insert, update, delete -> các câu lệnh này không trả về kết quả
function execute($sql) {
    //open connection database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    //xử lý câu query (truy vấn)
    mysqli_query($conn, $sql);

    //close connection database
    mysqli_close($conn);
}

//SQL: select -> lấy dữ liệu đầu ra
//$isSingle về sau lấy 1 bảng ghi từ bên ngoài vào chỉ cần thành true
function executeResult($sql, $isSingle = false) {
    $data = null;

    //open connection
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    //query
    $resultSet = mysqli_query($conn, $sql);
    if($isSingle) {
        $data = mysqli_fetch_array($resultSet, 1);
    }else {
         //Chứa các dữ liệu
        $data = [];
        //Tham số 1 là nó sẽ thực hiện quá trình fix dữ liệu ra và lưu dữ liệu vào từng mảng (từng bảng ghi được fix ra = 1 mảng), lưu dữ liệu dạng key và value. Để tham số 2, kh lưu theo kiểu key value mà lưu theo kiểu index, khó trong việc quản lý dữ liệu. Vd: nó sẽ lưu các cột trong table kh còn là id, thumbnail, title,... nữa mà sẽ thành 0, 1, 2,...
        //Vd: param2=1
        //$row = [
        //     'id' => 1, 
        //     'title' => '1 - Giay', 
        //     'thumbnail' => '12321',
        //     ...
        // ];
        // Vd: param2=2
        // $row = [
        //     1, '1 - Giay', 12321;
        // ]
        while(($row = mysqli_fetch_array($resultSet, 1)) != null) {
           
            $data[] = $row;
        }
    }

    //close connection 
    mysqli_close($conn);
    return $data;
}
?>