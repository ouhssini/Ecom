<?php
include 'assets/config/db.php';
include 'components/header.html';

if (!isset($_GET['ref'])) {
    header("location:dashboard.php");
    exit();
} else {
    $ref = $_GET['ref'];
    $db = new DB();
    $data = $db->selectData('select * from products p inner join categories c on c.id_cat = p.id_cat where ref_prod = :ref_prod', [':ref_prod' => $ref]);
}


?>
<?php if (count($data) > 0) { ?>
    <div class="container pt-5 min-vh-100  row d-flex align-items-center mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image" src="assets/img/<?= $data[0]['image_prod'] ?>" width="250" /> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="d-flex align-items-center text-secondary" href="/"> <i class="fa fa-long-arrow-left"></i> <span class="ms-3">Back</span> </a> <i class="fa fa-shopping-cart text-muted" role="button"></i>
                                </div>
                                <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"><?= $data[0]['nom_cat'] ?></span>
                                    <h5 class="text-uppercase"> <?= $data[0]['nom_prod'] ?></h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price">$ <?= $data[0]['prix_prod'] ?></span></div>
                                </div>
                                <p class="about"><?= $data[0]['desc_prod'] ?></p>
                                <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>

    <div class="container pt-5 min-vh-100  row d-flex align-items-center mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card p-4 ">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-warning mb-0 " role="alert">
                            il n'y a aucun produit avec l'identifiant :  <?= $ref ?> Retourne à l'accueil <a href="/" class="alert-link">l'accueil</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
include 'components/footer.html'; ?>