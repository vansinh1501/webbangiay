<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

if(!empty($_POST)) {
    $action = getPost('action');
    switch ($action) {
        case 'delete':
            deleteBanner();
            break;
    }
}
function deleteBanner(){
    $id = getPost('id');
    $sql = "delete from Banner where id = $id";
    execute($sql);
}
?>