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
    $data = $db->selectData('select * from products p inner join categories c on c.id_cat = p.id_cat where ref_prod = :ref_prod', [':ref_prod' => $ref]);
    $categories = $db->selectData('select * from categories');
}
