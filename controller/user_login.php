<?php
include '../model/user.php';
session_start();
$user = new User();

if (isset($_POST) && isset($_POST['g-recaptcha-response'])) {
    $captcha=$_POST['g-recaptcha-response'];
    $secretKey = "6Le0Z4AaAAAAADNLzCVDlUMdc7qQdpOZoiQb-96D";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    // should return JSON with success as true
    if($responseKeys["success"]) {
        // Allowed
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hasilUsername = $user->checkUsername($username);
        $email = $username;
        $hasilEmail = $user->checkEmail($email);
        if($hasilEmail){
            $loginResult = $user->login($hasilEmail['email'], hash('sha256', $password));
            if($loginResult){
                echo 'Berhasil login';
                $_SESSION['restoran.uts.status'] = "login";
                $_SESSION['restoran.uts.username'] = $loginResult['username'];
                unset($_SESSION['restoran.uts.error_msg_login']);
                if($hasilEmail['id_user'] == 'U00001'){
                    $_SESSION['restoran.uts.role'] = 'admin';
                    header('location:../view/admin.php');
                }else{
                    $_SESSION['restoran.uts.role'] = 'customer';
                    header('location:../view/home.php');
                }
            }else{
                echo 'Gagal login';
                $_SESSION['restoran.uts.error_msg_login'] = 'Username atau password salah';
                header('location:../view/login.php');
            }
        }else if($hasilUsername){
            $loginResult = $user->login($hasilUsername['email'], hash('sha256', $password));
            if($loginResult){
                echo 'Berhasil login';
                $_SESSION['restoran.uts.status'] = "login";
                $_SESSION['restoran.uts.username'] = $hasilUsername['username'];
                unset($_SESSION['restoran.uts.error_msg_login']);
                if($hasilUsername['id_user'] == 'U00001'){
                    $_SESSION['restoran.uts.role'] = 'admin';
                    header('location:../view/admin.php');
                }else{
                    $_SESSION['restoran.uts.role'] = 'customer';
                    header('location:../view/home.php');
                }
            }else{
                $_SESSION['restoran.uts.error_msg_login'] = 'Email atau password salah';
                header('location:../view/login.php');
            }
        }else{
            $_SESSION['restoran.uts.error_msg_login'] = 'Username/Email atau password salah';
            header('location:../view/login.php');
        }
    } else {
        // Not Allowed
        // Spammer ??
        $_SESSION['restoran.uts.error_msg_login'] = 'Not Allowed by Captcha!';
        header('location:../view/login.php');
    }

}
?>