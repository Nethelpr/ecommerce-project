<?php 

session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit;
} else {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if ($_SESSION['admin_id'] !== "3") {
        
            //return a response 
            echo json_encode(['status' => 'error', 'message' => 'Only super admin can make edits to admin data']);
            exit;
    
        } else {
    
            // Process the form submission
            
            $admin_to_edit = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
            $stmt = $pdo->prepare("UPDATE admin_users SET username = ?, password = ?, admin_name = ? WHERE id = ?");
            $stmt->execute([$email, $password, $name, $admin_to_edit]); 
    
            //return a response 
            echo json_encode(['status' => 'success', 'message' => 'Admin details updated successfully']);
            exit;
    
    
       
    
    }












    }

    



}