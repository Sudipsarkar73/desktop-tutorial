<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}
?>
<?php include '../header.php'; ?>
<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include '../db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['add'])){
    $q = $_POST['question'];
    $o1 = $_POST['opt1'];
    $o2 = $_POST['opt2'];
    $o3 = $_POST['opt3'];
    $o4 = $_POST['opt4'];
    $correct = $_POST['correct'];

    $query = "INSERT INTO questions (question, option1, option2, option3, option4, correct_answer)
              VALUES ('$q','$o1','$o2','$o3','$o4','$correct')";

    if(mysqli_query($conn, $query)){
        echo "Question added!";
    } else {
        echo "Error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
</head>
<body>
<link rel="stylesheet" href="../css/style.css">

<div class="container" style="width:500px;">

    <h2>➕ Add Question</h2>

    <form method="POST">

        <input type="text" name="question" placeholder="Enter Question" required>

        <input type="text" name="opt1" placeholder="Option A" required>
        <input type="text" name="opt2" placeholder="Option B" required>
        <input type="text" name="opt3" placeholder="Option C" required>
        <input type="text" name="opt4" placeholder="Option D" required>

        <input type="number" name="correct" placeholder="Correct Answer (1-4)" min="1" max="4" required>

        <button type="submit" name="add">Add Question</button>

    </form>

    <br>
    <a href="dashboard.php">⬅ Back</a>

</div>
</body>
</html>
<?php include '../footer.php'; ?>