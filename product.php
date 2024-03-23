<?php
include 'assets/config/db.php';
include 'components/header.html';

if(!isset($_GET['ref'])){
    header("location:dashboard.php");
    exit();
}
else {
    $ref = $_GET['ref'];
    $db = new DB();
    $data = $db->selectData('select * from products where ref_prod = :ref_prod',[':ref_prod' => $ref]);
    if (count($data) > 0){
        echo 'hello';
    }
    else {
        echo '<div class="alert alert-warning container" role="alert">
        il n\'y a aucun produit avec l\'identifiant : '.$ref.'
      </div>';
    }
}


include 'components/footer.html';