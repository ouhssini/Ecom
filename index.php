<?php

session_start();
// session_destroy();
if (isset($_SESSION["username"])) {
    header("location:dashboard.php");
}
include "components/header.html";
?>


<title>SE CONNECTER SYSTEME DE GESTION DE STOCK</title>
</head>



<body class="bg-secondary-subtle">


    <div class="container d-grid  min-vh-100 align-items-center">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4">
                <img src="assets/img/Secure login-bro.svg">
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">se connecter</div>
                    <div class="card-body">
                        <form action="assets/config/login.php" method="post">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur: </label>
                                <input type="text" name="username" id="username" class="form-control my-2" required>
                            </div>


                            <div class="form-group">
                                <label for="password">Mot de passe: </label>
                                <div class="input-group d-flex align-items-stretch my-2" id="show_hide_password">
                                    <input class="form-control " type="password" id="password" name="password" required>
                                    <div class="input-group-addon d-flex justify-content-center align-items-center px-2 border border-1 border-secondary-subtle bg-secondary-subtle">
                                        <i id="password-toggle" aria-hidden="true" role="button"><ion-icon name="eye-outline"></ion-icon></i>
                                    </div>
                                </div>
                            </div>


                            <?php
                            // Check if an error message exists
                            if (isset($_GET['error'])) {
                                // Display the danger alert
                                echo ('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Nom d\'utilisateur ou mot de passe invalide. Veuillez réessayer.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>');
                            }
                            ?>

                            <button type="submit" class="btn btn-success mt-2">se connecter</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
include 'components/footer.html'
?>