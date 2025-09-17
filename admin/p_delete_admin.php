<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit;
} else {

// Ensure the request is POST and content is JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Get the raw POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['id'])) {
    $admin_to_delete = $data['id'];

    if(isset($_SESSION['admin_id']) === 1){
        // Admin is logged in
        
    include_once('../includes/db.php');
    $id = $admin_to_delete;

    $stmt = $pdo->prepare("DELETE FROM admin WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Admin Deleted']); 
      // header("Location: manage_admins.php");
        exit();

    } else {
        // super user not logged in
       echo json_encode(['status' => 'error', 'message' => 'You are unauthorized to perform this action.']); 
      // header("Location: manage_admins.php");
        
        //return a response 
        
        exit();
        
    }

    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error in processing... try again later.']); 
      // header("Location: manage_admins.php");
        
        //return a response 
        
        exit();

}
}
}