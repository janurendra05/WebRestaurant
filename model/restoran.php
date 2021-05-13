<?php
include_once '../database/db_connect.php';
class Restoran{
    protected $db_connect;
    function __construct()
    {
        $this->db_connect = new database();
    }
    private function getNumberLength($number){
        return strlen((string)$number);
    }
    private function getNewTransactionId(){
        $query = $this->db_connect->db->prepare(
            'select id_transaksi from transaksi order by id_transaksi desc limit 1'
        );
        $query->execute();
        $lastIdRaw = $query->fetch();
        $lastIdNumber = substr($lastIdRaw['id_transaksi'], 3);
        $lastIdNumberInt = intval($lastIdNumber);
        $digitCount = $this->getNumberLength($lastIdNumberInt);
        $numberDigit = 3;
        $plus0 = $numberDigit-$digitCount;
        $newId = 'INV';
        for($i = 0; $i < $plus0; $i++){
            $newId = $newId.'0';
        }
        $newId = $newId.((string)$lastIdNumberInt+1);
        return $newId;
    }
    public function getNewMenuId(){
        $query = $this->db_connect->db->prepare(
            'select id_menu from menu order by id_menu desc limit 1'
        );
        $query->execute();
        $lastIdRaw = $query->fetch();
        $lastIdNumber = substr($lastIdRaw['id_menu'], 3);
        $lastIdNumberInt = intval($lastIdNumber);
        $digitCount = $this->getNumberLength($lastIdNumberInt);
        $numberDigit = 3;
        $plus0 = $numberDigit-$digitCount;
        $newId = 'IDM';
        for($i = 0; $i < $plus0; $i++){
            $newId = $newId.'0';
        }
        $newId = $newId.((string)$lastIdNumberInt+1);
        return $newId;
    }
    public function getAllMenu(){
        $query = $this->db_connect->db->prepare("
        SELECT *
        from menu
        inner join kategori_menu
        on kategori_menu.id_kategori=menu.id_kategori");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function getAllCategory(){
        $query = $this->db_connect->db->prepare("
        SELECT *
        from kategori_menu");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function getByCategory($id_kategori){
        $query = $this->db_connect->db->prepare("
        SELECT id_menu as 'id_menu', nama_menu as 'nama_menu', harga_menu as 'harga_menu', 
            deskripsi as 'deskripsi', menu.id_kategori as 'id_kategori', gambar as 'gambar', nama_kategori as 'nama_kategori'
        from menu
        inner join kategori_menu
        on kategori_menu.id_kategori=menu.id_kategori
        where menu.id_kategori=:id_kategori");
        $query->bindParam(':id_kategori', $id_kategori);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function addMenu($nama_menu, $harga_menu, $deskripsi, $id_kategori, $gambar){
        $query = $this->db_connect->db->prepare("
        INSERT Into menu(id_menu, nama_menu, harga_menu, deskripsi, id_kategori, gambar)
        values(:id_menu, :nama_menu, :harga_menu, :deskripsi, :id_kategori, :gambar)");
        $newMenuId = $this->getNewMenuId();
        $query->bindParam(":id_menu", $newMenuId);
        $query->bindParam(":nama_menu", $nama_menu);
        $query->bindParam(":harga_menu", $harga_menu);
        $query->bindParam(":deskripsi", $deskripsi);
        $query->bindParam(":id_kategori", $id_kategori);
        $query->bindParam(":gambar", $gambar);
        $status = $query->execute();
        return $status;
    }
    public function deleteMenu($id_menu){
        $query = $this->db_connect->db->prepare("
        DELETE from menu where id_menu=:id_menu");
        $query->bindParam(":id_menu", $id_menu);
        $status = $query->execute();
        return $status;
    }
    public function getMenuById($id_menu){
        $query = $this->db_connect->db->prepare("
        SELECT *
        from menu
        inner join kategori_menu
        on kategori_menu.id_kategori=menu.id_kategori
        where menu.id_menu=:id_menu");
        $query->bindParam(":id_menu", $id_menu);
        $query->execute();
        $data = $query->fetch();
        return $data;
    }
    public function editMenu($id_menu, $nama_menu, $harga_menu, $deskripsi, $id_kategori, $gambar){
        $query = $this->db_connect->db->prepare("
        UPDATE menu 
        SET 
        nama_menu=:nama_menu,
        harga_menu=:harga_menu,
        deskripsi=:deskripsi,
        id_kategori=:id_kategori,
        gambar=:gambar
        WHERE 
        id_menu=:id_menu");
        $query->bindParam(":nama_menu", $nama_menu);
        $query->bindParam(":harga_menu", $harga_menu);
        $query->bindParam(":deskripsi", $deskripsi);
        $query->bindParam(":id_kategori", $id_kategori);
        $query->bindParam(":gambar", $gambar);
        $query->bindParam(":id_menu", $id_menu);
        $status = $query->execute();
        return $status;
    }
    public function getAllKategori(){
        $query = $this->db_connect->db->prepare("
        SELECT *
        from kategori_menu
        ");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function createNewTransaction($id_user) {
        $newTransactionId = $this->getNewTransactionId();
        $query = $this->db_connect->db->prepare('
        Insert into transaksi(id_transaksi, id_user, tanggal_transaksi)
        values(:id_transaksi, :id_user, DATE_FORMAT(now(), "%Y-%m-%d"))');
        $query->bindParam(':id_transaksi', $newTransactionId);
        $query->bindParam(':id_user', $id_user);
        $query->execute();

        // return new invoice id
        return $newTransactionId;
    }
    public function transaction($id_transaksi, $id_menu, $jumlah){
        $query = $this->db_connect->db->prepare('
        Insert into transaksi_banyak(id_transaksi, id_menu, jumlah)
        values(:id_transaksi, :id_menu, :jumlah)');
        $query->bindParam(':id_transaksi', $id_transaksi);
        $query->bindParam(':id_menu', $id_menu);
        $query->bindParm(':jumlah', $jumlah);
        $query->execute();
    }
}

?>