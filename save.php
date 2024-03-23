<?php
include 'assets/config/db.php';

if (isset($_POST["ref"]) && !empty($_POST["ref"])) {
    $ref = $_POST["ref"];
    $name = $_POST["prodname"];
    $price = $_POST["price"];
    $description = $_POST["productdesc"];
    $category = $_POST["category"];
    $qt = $_POST["qt"];
    $file = $_FILES["imgprod"];

    if (!empty($file)) {
        $fileName = $_FILES['imgprod']['name'];
        $fileTempName = $_FILES['imgprod']['tmp_name'];
        $fileSize = $_FILES['imgprod']['size'];
        $fileError = $_FILES['imgprod']['error'];
        $fileType = $_FILES['imgprod']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowedExt)) {
            if ($fileError == 0) {
                if ($fileSize < 10000000) {
                    $fileNemeNew = "$ref" . "." . $fileActualExt;
                    $fileDestination = 'assets/img/' . $fileNemeNew;

                    if (move_uploaded_file($fileTempName, $fileDestination)) {
                        $db = new DB();
                        $query = "UPDATE products
                            SET
                            nom_prod = :nom_prod,
                            prix_prod = :prix_prod,
                            qt_prod = :qt_prod,
                            desc_prod = :desc_prod,
                            image_prod = :image_prod,
                            id_cat = :id_cat
                            WHERE ref_prod = :ref_prod";
                        $params = array(
                            ':nom_prod' => $name,
                            ':prix_prod' => $price,
                            ':qt_prod' => $qt,
                            ':desc_prod' => $description,
                            ':image_prod' => $fileNemeNew,
                            ':id_cat' => $category,
                            ':ref_prod' => $ref
                        );
                        $res = $db->UpdateData($query, $params);
                        if ($res > 0) {
                            header("location:dashboard.php?edit=true");
                            exit;
                        } else {
                            header("location:dashboard.php?edit=false");
                            exit;
                        }
                    } else {
                        echo "Error moving uploaded file.";
                    }
                } else {
                    echo "File size exceeds limit.";
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            $db = new DB();
            $query = "UPDATE products
                SET
                nom_prod = :nom_prod,
                prix_prod = :prix_prod,
                qt_prod = :qt_prod,
                desc_prod = :desc_prod,
                id_cat = :id_cat
                WHERE ref_prod = :ref_prod";
            $params = array(
                ':nom_prod' => $name,
                ':prix_prod' => $price,
                ':qt_prod' => $qt,
                ':desc_prod' => $description,
                ':id_cat' => $category,
                ':ref_prod' => $ref
            );
            $res = $db->UpdatetData($query, $params);
            if ($res > 0) {
                header("location:dashboard.php?edit=true");
                exit;
            } else {
                header("location:dashboard.php?edit=false");
                exit;
            }
        }
    }
} else {
    header("location:dashboard.php");
    exit;
}
