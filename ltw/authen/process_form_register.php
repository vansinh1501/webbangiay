<?php
//Nơi bắt đầu code logic
$fullname = $email = $msg2 = '';

if(!empty($_POST)) {
    $fullname = getPost('fullname');
    $email = getPost('email');
    $pwd = getPost('password');

    //Validate lên server
    if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) < 6) {

    }else {
        //Validate thành công
        $pattern = "/.com$/";
        $userExistsRegister = executeResult("select * from User where email = '$email'", true);
        if($userExistsRegister != null) {
            $msg2 = 'Email đã tồn tại';
        }
        else if (!preg_match($pattern, $email)) {
            $msg2 = 'Email không đúng định dạng';
        }
        else {    
            $created_at = $updated_at = date ('Y-m-d H:i:s');
            //Sử dụng mã hóa 1 chiều -> md5
            $pwd = getSecurityMD5($pwd);
            
            $sql = "insert into User (fullname, email, password, role_id, created_at, updated_at, deleted) values ('$fullname', '$email', '$pwd', 2, '$created_at', '$updated_at', 0)";
            execute($sql);
            header('Location: login.php');
            die();
        }
    }
}
?>