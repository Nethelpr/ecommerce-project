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


        <div class="box navi" style="grid-area: box-1">

            <div class="sys-name">
                Welcome to SimpCommerce &nbsp; <img src="../sys_img/simpcommerce logo.png" alt="system logo">
            </div>

            <ul>
                <a href="admin_dash.php" style="text-decoration: none; color: white;"><li onclick="border()">Dashboard</li></a>
                <a href="create_products.php" style="text-decoration: none; color: white;"><li onclick="border()">Create Products</li></a>
                <a href="category.php" style="text-decoration: none; color: white;"><li onclick="border()">Create Categories</li></a>
                <li onclick="border()">Create Admin</li>
                <li onclick="border()">Manage Admins</li>
                <li onclick="border()">Manage Categories</li>
                <li onclick="border()">View Products</li>
                <li onclick="border()">View Orders</li>
                <li onclick="border()">View User Details</li>
            </ul>

            <a href="p_logout.php" style="text-decoration: none;">
                <div class="sys-out">
                    Logout &nbsp; <img src="../sys_img/logout.png" alt="logout icon">
                </div>
            </a>

        </div>

        <div class="box system-parts" style="grid-area: box-2">

            <div class="part" style="display: block">
                <style>
                    body {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

                    }

                    .form-container {
                        background: rgba(255, 255, 255, 0.95);
                        backdrop-filter: blur(10px);
                        border-radius: 20px;
                        padding: 40px;
                        margin: 50px auto;
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                        width: 100%;
                        max-width: 500px;
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
                        font-size: 2.2rem;
                        font-weight: 300;
                    }

                    .form-group {
                        margin-bottom: 25px;
                    }

                    label {
                        display: block;
                        margin-bottom: 8px;
                        color: #555;
                        font-weight: 500;
                        font-size: 1rem;
                    }

                    input[type="text"],
                    input[type="file"],
                    textarea {
                        width: 100%;
                        padding: 15px;
                        border: 2px solid #e1e1e1;
                        border-radius: 10px;
                        font-size: 1rem;
                        transition: all 0.3s ease;
                        background: rgba(255, 255, 255, 0.9);
                    }

                    input[type="text"]:focus,
                    input[type="file"]:focus,
                    textarea:focus {
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

                    .submit-btn {
                        width: 100%;
                        padding: 15px;
                        background: linear-gradient(45deg, #667eea, #764ba2);
                        color: white;
                        border: none;
                        border-radius: 10px;
                        font-size: 1.1rem;
                        font-weight: 500;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                    }

                    .submit-btn:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
                    }

                    .submit-btn:active {
                        transform: translateY(0);
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

                    .form-group {
                        animation: slideIn 0.6s ease forwards;
                    }

                    .form-group:nth-child(1) {
                        animation-delay: 0.1s;
                    }

                    .form-group:nth-child(2) {
                        animation-delay: 0.2s;
                    }

                    .form-group:nth-child(3) {
                        animation-delay: 0.3s;
                    }

                    .form-group:nth-child(4) {
                        animation-delay: 0.4s;
                    }
                </style>

                <div class="form-container">
                    <h1>Add Category</h1>
                    <div id="feedback" class="error" aria-live="polite"></div>
                    <form id="categoryForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input
                                type="text"
                                id="categoryName"
                                name="categoryName"
                                required
                                placeholder="Enter category name...">
                        </div>

                        <div class="form-group">
                            <label for="categoryImage">Category Image</label>
                            <div class="file-input-wrapper">
                                <input
                                    type="file"
                                    id="categoryImage"
                                    name="categoryImage"
                                    accept="image/*"
                                    required>
                                <span id="fileText">📸 Choose Image File</span>
                            </div>
                            <div id="fileName" class="file-name"></div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                required
                                placeholder="Enter category description..."></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="submit-btn">
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
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

    function insert(x) {

       
    }


    //send category form data to processing file using fetch

    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const feedback = document.getElementById('feedback');
        feedback.textContent = '';

        //fetch processing file
        fetch('p_category.php', {
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
                feedback.textContent = 'Category created successfully!';
                form.reset(); // Reset the form after successful submission
            } else {
                console.log('error');
                feedback.textContent = data.message || 'Failed to create category.';
            }
        }).catch(error => {
            console.error('Error:', error);
            feedback.textContent = 'An error occurred. Please try again.';
        })


    });
</script>

</html>