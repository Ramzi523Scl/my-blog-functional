<?php
session_start();
function logout() {
    unset($_SESSION['user']);
    header('Location: ../pages/sign_in.php');
}
logout();
