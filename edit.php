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
?>
<div class="container">
    <div class="card-body mt-2 px-5 py-2  ">
        <h4 class="card-title">Modifier le Produit: <span class='text-primary'><?= $data[0]['nom_prod'] ?></span></h4>
        <form method="post" action="save.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="ref" class="my-2">Référence :</label>
                        <input id="ref" name="ref" type="text" class="form-control" readonly value="<?= $data[0]['ref_prod'] ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="prodname" class="my-2">Libéllé : </label>
                        <input id="prodname" name="prodname" type="text" class="form-control" value="<?= $data[0]['nom_prod'] ?>" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="productdesc" class="my-2">Description: </label>
                        <textarea class="form-control" id="productdesc" rows="5" name="productdesc"><?= $data[0]['desc_prod'] ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                    <div class="form-group mb-3 col-6">
                        <label for="price" class="mb-2">Price: </label>
                        <input id="price" name="price" type="text" class="form-control" value="<?= $data[0]['prix_prod'] ?>">
                    </div>
                    <div class="form-group mb-3 col-6 ">
                        <label for="qt" class="mb-2">Quantité: </label>
                        <input id="qt" name="qt" type="text" class="form-control" value="<?= $data[0]['qt_prod'] ?>">
                    </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="control-label mb-2">Category</label>
                        <select class="form-control select2 select2-hidden-accessible" data-select2-id="select2-data-1-xzez" tabindex="-1" aria-hidden="true" name="category">
                            <!-- <option data-select2-id="select2-data-3-vqb4">Select</option> -->
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?= $category['id_cat'] ?>" <?php if($category['nom_cat'] == $data[0]['nom_cat']  ){echo 'selected';} ?>><?= $category['nom_cat'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success me-1 waves-effect waves-light" value="save">Save Changes</button>
                    <a class="btn btn-secondary waves-effect" href="/">Cancel</a>
                </div>

                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label class="mb-2">Image : </label> <br>
                        <img src="assets/img/<?= $data[0]['image_prod'] ?>" alt="product img" id="imgprod" class="img-fluid rounded" style="max-width: 200px;">
                        <br>
                        <input type="file" accept="image/*" id="fileInput" class="btn btn-info mt-2 waves-effect waves-light" name="imgprod">
                    </div>
                </div>
            </div>


        </form>

    </div>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imgprod').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<?php include 'components/footer.html' ?>