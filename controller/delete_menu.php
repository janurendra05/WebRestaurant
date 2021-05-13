<?php
include '../model/restoran.php';
$restoran = new Restoran();

if(isset($_GET)){
    $id_menu = $_GET['id'];

    $status = $restoran->deleteMenu($id_menu);
    if($status){
        echo 'Delete Berhasil';
        header('location:../view/admin.php');
    }else{
        echo 'Delete gagal';
        header('location:../view/admin.php');
    }
}

?>