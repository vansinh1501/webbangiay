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
            deleteNews();
            break;
    }
}
function deleteNews(){
    $id = getPost('id');
    $sql = "delete from News where id = $id";
    execute($sql);
}
?>