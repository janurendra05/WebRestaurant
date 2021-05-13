<?php
include '../model/restoran.php';
include './tools.php';
session_start();
$restoran = new Restoran();
$tools = new Tools();


$id_menu = $_GET['id'];
if(isset($_POST)){
    $data_before = $restoran->getMenuById($id_menu);
    $url_foto = $data_before['gambar'];

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $id_kategori = $_POST['id_kategori'];
    if(isset($_FILES['gambar']) && $_FILES['gambar']['size'] > 0){
        $gambar = $_FILES['gambar'];
        $url_foto = $tools->uploadToImgur($gambar);
    }
    $status = $restoran->editMenu($id_menu, $nama, $harga, $deskripsi, $id_kategori, $url_foto);
}

?>