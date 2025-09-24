<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit;
} else {


    //get data 

    $admin_id = $_SESSION['admin_id'];

    
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
                <h2 style="margin-bottom: 20px;">Manage Admins</h2>
                <p>Here you can manage existing admin accounts. You can view, edit, or delete admin accounts as needed.</p>
                <br>
                <h3>Admin Accounts</h3>

                <div class="feedback" style="width: 100%; height: fit-content; padding: 1.3%; text-align: center;">

                </div>

                <div class="part" >

                <style>

                    #welcome > h2 , p, h3{
                        text-align: center;
                    }

                    #welcome > p , h3 {
                        margin-bottom: 30px;
                        
                    }

                    .part{
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-wrap: wrap;
                        flex-direction: row;
                        background-color: whitesmoke;
                        padding: 6%;
                        border-radius: 10px;
                    }

                    .admin-card{
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        padding: 15px;
                        margin: 10px;
                        width: fit-content;
                        height: fit-content;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                        transition: box-shadow 0.3s ease-in-out;
                        background-color: purple;
                        color: white;
                        transition: all 300ms ease-in-out;

                    }

                    .admin-card > div{
                        margin: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: flex-start;
                    }

                    .admin-card > div > span{
                        margin-right: 10px;
                        background-color: white;
                        color: purple;
                        padding: 5px 10px;
                        border-radius: 40%;
                    }

                    .admin-card .admin-actions {
                        justify-content: center;
                        padding-top: 10px;
                    }

                    .admin-card .admin-actions a{
                        text-decoration: none;
                        color: white;
                        
                    }

                    .admin-card:hover{
                        transform: translateY(-10px);
                    }

                    .admin-card .admin-actions a:nth-child(1){
                        

                        background-color: white;
                        color: purple;
                        padding: 5px 10px;
                        border-radius: 20px;
                    }

                    .admin-card .admin-actions a:nth-child(1):hover{
                        background-color: #f0f0f0;
                        color: green;
                        transition: all 0.3s ease-in-out;
                    }

                    .admin-card .admin-actions a:nth-child(2){
                        background-color: red;
                        color: white;
                        padding: 5px 10px;
                        border-radius: 20px;
                    }

                    .admin-card .admin-actions a:nth-child(2):hover{
                        background-color: darkred;
                        color: white;
                        transition: all 0.3s ease-in-out;
                    }



                </style>
                    
                        <?php
                        // Fetch admin accounts from the database
                        require_once __DIR__ . '/../includes/db.php';
                        $stmt = $pdo->query("SELECT id ,username, password, admin_name FROM admin_users");
                       /* while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['admin_name']) . "</td>";
                            echo "<td>
                                    <a href='edit_admin.php?id=" . urlencode($row['id']) . "' style='margin-right: 10px;'>Edit</a>
                                    <a href='delete_admin.php?id=" . urlencode($row['id']) . "' onclick=\"return confirm('Are you sure you want to delete this admin?');\">Delete</a>
                                  </td>";
                            echo "</tr>";
                        }*/

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class='admin-card'>";
                            echo " <div class='admin-heading'><span>". htmlspecialchars($row['id']) ."</span><h4>" . htmlspecialchars($row['admin_name'])    . "</h4></div>";
                            echo "<div class='admin-email'><span>@ </span>". htmlspecialchars($row['username']) ."</div>";
                            echo "<div class='admin-actions'>
                                    <a href='#' onclick='editAdmin(" . urlencode($row['id']) . ");' style='margin-right: 10px;'>Edit</a>
                                   <!-- <a href='p_edit_admin.php?id=" . urlencode($row['id']) . "' onclick=\"return confirm('Are you sure you want to delete this admin?');\">Delete</a> -->
                                     <a href='#' onclick='deleteAdmin(" . urlencode($row['id']) . ");'>Delete</a>
                                  </div>";
                            echo "</div>";
                        }
                        ?>
                    </tbody>
                </table>
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
                feedback.innerHTML = "Failed to delete admin: " + data.message;
                feedback.style.color = "red";
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

    
</script>

</html>