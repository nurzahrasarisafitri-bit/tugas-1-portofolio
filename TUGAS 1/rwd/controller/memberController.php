<?php
session_start(); //memulai session
include_once '../koneksi.php';
include_once '../models/Member.php';

$uname= $_POST['username']; 
$password = $_POST['password']; 

$data = [
    $uname, // ? 1
    $password, // ? 2
];

//3. eksekusi tombol
$obj_member = new Member();
$rs = $obj_member->cekLogin($data);
if(!empty($rs)){ //----------sukses login-----------
    //setelah sukses login diarahkan ke hal studies list, dan data user disimpan di session
    $_SESSION['MEMBER'] = $rs; //data user dikenal oleh session
    header('location: ../index.php?hal=studies_list');
}
else{  //----------gagal login-----------
    echo '<script>alert("Username/Password Anda Salah!!!");history.go(-1);</script>';
}
?>