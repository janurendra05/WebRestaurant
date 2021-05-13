<?php
include_once '../database/db_connect.php';
class User{
    protected $db_connect;
    function __construct()
    {
        $this->db_connect = new database();
    }
    private function getNumberLength($number){
        return strlen((string)$number);
    }
    public function login($email, $password){
        $query = $this->db_connect->db->prepare('select * from user where email=:email and password=:password');
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);
        $query->execute();
        $length = $query->rowCount();
        if($length){
            return true;
        }else{
            return false;
        }
    }
    public function checkEmail($email){
        $query = $this->db_connect->db->prepare('select * from user where email=:email');
        $query->bindParam(':email', $email);
        $query->execute();
        $length = $query->rowCount();
        if($length == 1){
            return $query->fetch();
        }else{
            return false;
        }
    }
    public function checkUsername($username){
        $query = $this->db_connect->db->prepare('select * from user where username=:username');
        $query->bindParam(':username', $username);
        $query->execute();
        $length = $query->rowCount();
        if($length == 1){
            return $query->fetch();
        }else{
            return false;
        }
    }
    public function createUser($username, $firstName, $lastName, $email, $tanggalLahir, $jenisKelamin, $password){
        $newId = $this->getNewUserId();
        $query = $this->db_connect->db->prepare(
            'Insert into user(id_user, username, first_name, last_name, email, tanggal_lahir, jenis_kelamin, password)
            value(:id_user, :username, :first_name, :last_name, :email, :tanggal_lahir, :jenis_kelamin, :password)'
        );
        $query->bindParam(':id_user', $newId);
        $query->bindParam(':username', $username);
        $query->bindParam(':first_name', $firstName);
        $query->bindParam(':last_name', $lastName);
        $query->bindParam(':email', $email);
        $query->bindParam(':tanggal_lahir', $tanggalLahir);
        $query->bindParam(':jenis_kelamin', $jenisKelamin);
        $query->bindParam(':password', $password);
        $status = $query->execute();
        if($status) return true;
        else return false;
    }
    private function getNewUserId(){
        $query = $this->db_connect->db->prepare(
            'select id_user from user order by id_user desc limit 1'
        );
        $query->execute();
        $lastIdRaw = $query->fetch();
        $lastIdNumber = substr($lastIdRaw['id_user'], 1);
        $lastIdNumberInt = intval($lastIdNumber);
        $digitCount = $this->getNumberLength($lastIdNumberInt);
        $numberDigit = 5;
        $plus0 = $numberDigit-$digitCount;
        $newId = 'U';
        for($i = 0; $i < $plus0; $i++){
            $newId = $newId.'0';
        }
        $newId = $newId.((string)$lastIdNumberInt+1);
        return $newId;
    }
}

?>