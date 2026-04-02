<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

// JOIN query to get username + results
$query = "SELECT results.*, users.username 
          FROM results 
          JOIN users ON results.user_id = users.id 
          WHERE results.user_id='$user_id'
          ORDER BY results.id DESC";

$result = mysqli_query($conn, $query);
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Results</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .result-container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .username {
            text-align: center;
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #007bff;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .score {
            font-weight: bold;
            color: #007bff;
        }

        .date {
            color: #555;
        }

        .back-btn {
            margin-top: 20px;
            text-align: center;
        }

        .back-btn button {
            width: 200px;
        }
    </style>
</head>
<body>

<div class="result-container">

<h2>📊 My Exam Results</h2>

<!-- Show username -->
<p class="username">👤 <?php echo $_SESSION['user']['username']; ?></p>

<table>
<tr>
    <th>Score</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td class="score"><?php echo $row['score']; ?></td>
    <td class="date"><?php echo $row['date']; ?></td>
</tr>
<?php } ?>

</table>

</div>

<div class="back-btn">
    <a href="student_dashboard.php">
        <button>⬅ Back to Dashboard</button>
    </a>
</div>

</body>
</html>
<?php include 'footer.php'; ?>