<?php
session_start();
require 'connection.php';
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql_check = 'SELECT COUNT(*) AS COUNT FROM tb_user WHERE email = :email';
$stid_check = oci_parse($conn, $sql_check);
oci_bind_by_name($stid_check, ':email', $email);
oci_execute($stid_check);
$row = oci_fetch_assoc($stid_check);

if ($row['COUNT'] > 0) {
    echo "Email sudah terdaftar!";
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_insert = 'INSERT INTO tb_user (name, date_of_birth,email,address,regis_date,TB_ROLE_ID_ROLE,no_handphone, password) VALUES (:name, :date_of_birth,:email,:address,:regis_date,:TB_ROLE_ID_ROLE,:no_handphone, password)';  
    $stid_insert = oci_parse($conn, $sql_insert);
    oci_bind_by_name($stid_insert, ':name', $name);
    oci_bind_by_name($stid_insert, ':date_of_birth', $date_of_birth);
    oci_bind_by_name($stid_insert, ':email', $email);
    oci_bind_by_name($stid_insert, ':address', $address);
    oci_bind_by_name($stid_insert, ':regis_date', $regis_date);
    oci_bind_by_name($stid_insert, ':TB_ROLE_ID_ROLE', $TB_ROLE_ID_ROLE);
    oci_bind_by_name($stid_insert, ':no_handphone', $no_handphone);
    oci_bind_by_name($stid_insert, ':password', $hashed_password);

    $result = oci_execute($stid_insert);

    if ($result) {
        echo "Pendaftaran berhasil! Anda dapat login sekarang.";
    } else {
        echo "Pendaftaran gagal! Silakan coba lagi.";
    }

    oci_free_statement($stid_insert);
}

oci_free_statement($stid_check);
oci_close($conn);
?>
