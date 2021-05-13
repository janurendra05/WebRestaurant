<?php
include '../model/user.php';
session_start();
$user = new User();

if(isset($_POST) && isset($_POST['g-recaptcha-response'])){
    $captcha=$_POST['g-recaptcha-response'];
    $secretKey = "6Le0Z4AaAAAAADNLzCVDlUMdc7qQdpOZoiQb-96D";
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    if($responseKeys["success"]) {
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $tanggalLahir = $_POST['tanggalLahir'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $password = $_POST['password'];
        $password = hash('sha256', $password);

        $checkUsername = $user->checkUsername($username);
        $checkEmail = $user->checkEmail($email);
        if($checkUsername == false && $checkEmail == false){
            $status = $user->createUser($username, $firstName, $lastName, $email, $tanggalLahir, $jenisKelamin, $password);
            if($status){
                echo 'Create user berhasil';
                $_SESSION['restoran.uts.status'] = "login";
                $_SESSION['restoran.uts.username'] = $username;
                $_SESSION['restoran.uts.role'] = 'customer';
                $_SESSION['restoran.uts.error_msg_register'] = '';
                header('location:../view/home.php');
            }else{
                echo 'Error database';
            }
        }else if($checkUsername != false){
            $_SESSION['restoran.uts.error_msg_register'] = 'Email sudah pernah terpakai';
            header('location:../view/login.php');
        }else if($checkEmail != false){
            $_SESSION['restoran.uts.error_msg_register'] = 'Username sudah pernah terpakai';
            header('location:../view/login.php');
        }
    } else {
        $_SESSION['restoran.uts.error_msg_login'] = 'Not Allowed by Captcha!';
        header('location:../view/login.php');
    }
}

?>