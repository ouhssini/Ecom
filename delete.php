<?php
session_start();
include 'assets/config/db.php';
include 'components/header.html';

if (!isset($_GET['ref']) || $_SESSION['role'] != 'admin') {
    header("location:dashboard.php");
    exit();
} else {
    $ref = $_GET['ref'];
    $db = new DB();
    $res = $db->Execute("delete from products where ref_prod = :ref_prod", [':ref_prod' => $ref]);
    if ($res > 0) {
        header("location:dashboard.php?deleted=true");
        exit();
    } else {
        header("location:dashboard.php?deleted=false");
        exit();
    }
}
