<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM questions";
$result = mysqli_query($conn, $query);

$questions = [];
while($row = mysqli_fetch_assoc($result)){
    $questions[] = $row;
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Exam</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .question-box {
            display: none;
        }

        .active {
            display: block;
        }

        .option {
            display: block;
            padding: 10px;
            margin: 8px 0;
            background: #f1f1f1;
            border-radius: 5px;
            cursor: pointer;
        }

        .option input {
            margin-right: 10px;
        }

        .btn {
            padding: 10px;
            margin-top: 15px;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container" style="width:600px;">

<h2>Online Exam</h2>

<form method="POST" action="submit_exam.php">

<?php foreach($questions as $index => $q){ ?>
    
    <div class="question-box <?php echo $index == 0 ? 'active' : ''; ?>" id="q<?php echo $index; ?>">
        
        <h3>Question <?php echo $index+1; ?></h3>
        <p><b><?php echo $q['question']; ?></b></p>

        <label class="option">
            <input type="radio" name="q<?php echo $q['id']; ?>" value="1">
            A. <?php echo $q['option1']; ?>
        </label>

        <label class="option">
            <input type="radio" name="q<?php echo $q['id']; ?>" value="2">
            B. <?php echo $q['option2']; ?>
        </label>

        <label class="option">
            <input type="radio" name="q<?php echo $q['id']; ?>" value="3">
            C. <?php echo $q['option3']; ?>
        </label>

        <label class="option">
            <input type="radio" name="q<?php echo $q['id']; ?>" value="4">
            D. <?php echo $q['option4']; ?>
        </label>

        <?php if($index < count($questions)-1){ ?>
            <button type="button" class="btn" onclick="nextQuestion(<?php echo $index; ?>)">
                Next →
            </button>
        <?php } else { ?>
            <button type="submit" class="btn">Submit Exam</button>
        <?php } ?>

    </div>

<?php } ?>

</form>

</div>

<script>
function nextQuestion(index){
    document.getElementById("q"+index).classList.remove("active");
    document.getElementById("q"+(index+1)).classList.add("active");
}
</script>

</body>
</html>
<?php include 'footer.php'; ?>