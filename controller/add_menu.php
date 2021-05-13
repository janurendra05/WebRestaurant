<?php
include '../model/restoran.php';
include './tools.php';
session_start();
$restoran = new Restoran();
$tools = new Tools();

if(isset($_POST)){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $id_kategori = $_POST['id_kategori'];
    $gambar = $_FILES['gambar'];
    $url_foto = '';

    if(isset($_FILES['gambar']) && $_FILES['gambar']['size'] > 0){
        $gambar = $_FILES['gambar'];
        $url_foto = $tools->uploadToImgur($gambar);
    }
    $status = $restoran->addMenu($nama, $harga, $deskripsi, $id_kategori, $url_foto);
    header('location:../view/admin.php');
}

?>