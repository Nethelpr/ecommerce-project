<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit;
} else {


    //get data 

    $admin_id = $_SESSION['admin_id'];

    //connect to database
    require_once __DIR__ . '/../includes/db.php';

    /*//fetch admin data
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
    //$stmt->bindParam(':id', $admin_id);
    $stmt->execute();
    $no_users = $stmt->fetch(PDO::FETCH_ASSOC);*/

    // Fetch total user count
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
    $stmt->execute();
    $no_users = $stmt->fetchColumn(); // Returns just the number

    //list the number of categories 
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories");
    $stmt->execute();
    $no_cat = $stmt->fetchColumn(); // Returns just the number

    //list the number of products 
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM products");
    $stmt->execute();
    $no_products = $stmt->fetchColumn(); // Returns just the number

    //list the number of Orders 
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders");
    $stmt->execute();
    $no_orders = $stmt->fetchColumn(); // Returns just the number

    //list the number of Admins 
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin_users");
    $stmt->execute();
    $no_admins = $stmt->fetchColumn(); // Returns just the number

    //list the number of Items in cart 
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cart");
    $stmt->execute();
    $no_cart = $stmt->fetchColumn(); // Returns just the number

    // Fetch sum of approved orders
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE status = 'Approved'");
    $stmt->execute();
    $approved_orders = $stmt->fetchColumn();

    // Fetch sum of approved orders
    $stmt = $pdo->prepare("SELECT SUM(total_amount) FROM orders WHERE status = 'Approved'");
    $stmt->execute();
    $approved_total = $stmt->fetchColumn() ?? 0;
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        #welcome {
            width: 100%;
            height: 100%;
            background-color: rgb(211, 236, 229);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgb(0, 252, 180);
        }

        .grid-container {
            display: grid;
            grid-auto-columns: 350px auto;
            grid-auto-rows: auto auto;
            grid-template-rows: 600px 600px;
            gap: 0em;
            grid-template-areas: "box-1 box-2 box-2"
                "box-1 box-2 box-2";
        }

        .navi {
            background-color: black;
            padding: 20% 3%;
            color: white;
        }

        /*  .system-parts{
         background-color: whitesmoke;
        }*/
        .sys-name {
            color: white;
            font-weight: bolder;
            width: 100%;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .sys-out {
            color: white;
            font-weight: bolder;
            width: 100%;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: left;
            margin-bottom: 30px;
            margin-top: 90px;
            padding-left: 30px;
        }

        .sys-name img,
        .sys-out img {
            width: 40px;
        }

        .sys-out:hover img {
            width: 45px;
            transition: width 0.3s ease-in-out;
        }

        .navi ul {
            width: 100%;
            height: fit-content;
            padding: 3%;
        }

        .navi ul li {
            list-style-type: none;
            width: 100%;
            background-color: rgb(48, 48, 48);
            border: 2px solid rgb(48, 48, 48);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .navi ul li:hover {
            background-color: rgb(48, 48, 48);
            border: 2px solid purple;
            padding-left: 20px;
            transition: all 0.3s ease-in-out;
        }
    </style>

    <div class="grid-container">


      <?php include 'nav.php'?>

        <div class="box system-parts" style="grid-area: box-2">

            
                <div class="part-1">
                    <div class="head">
                        <h2>WELCOME TO YOUR SIMPCOMMERCE DASHBOARD</h2>
                        <p>Manage your store like a boss.</p>
                    </div>
                    <div class="intro">
                        <p>Here you can manage your store, add products, categories, users, and view orders. You can also manage your store settings and view client details.</p>
                    </div>
                    <div class="heading">
                        <h3>Store Data</h3>
                    </div>
                    <div class="data">
                        <div class="data-box">
                            <h3>Total users</h3>
                            <p><?php echo $no_users ?></p>
                        </div>
                        <div class="data-box">
                            <h3>Total Categories</h3>
                            <p><?php echo $no_cat ?></p>
                        </div>
                        <div class="data-box">
                            <h3>Total Products</h3>
                            <p><?php echo $no_products ?></p>
                        </div>
                        <div class="data-box">
                            <h3>Total Admins</h3>
                            <p><?php echo $no_admins ?></p>
                        </div>
                        <div class="data-box">
                            <h3>Total Cart Items</h3>
                            <p><?php echo $no_cart ?></p>
                        </div>
                        <div class="data-box">
                            <h3>Total Orders</h3>
                            <p><?php echo $no_orders ?></p>
                        </div>
                        <div class="data-box">
                            <h3>Approved Orders</h3>
                            <p><?php echo $approved_orders ?></p>
                        </div>
                        <div class="data-box">
                            <h3>Total Sales</h3>
                            <p><?php echo 'R ' . $approved_total . '.00' ?> </p>
                        </div>
                    </div>
                </div>
            

        </div>



</body>


</html>