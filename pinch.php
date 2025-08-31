<?php

include 'includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    try{

        // Check if the email already exists in the database
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            // Email already exists, show an error message
            echo "Email already exists. Please choose a different email.";
            exit;
        } else{

            //prepare sql statement
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (:email, :password)");
        //bind parameters   
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_pass);
        //execute the statement 
        $stmt->execute();
        //check if the user was created successfully
        if($stmt->rowCount() > 0) {
            // User created successfully, redirect to the admin dashboard or show a success message
            header('Location: admin/index.php');
            exit;
        } else {
            // User creation failed, show an error message
            echo "Error creating user. Please try again.";
        }
    }
    

        }catch(PDOException $e) {
        // Handle any errors that occur during the database operation
        echo "Error: " . $e->getMessage();
    }




        

} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
</head>
<body>

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5%;
        width: 100%;
        height: 100dvh;
    }

    .form-container form{
        max-width: 400px;
        background-color: black;
        color: white;
        padding: 15% 5%;
       
        height: fit-content;
    }

    .form-container form label{
        display: block;

    }

      .form-container form input{
        width: 100%;
      }

     .form-container form input:first-of-type{
        margin-bottom: 5%;
     }

     .form-container form #submit{
        max-width: 200px;
     }


</style>

<div class="form-container">

    <form action="pinch.php" method="POST" id="form-container">

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>

        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass"  required minlength="8"
        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}" required>
        <div class="form-text">
            Password must be strong (8 Characters, capital Letter, small Letter, number, symbol)
          </div>
        <input type="submit" id='submit' name='submit' style='width:200px;margin-top: 5%'>


    </form>



</div>

</body>
</html>