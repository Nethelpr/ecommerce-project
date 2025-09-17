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

                input[type="checkbox"] {
                    width: auto;
                    transform: scale(1.2);
                    cursor: pointer;
                }

                .sale-fields {
                    display: block;
                    opacity: 1;
                    transition: all 0.3s ease;
                    border: 2px dashed #667eea;
                    border-radius: 10px;
                    padding: 20px;
                    margin-top: 15px;
                    background: rgba(102, 126, 234, 0.05);
                }

                .sale-fields.show {
                    display: block;
                    opacity: 1;
                }

                .price-display {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 15px;
                    margin-top: 15px;
                }

                .price-info {
                    padding: 10px;
                    border-radius: 8px;
                    text-align: center;
                }

                .original-price {
                    background: rgba(231, 76, 60, 0.1);
                    color: #e74c3c;
                }

                .sale-price-display {
                    background: rgba(39, 174, 96, 0.1);
                    color: #27ae60;
                    font-weight: bold;
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
                    <h1>Add New Product</h1>
                    <form id="productForm" method="post" enctype="multipart/form-data">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="productName">Product Name <span class="required">*</span></label>
                                <input
                                    type="text"
                                    id="productName"
                                    name="productName"
                                    required
                                    placeholder="Enter product name...">
                            </div>

                            <div class="form-group">
                                <label for="categoryId">Category <span class="required">*</span></label>
                                <select id="categoryId" name="categoryId" required>
                                    <?php foreach($categories as $cate){
                                    
                                        echo '<option value="'.$cate['id'].'">' . $cate['name'] . '</option>';
                                    
                                    }
                                    
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price">Price <span class="required">*</span></label>
                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    step="0.01"
                                    min="0"
                                    required
                                    placeholder="0.00">
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock Quantity <span class="required">*</span></label>
                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    min="0"
                                    required
                                    placeholder="0">
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea
                                id="description"
                                name="description"
                                required
                                placeholder="Enter product description..."></textarea>
                        </div>

                        <div class="form-group full-width">
                            <label for="productImage">Product Image <span class="required">*</span></label>
                            <div class="file-input-wrapper">
                                <input
                                    type="file"
                                    id="productImage"
                                    name="productImage"
                                    accept="image/*"
                                    required>
                                <span id="fileText">📸 Choose Product Image</span>
                            </div>
                            <div id="fileName" class="file-name"></div>
                        </div>

                        <div class="form-group full-width">
                            <div class="checkbox-group">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" id="onSale" name="onSale">
                                    <label for="onSale">Product is on sale</label>
                                </div>
                            </div>

                            <div id="saleFields" class="sale-fields">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="salePercentage">Sale Percentage (%)</label>
                                        <input
                                            type="number"
                                            id="salePercentage"
                                            name="salePercentage"
                                            min="1"
                                            max="100"
                                            placeholder="10">
                                    </div>

                                    <div class="form-group">
                                        <label for="salePrice">Sale Price</label>
                                        <input
                                            type="number"
                                            id="salePrice"
                                            name="salePrice"
                                            step="0.01"
                                            min="0"
                                            placeholder="0.00"
                                            readonly>
                                    </div>
                                </div>

                                <div class="price-display" id="priceDisplay" style="display: block;">
                                    <div class="price-info original-price">
                                        <div>Original Price</div>
                                        <div id="originalPriceDisplay">$0.00</div>
                                    </div>
                                    <div class="price-info sale-price-display">
                                        <div>Sale Price</div>
                                        <div id="salePriceDisplay">$0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">
                            Create Product
                        </button>
                    </form>
                </div>


        </div>



</body>
<script>
    

    // Form elements
      
    const onSaleCheckbox = document.getElementById('onSale');
        const saleFields = document.getElementById('saleFields');
        const priceInput = document.getElementById('price');
        const salePercentageInput = document.getElementById('salePercentage');
        const salePriceInput = document.getElementById('salePrice');
        const priceDisplay = document.getElementById('priceDisplay');
        const originalPriceDisplay = document.getElementById('originalPriceDisplay');
        const salePriceDisplay = document.getElementById('salePriceDisplay');

        // Calculate sale price
        function calculateSalePrice() {
            const originalPrice = parseFloat(priceInput.value) || 0;
            const salePercentage = parseFloat(salePercentageInput.value) || 0;

            if (originalPrice > 0 && salePercentage > 0) {
                const discount = (originalPrice * salePercentage) / 100;
                const salePrice = originalPrice - discount;
                
                salePriceInput.value = salePrice.toFixed(2);
                originalPriceDisplay.textContent = `$${originalPrice.toFixed(2)}`;
                salePriceDisplay.textContent = `$${salePrice.toFixed(2)}`;
                priceDisplay.style.display = 'grid';
            } else {
                salePriceInput.value = '';
                priceDisplay.style.display = 'none';
            }
        }

        // Event listeners for price calculation
        priceInput.addEventListener('input', calculateSalePrice);
        salePercentageInput.addEventListener('input', calculateSalePrice);


    //send product form data to processing file using fetch

    document.getElementById('productForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const feedback = document.getElementById('feedback');
        feedback.textContent = '';

        //fetch processing file
        fetch('p_products.php', {
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
                feedback.textContent = 'Product created successfully!';
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