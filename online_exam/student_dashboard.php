<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'student'){
    header("Location: login.php");
    exit();
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container" style="width:400px; text-align:center;">

    <h2>Welcome, <?php echo $_SESSION['user']['username']; ?> 👋</h2>

    <br>

    <a href="exam.php">
        <button>📝 Start Exam</button>
    </a>

    <br><br>

    <a href="view_result.php">
        <button>📊 View Result</button>
    </a>

    <br><br>

    <a href="logout.php">
        <button>🚪 Logout</button>
    </a>

</div>

</body>
</html>
<?php include 'footer.php'; ?>