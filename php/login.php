<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Email and Password are required!";
    } else {
        $sql = 'SELECT * FROM tb_user WHERE email = :email AND password = :password';
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':password', $password);

        oci_execute($stid);

        $user = oci_fetch_assoc($stid);

        if ($user) {
            echo "Login berhasil!<br>";
        } else {
            echo "Login gagal! Email atau password salah.";
        }

        oci_free_statement($stid);
    }
}
?>
