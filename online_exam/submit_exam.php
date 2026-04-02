<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$score = 0;

// Calculate score
foreach($_POST as $key => $value){
    $id = str_replace("q","",$key);

    $query = "SELECT correct_answer FROM questions WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if($value == $row['correct_answer']){
        $score++;
    }
}

// Save result
$user_id = $_SESSION['user']['id'];

mysqli_query($conn, "INSERT INTO results (user_id, score, date)
VALUES ('$user_id', '$score', NOW())");

// Get total questions
$total_query = mysqli_query($conn, "SELECT * FROM questions");
$total = mysqli_num_rows($total_query);

// Calculate percentage
$percentage = ($total > 0) ? ($score / $total) * 100 : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .result-box {
            width: 420px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .score {
            font-size: 50px;
            font-weight: bold;
            color: #007bff;
            margin: 10px 0;
        }

        .percentage {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        .btn {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="result-box">

    <h2>🎉 Exam Result</h2>

    <p class="score"><?php echo $score; ?></p>

    <p class="percentage">
        Percentage: <?php echo round($percentage,2); ?>%
    </p>

    <a href="student_dashboard.php">
        <button class="btn">🏠 Back to Dashboard</button>
    </a>

</div>

</body>
</html>