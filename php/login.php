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
            // Jika pengguna tidak ditemukan, tampilkan pesan error
            echo "Login gagal! Email atau password salah.";
        }

        // if ($user && password_verify($password, $user['PASSWORD'])) {
        //     $_SESSION['user_id'] = $user['ID_USER'];
        //     $_SESSION['user_name'] = $user['NAME'];
        //     oci_free_statement($stid);
        //     oci_close($conn);
        //     header("Location: welcome.php");
        //     exit();
        // } else {
        //     echo "Invalid email or password.";
        // }
        oci_free_statement($stid);
    }
}
// oci_close($conn);
// function checkLogin($email, $password) {
//     global $conn;

//     $sql = 'SELECT ID_USER, NAME, EMAIL FROM TB_USER WHERE EMAIL = :email AND PASSWORD = :password';
//     $stid = oci_parse($conn, $sql);
//     oci_bind_by_name($stid, ':email', $email);
//     oci_bind_by_name($stid, ':password', $password);
    
//     oci_execute($stid);

//     $row = oci_fetch_assoc($stid);
//     oci_free_statement($stid);

//     if ($row) {
//         return $row;
//     } else {
//         return false;
//     }
// }

?>
