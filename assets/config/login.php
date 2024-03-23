<?php
session_start();
require_once('db.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
        // Retrieve username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];
        $db = new DB();
        // Prepare and execute the query
        $query = "SELECT * FROM users WHERE username = :username";
        $result = $db->selectData($query, [':username' => $username]);
        // Check if user exists
        if (count($result) != 0) {
            // Check if password matches
            if (password_verify($password, $result[0]["password"])) {
                // Set session variables
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $result[0]["role"];
                header("Location:../../dashboard.php");
            } else {
                header("Location:/?error=InvalidCredentials");
                exit();
            }
        } else {
            header("Location:/?error=InvalidCredentials");
            exit();
        }
    }
} else {
    // Redirect back to login page if form is not submitted
    header("Location:/");
    exit();
}
