<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

$query = "SELECT * FROM questions";
$result = mysqli_query($conn, $query);
?>
<?php include '../header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Questions</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .table-container {
            width: 90%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #007bff;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background: #f1f1f1;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: #b02a37;
        }

        .back-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="table-container">

<h2>📋 All Questions</h2>

<table>
<tr>
    <th>ID</th>
    <th>Question</th>
    <th>A</th>
    <th>B</th>
    <th>C</th>
    <th>D</th>
    <th>Correct</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['question']; ?></td>
    <td><?php echo $row['option1']; ?></td>
    <td><?php echo $row['option2']; ?></td>
    <td><?php echo $row['option3']; ?></td>
    <td><?php echo $row['option4']; ?></td>
    <td><?php echo $row['correct_answer']; ?></td>

    <td>
        <a href="delete_question.php?id=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure you want to delete this question?');">
            <button class="delete-btn">Delete</button>
        </a>
    </td>
</tr>
<?php } ?>

</table>

</div>

<div class="back-btn">
    <a href="dashboard.php">
        <button>⬅ Back to Dashboard</button>
    </a>
</div>

</body>
</html>
<?php include '../footer.php'; ?>