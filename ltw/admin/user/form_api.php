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
            deleteUser();
            break;
    }
}
function deleteUser(){
    $id = getPost('id');
    $update_at = date("Y-m-d H:i:s");
    // $sql = "update User set deleted = 1, updated_at = '$update_at' where id = $id";
    $sql = "delete from User where id = $id";
    execute($sql);
}
?>