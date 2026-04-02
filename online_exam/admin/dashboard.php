<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}
?>
<?php include '../header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .dashboard {
            width: 500px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .dashboard h2 {
            margin-bottom: 20px;
        }

        .dashboard button {
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            font-size: 16px;
        }

        .logout {
            background: #dc3545;
        }

        .logout:hover {
            background: #b02a37;
        }
    </style>
</head>
<body>

<div class="dashboard">

    <h2>🛠 Admin Dashboard</h2>

    <a href="add_question.php">
        <button>➕ Add Question</button>
    </a>

    <a href="view_questions.php">
        <button>📋 View Questions</button>
    </a>

    <a href="../logout.php">
        <button class="logout">🚪 Logout</button>
    </a>

</div>

</body>
</html>
<?php include '../footer.php'; ?>