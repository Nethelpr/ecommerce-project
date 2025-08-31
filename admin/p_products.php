<?php

  //connect to database
 require_once __DIR__ . '/../includes/db.php';


  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      //data collection
      $productName = $_POST['productName'];
      $categoryID = $_POST['categoryId'] ;
      $price = $_POST['price'];
      $stockQty = $_POST['stock'];
      $description = $_POST['description'];
      $productImg = $_FILES['productImage'];
      if(isset($_POST['onSale'])){
          $onSale = true;
      } else {
          $onSale = false;

      }
      if(isset($_POST['salePercentage'])){
          $salePercentage = $_POST['salePercentage'];
      } else {
          $salePercentage = 0;
      }

      // Validate inputs
    if (empty($productName) || empty($categoryID) || empty($price) || empty($stockQty) || empty($description) || empty($productImg['name'])) {
        echo "All fields are required.";
    } else {
        // Process the image upload and save category to database
        // Here you would typically handle the file upload, e.g.:
        if ($productImg['error'] !== UPLOAD_ERR_OK) {
             //return a response 
             echo json_encode(['status' => 'error', 'message' => 'Image not uploaded']);
             exit;
        } else {

                //upload the image
                $tmp_name = $_FILES['productImage']['tmp_name'];
                $path = getcwd() . DIRECTORY_SEPARATOR . 'productImage';
                $dbPath =  '_' . time() . $_FILES['productImage']['name'];
                $name = $path . DIRECTORY_SEPARATOR . '_' . time() . $_FILES['productImage']['name'];
                $success = move_uploaded_file($tmp_name, $name);

                //upload data to database
                $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category_id, stock, on_sale, sale_percentage) VALUES (:name, :description, :price, :image, :category_id, :stock, :on_sale, :sale_percentage)");
                //bind parameters   
                $stmt->bindParam(':name', $productName);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':image', $dbPath);
                $stmt->bindParam(':category_id', $categoryID);
                $stmt->bindParam(':stock', $stockQty);
                $stmt->bindParam(':on_sale', $onSale);
                $stmt->bindParam(':sale_percentage', $salePercentage);
                
                //execute the statement 
                $stmt->execute();



                if ($success && $stmt->rowCount() > 0) {
                    //return a response 
                    echo json_encode(['status' => 'success', 'message' => 'Product Created.']);
                    exit;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'error creating Product.']);
                    exit;
                }
            


        }
    }


      




  }