<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit;
} else {


    //get data 

    $admin_id = $_SESSION['admin_id'];

    //database connection
    include '../includes/db.php';

    //get all categories
    $stmt = $pdo->prepare('SELECT * FROM categories');
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard - Manage Admins</title>
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
            background-color: white;
            padding: 6% 10%;
            border-radius: 10px;
        
            
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

            <div id="welcome">
                <h2 style="margin-bottom: 20px;">Manage Categories</h2>
                <p>Here you can manage existing Categories here. You can view, edit, or delete categories as needed.</p>
                <br>
                <h3>Categories</h3>

                <div class="feedback" style="width: 100%; height: fit-content; padding: 1.3%; text-align: center;">

                </div>

                <div class="part">

                    <div class="cate" style="display: flex;column-gap: 10px;flex-wrap: wrap; align-items: center; justify-content: center;">

                        <?php foreach($categories as $cate){

                            echo '<div>';
                                        
                                        echo '<div style="width: 100%; height: 200px;margin-top: 5px;">';
                                        echo '<img src="uploads/'.$cate['image'].'" alt="'.$cate['name'].'" style="width: 100%; height: 100%; border-radius: 10px; object-fit: cover; margin-bottom: 10px;">';
                                        echo '</div>';
                                        echo '<form action="#" mathod="POST" enctype="multipart/form-data">';
                                        echo '<div>

                                             <input type="number" name="category_id" value="'.$cate['id'].'" style="width: 60%; padding: 1%; margin: 3px 0; border-radius: 5px; border: 1px solid white; background-color: whitesmoke; " readonly>
                                            <input type="text" name="category_name" value="'.$cate['name'].'" style="width: 60%; padding: 1%; margin: 3px 0; border-radius: 5px; border: 1px solid white; background-color: whitesmoke;" readonly>
                                            <input type="text" name="category_description" value="'.$cate['description'].'" style="width: 60%; padding: 1%; margin: 3px 0; border-radius: 5px; border: 1px solid white; background-color: whitesmoke;" readonly>
                                        
                                        
                                        
                                        
                                        </div>';
                                        echo '</form>';

                                        echo '</div>';
                                    
                                    }

                        ?>

                    </div>


                </div>
                
                
            </div>


        </div>



</body>
<script>
        

    
    function editAdmin(id){
        //redirect to edit admin page with id as parameter
        window.location.href = 'edit_admin.php?id=' + id;
    }


    //fetch processing file

    function deleteAdmin(id){

        let feedback = document.getElementsByClassName('feedback')[0];

        if (confirm("Are you sure you want to delete this admin?")) {
        fetch('p_delete_admin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json()) // assuming JSON response
        .then(data => {
            if (data.success) {
                feedback.innerHTML = "Admin deleted successfully.";
                feedback.style.color = "green";
                // Optionally reload or remove element from DOM
                location.reload();
            } else {
                feedback.innerHTML =  data.message;
                feedback.style.color = "red";
                setInterval(() => {
                    location.reload();
                }, 3000);
                
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

    
</script>

</html>