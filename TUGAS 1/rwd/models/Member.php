<?php
class Member {
    private $koneksi;

    public function __construct() {
        global $dbh;
        $this->koneksi = $dbh;
    }

    public function cekLogin($data) {
        $sql = "SELECT * FROM member WHERE 
                username = ? AND password = SHA1(?)";
        
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
        $rs = $ps->fetch();
        return $rs;
    }

    public function getMember($id) {
        $sql = "SELECT * FROM member WHERE id = ?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetch();
    }
}