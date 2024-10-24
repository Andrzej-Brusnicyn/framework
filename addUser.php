<?php
include 'database/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    $database = Database::getInstance();
    $conn = $database->getConnection();

    if ($database->setUser($name, $email, $password, $gender, $status)) {
        $userData = $database->getUser($email);

        if ($userData) {
            echo "User added successfully! \n";
            foreach ($userData as $key => $value) {
                echo "$key: $value \n";
            }
        } else {
            echo 'Error retrieving user data.';
        }
    } else {
        echo 'Error adding user';
    }
}
