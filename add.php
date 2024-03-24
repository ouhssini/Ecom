<?php


if (isset($_POST["ref"]) && !empty($_POST["ref"])) {
    // Retrieve form data
    $ref = $_POST["ref"];
    $name = $_POST["prodname"];
    $price = $_POST["price"];
    $description = $_POST["productdesc"];
    $category = $_POST["category"];
    $qt = $_POST["qt"];
    $file = $_FILES["imgprod"];

    // Check if file is uploaded successfully
    if ($file['error'] === UPLOAD_ERR_OK) {
        // User has selected an image
        $fileName = $_FILES['imgprod']['name'];
        $fileTempName = $_FILES['imgprod']['tmp_name'];
        $fileSize = $_FILES['imgprod']['size'];

        // Process the uploaded image
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExt = array("jpg", "jpeg", "png");

        if (in_array(strtolower($fileExt), $allowedExt)) {
            if ($fileSize < 10000000) { // Max file size: 10MB
                $fileNemeNew = "$ref" . "." . $fileExt;
                $fileDestination = 'assets/img/' . $fileNemeNew;

                if (move_uploaded_file($fileTempName, $fileDestination)) {
                    // Image uploaded successfully, proceed with insertion
                    $db = new DB();
                    $query = "INSERT INTO products (ref_prod, nom_prod, prix_prod, qt_prod, desc_prod, image_prod, id_cat)
                              VALUES (:ref_prod, :nom_prod, :prix_prod, :qt_prod, :desc_prod, :image_prod, :id_cat)";
                    $params = array(
                        ':ref_prod' => $ref,
                        ':nom_prod' => $name,
                        ':prix_prod' => $price,
                        ':qt_prod' => $qt,
                        ':desc_prod' => $description,
                        ':image_prod' => $fileNemeNew,
                        ':id_cat' => $category
                    );
                    $res = $db->Execute($query, $params);

                    // Redirect based on insertion result
                    $redirectUrl = ($res > 0) ? 'dashboard.php?added=true' : 'dashboard.php?added=false';
                    header("location: $redirectUrl");
                    exit;
                } else {
                    echo "Error moving uploaded file.";
                }
            } else {
                echo "File size exceeds limit.";
            }
        } else {
            echo "Invalid file format. Allowed formats: JPG, JPEG, PNG.";
        }
    } else {
        // No image selected by the user, use default image
        $fileNemeNew = 'placeholder.jpg';
        $db = new DB();
        $query = "INSERT INTO products (ref_prod, nom_prod, prix_prod, qt_prod, desc_prod, image_prod, id_cat)
                  VALUES (:ref_prod, :nom_prod, :prix_prod, :qt_prod, :desc_prod, :image_prod, :id_cat)";
        $params = array(
            ':ref_prod' => $ref,
            ':nom_prod' => $name,
            ':prix_prod' => $price,
            ':qt_prod' => $qt,
            ':desc_prod' => $description,
            ':image_prod' => $fileNemeNew,
            ':id_cat' => $category
        );
        $res = $db->Execute($query, $params);

        // Redirect based on insertion result
        $redirectUrl = ($res > 0) ? 'dashboard.php?added=true' : 'dashboard.php?added=false';
        header("location: $redirectUrl");
        exit;
    }
}
