<?php
session_start();
include 'assets/config/db.php';
include "components/header.html";
$role = $_SESSION['role'];
$db = new DB();
$data = $db->selectdata("select * from  products p inner join categories c on p.id_cat = c.id_cat");


?>


<title>tout les produits</title>
</head>

<body class="sb-nav-fixed">
    <?php

    if (isset($_GET['deleted'])) {
        if ($_GET['deleted'] == 'true') {
            echo '<script>
    Swal.fire({
        title: "Produit supprimé avec succès",
        icon: "success",
        showCancelButton: false,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/"; // Redirect to home
        }
    });
</script>';

        } else {
            echo '<script>
    Swal.fire({
        title: "Erreur lors de la suppression du produit",
        icon: "error",
        showCancelButton: false,
        confirmButtonColor: "#d33",
        confirmButtonText: "OK"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/"; // Redirect to dashboard
        }
    });
</script>';

        }
    }

    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row align-items-center">
                <h1 class="mt-4 col">Les Produits</h1>
                <a href="assets/config/logout.php" class="ms-auto col text-end text-decoration-none text-uppercase "><i class="fa fa-user me-2 "></i> logout</a>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">tableau de bord</a></li>
                    <li class="breadcrumb-item active">Les Produits</li>
                </ol>
                <div class="card mb-4">

                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-list me-1"></i>
                        Tout les articles
                    </div>
                    <div class="card-body">
                        <table id="productsTable">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Libellé</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Photo Produit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Reference</th>
                                    <th>Libellé</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Photo Produit</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($data as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['ref_prod'] ?></td>
                                        <td><?= $value['nom_prod'] ?></td>
                                        <td><?= $value['prix_prod'] ?></td>
                                        <td><?= $value['qt_prod'] ?></td>
                                        <td><?= $value['nom_cat'] ?></td>
                                        <td><?= $value['desc_prod'] ?></td>
                                        <td><img src="assets/img/<?= $value['image_prod'] ?>" alt="<?= $value['nom_prod'] ?>" class="prodImage"></td>

                                        <td>
                                            <?php if(strtolower($role) == 'admin'){ ?>
                                                <a class="btn btn-warning" href="/edit.php?ref=<?= $value['ref_prod'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </a>
                                            <a class="btn btn-danger" data-id="<?= $value['ref_prod'] ?>" onclick="del(this.getAttribute('data-id'))">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </a>
                                            <?php }?>

                                            <a class="btn btn-success" href="product.php?ref=<?= $value['ref_prod'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <script>
            function del(id) {
                Swal.fire({
                    title: "Voulez-vous supprimer ce produit?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "supprimer",
                    denyButtonText: `Annuler`,
                    icon : 'question'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        document.location.href = "/delete.php?ref=" + id;
                    } else if (result.isDenied) {
                        Swal.fire("Les modifications ne sont pas enregistrées", "", "error");
                    }
                });
            }
        </script>
        <?php
        include "components/footer.html";
        ?>