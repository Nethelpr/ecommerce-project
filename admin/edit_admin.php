<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit;
} else {

    require_once '../includes/db.php';

    // Fetch admin details
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$admin) {
        echo "Admin not found.";
        exit;
    }

    
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

        <div class="exit" style="width:100%; height: fit-content; padding: 2%; text-align: right;">

        </div>

            <div id="welcome">
                <h2 style="margin-bottom: 20px;">Edit Admin</h2>
                <p>Here you can make edits to your admin's information.</p>

                <br>
                <h3>Edit Account Information</h3>

                <div class="feedback" id='feedback' style="width: 100%; height: fit-content; padding: 1.3%; text-align: center;">

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

                   form{
                    width: fit-content;
                    padding: 1%;

                   }

                   form .form-parts{
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 20px;
                    width: 300px;
                   }

                   form .form-parts label{
                    margin-bottom: 10px;
                    font-weight: bold;
                   }

                   form .form-parts input{
                    padding: 10px;
                    border: 1px solid gray;
                    border-radius: 5px;
                    font-size: 16px;
                   }



                </style>

                <form action="" method="POST" id="updateAdmin">

                    <div class="form-parts">
                        <label for="id">Admin ID</label>
                        <input type="number" id="id" name="id" value="<?php echo htmlspecialchars($admin['id']); ?>" placeholder="<?php echo htmlspecialchars($admin['id']); ?>" required readonly>
                    </div>

                    <div class="form-parts">
                        <label for="name">Admin Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($admin['admin_name']); ?>" placeholder="<?php echo htmlspecialchars($admin['admin_name']); ?>" required>
                    </div>

                    <div class="form-parts">
                        <label for="email">Admin Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['username']); ?>"  required>
                    </div>

                    <div class="form-parts">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($admin['password']); ?>" required  pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}">
                        <br><h4>Allowed Password Format</h4>
                                                <ul style="color: darkgrey">
                                                    <li>Must contain at least one Capital letter</li>
                                                    <li>Must contain lower case letters</li>
                                                    <li>Must contain a number</li>
                                                    <li>Must contain symbols e.g. "@ # $ % &"</li>
                                                    <li>Must be 8 characters long or more to pass</li>
                                                </ul>
                    </div>
                    
                    <div class="form-parts">
                        <input type="submit" value="Update Admin" style="background-color: #ff7e5f; color: white; border: none; cursor: pointer;">
                    </div>


                </form>
                    
                      

                       
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

    document.getElementById('updateAdmin').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const feedback = document.getElementById('feedback');
        feedback.textContent = '';

        //fetch processing file
        fetch('p_edit_admin.php', {
            method: 'POST',
            body: new FormData(form),
            credentials: 'same-origin'
        }).then(async response => {
            const text = await response.text();
            let data;
            try {
                data = JSON.parse(text);
            } catch (err) {
                throw new Error('Invalid server response: ' + text);
            }
            return data;
        }).then(data => {

            if (data.status === 'success') {
                console.log('win');
                feedback.textContent = data.message;
                feedback.style.color = 'green';
                form.reset(); // Reset the form after successful submission
            } else if (data.status === 'error'){
                console.log('error');
                feedback.textContent = data.message ;
                feedback.style.color = 'red';
                form.reset(); // Reset the form after successful submission
            }
        }).catch(error => {
            console.error('Error:', error);
            feedback.textContent = 'An error occurred. Please try again.';
        })


    });

    
</script>

</html>