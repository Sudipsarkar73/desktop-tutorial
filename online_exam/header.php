<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Exam System</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
        }

        .nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            background: #0056b3;
            padding: 10px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="page-wrapper">

<div class="header">
    🎓 Online Exam System
</div>

<div class="nav">
    <a href="index.php">Home</a>

    <?php if(isset($_SESSION['user'])){ ?>
        <a href="student_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php } ?>
</div>