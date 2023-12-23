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
        case 'update_status':
            updateStatus();
            break;
    }
}

function updateStatus(){
    $id = getPost('id');
    $status = getPost('status');

    $sql = "update Orders set status = $status where id = $id";
    // $sql = "delete from User where id = $id";
    execute($sql);
}

if(!empty($_POST)) {
    $action = getPost('action');
    switch ($action) {
        case 'delete':
            deleteOrder();
            break;
    }
}

function deleteOrder(){
    $id = getPost('id');
    $sql = "delete from Orders where id = $id";
    execute($sql);
}
?>