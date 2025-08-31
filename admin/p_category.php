<?php

//connect to database
require_once __DIR__ . '/../includes/db.php';

//create category
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST['categoryName'];
    $description = $_POST['description'];
    $image = $_FILES['categoryImage'];

    // Validate inputs
    if (empty($categoryName) || empty($description) || empty($image['name'])) {
        echo "All fields are required.";
    } else {
        // Process the image upload and save category to database
        // Here you would typically handle the file upload, e.g.:
        if ($image['error'] !== UPLOAD_ERR_OK) {
            echo "Error uploading image: " . $image['error'];
            exit;
        } else {

            //check if category already exists
            $stmt = $pdo->prepare("SELECT * FROM categories WHERE name = :categoryName");
            $stmt->bindParam(':categoryName', $categoryName);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // Email already exists, show an error message
                echo json_encode(['status' => 'error', 'message' => 'Category already exists.']);
                exit;
            } else {

                //upload the image
                $tmp_name = $_FILES['categoryImage']['tmp_name'];
                $path = getcwd() . DIRECTORY_SEPARATOR . 'uploads';
                $dbPath = $categoryName . '_' . time() . $_FILES['categoryImage']['name'];
                $name = $path . DIRECTORY_SEPARATOR . $categoryName . '_' . time() . $_FILES['categoryImage']['name'];
                $success = move_uploaded_file($tmp_name, $name);

                //upload data to database
                $stmt = $pdo->prepare("INSERT INTO categories (name, image, description) VALUES (:name, :image, :description)");
                //bind parameters   
                $stmt->bindParam(':name', $categoryName);
                $stmt->bindParam(':image', $dbPath);
                $stmt->bindParam(':description', $description);
                //execute the statement 
                $stmt->execute();



                if ($success && $stmt->rowCount() > 0) {
                    //return a response 
                    echo json_encode(['status' => 'success', 'message' => 'Category Created.']);
                    exit;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'error creating category.']);
                    exit;
                }
            }


        }
    }
}
