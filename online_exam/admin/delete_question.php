<?php
session_start();
include '../db.php';

// Only admin allowed
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

// Delete question
if(isset($_GET['id'])){
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM questions WHERE id='$id'");
}

// Redirect back
header("Location: view_questions.php");
exit();
?>