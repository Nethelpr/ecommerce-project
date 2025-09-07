<?php

session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit;
} else {

//get admin ID 

$admin_id = $_SESSION['admin_id'];

//get all categories
$stmt = $pdo->prepare('SELECT * FROM admin_users');
$stmt->execute();
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
  

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
            border: 2px solid #ff7e5f;
            padding-left: 20px;
            transition: all 0.3s ease-in-out;
        }
    </style>

    <div class="grid-container">


    <?php include 'nav.php'?>

        <div class="box system-parts" style="grid-area: box-2">

            <style>
              

                body {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                   
                }

                .form-container {
                    background: rgba(255, 255, 255, 0.95);
                    backdrop-filter: blur(10px);
                    border-radius: 20px;
                    padding: 40px;
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                    max-width: 800px;
                    margin: 3% auto 0;
                    transform: translateY(0);
                    transition: transform 0.3s ease;
                }

                .form-container:hover {
                    transform: translateY(-5px);
                }

                h1 {
                    text-align: center;
                    color: #333;
                    margin-bottom: 30px;
                    font-size: 2.5rem;
                    font-weight: 300;
                }

                .form-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 25px;
                    margin-bottom: 25px;
                }

                .form-group {
                    margin-bottom: 25px;
                }

                .form-group.full-width {
                    grid-column: 1 / -1;
                }

                label {
                    display: block;
                    margin-bottom: 8px;
                    color: #555;
                    font-weight: 500;
                    font-size: 1rem;
                }

                .required {
                    color: #e74c3c;
                }

                input[type="text"],
                input[type="number"],
                input[type="file"],
                textarea,
                select {
                    width: 100%;
                    padding: 15px;
                    border: 2px solid #e1e1e1;
                    border-radius: 10px;
                    font-size: 1rem;
                    transition: all 0.3s ease;
                    background: rgba(255, 255, 255, 0.9);
                }

                input[type="text"]:focus,
                input[type="number"]:focus,
                input[type="file"]:focus,
                textarea:focus,
                select:focus {
                    outline: none;
                    border-color: #667eea;
                    transform: scale(1.02);
                    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
                }

                textarea {
                    resize: vertical;
                    min-height: 120px;
                    font-family: inherit;
                }

                select {
                    cursor: pointer;
                }

                .file-input-wrapper {
                    position: relative;
                    overflow: hidden;
                    background: linear-gradient(45deg, #667eea, #764ba2);
                    color: white;
                    border-radius: 10px;
                    padding: 15px;
                    text-align: center;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .file-input-wrapper:hover {
                    transform: scale(1.05);
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                }

                .file-input-wrapper input[type="file"] {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 0;
                    cursor: pointer;
                }

                .file-name {
                    margin-top: 10px;
                    font-size: 0.9rem;
                    color: #666;
                    font-style: italic;
                }

                .checkbox-group {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    margin-bottom: 15px;
                }

                .checkbox-wrapper {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    cursor: pointer;
                }

                .submit-btn {
                    width: 100%;
                    padding: 18px;
                    background: linear-gradient(45deg, #667eea, #764ba2);
                    color: white;
                    border: none;
                    border-radius: 10px;
                    font-size: 1.2rem;
                    font-weight: 500;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    margin-top: 20px;
                }

                .submit-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
                }

                .submit-btn:active {
                    transform: translateY(0);
                }

                .submit-btn:disabled {
                    opacity: 0.7;
                    cursor: not-allowed;
                    transform: none;
                }

                @keyframes slideIn {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .form-group input{
                    padding: 5%;
                    width: 100%;
                    border-radius: 20px;
                }

                .form-group {
                    animation: slideIn 0.6s ease forwards;
                }

                @media (max-width: 768px) {
                    .form-grid {
                        grid-template-columns: 1fr;
                        gap: 20px;
                    }

                    .form-container {
                        padding: 30px 20px;
                    }

                    h1 {
                        font-size: 2rem;
                    }
                }
            </style>
            </head>

            <body>
                <div id="feedback" class="feedback" style="width: 100%; padding: 2%; text-align: center; display: flex; align-items: center; justify-content: center; color: white">

                </div>
                <div class="form-container">
                    <h1>Add an Admin</h1>
                    <form id="adminForm" method="post">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="adminmail">Admin Email<span class="required">*</span></label>
                                <input
                                    type="email"
                                    id="adminmail"
                                    name="adminmail"
                                    required
                                    placeholder="Enter admin email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password <span class="required">*</span></label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}"
                                    required
                                     
                                            >
                                            
                                            <div class="instructs" style="color: rgb(80, 79, 79); margin-top: 20px;">
                                                <h4>Allowed Password Format</h4>
                                                <ul style="color: green">
                                                    <li>Must contain at least one Capital letter</li>
                                                    <li>Must contain lower case letters</li>
                                                    <li>Must contain a number</li>
                                                    <li>Must contain symbols e.g. "@ # $ % &"</li>
                                                    <li>Must be 8 characters long or more to pass</li>
                                                </ul>
                                            </div>
                            </div>

                            <div class="form-group">
                                <label for="cpassword">Confirm Password <span class="required">*</span></label>
                                <input
                                    type="password"
                                    id="cpassword"
                                    name="cpassword"
                                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}" 
                                    required
                                            >

                                            <div class="pass_content" style="margin-top:1%; width: 100%; text-align:center; color: red">

                                            </div>
                            </div>
                            
                        </div>

                        

                        <button type="submit" class="submit-btn">
                            Add Admin
                        </button>
                    </form>
                </div>


        </div>



</body>
<script>
    //make the border of the ul li light

    function border() {
        let li = document.querySelectorAll('.navi ul li');
        li.forEach((item) => {
            item.style.border = '2px solid rgb(48, 48, 48)';
        });
        event.target.style.border = '2px solid  #ff7e5f';
    }

    // form elements 

    
    let pass = document.getElementById('cpassword');
let pass1 = document.getElementById('password');

//disable button
const submitBtn = document.querySelector('.submit-btn');

function check_password() {
    if (pass1.value === pass.value && pass1.value !== '') {
        document.querySelector('.pass_content').innerHTML = 'Passwords match';
        document.querySelector('.pass_content').style.color = 'green';
        submitBtn.disabled = false; // Enable button
    } else {
        document.querySelector('.pass_content').innerHTML = 'Passwords do not match';
        document.querySelector('.pass_content').style.color = 'red';
        submitBtn.disabled = true; // Enable button
    }
}

// Attach event listeners to both fields
pass.addEventListener('keyup', check_password);
pass1.addEventListener('keyup', check_password);

    

    
   


    //send product form data to processing file using fetch

    document.getElementById('adminForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const feedback = document.getElementById('feedback');
        feedback.textContent = '';

        //fetch processing file
        fetch('p_addAdmin.php', {
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
                feedback.textContent = 'Admin added successfully!';
                form.reset(); // Reset the form after successful submission
            } else {
                console.log('error');
                feedback.textContent = data.message || 'Failed to add admin.';
            }
        }).catch(error => {
            console.error('Error:', error);
            feedback.textContent = 'An error occurred. Please try again.';
        })


    });

    
</script>

</html>