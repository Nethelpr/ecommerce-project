<?php

//connect to database
require_once __DIR__ . '/../includes/db.php';

//create category
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['adminmail'];
    $password = $_POST['password'];
    $name = $_POST['username'];

    $stmt = $pdo->prepare("SELECT * FROM admin_users where username = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0){
        // Email already exists, show an error message
        echo json_encode(['status' => 'error', 'message' => 'Admin already exists.']);
        exit;
    } else {

        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        //prepare sql statement
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, admin_name) VALUES (:email, :password, :name)");
        //bind parameters   
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_pass);
        //execute the statement 
        $stmt->execute();
        //check if the user was created successfully
        if($stmt->rowCount() > 0) {
            // Email already exists, show an error message
            echo json_encode(['status' => 'sucess', 'message' => 'Admin Added Successfully.']);
            exit;
        } else {
             // Email already exists, show an error message
             echo json_encode(['status' => 'error', 'message' => 'Error Adding Admin.']);
             exit;
        }

    }





}
