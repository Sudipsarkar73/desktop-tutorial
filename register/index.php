

<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>

    <label for="pass">password</label>
    <input type="password" name="password" id="pass"><br>

    <button type="submit">Submit</button>

</form>

<?php

require "../config/db.php";
?>
<table style="border: 2px solid black; border-collapse: collapse;">
    <tr style="border: 2px solid black; border-collapse: collapse;">
        <th style="border: 2px solid black; border-collapse: collapse;">Name</th>
        <th style="border: 2px solid black; border-collapse: collapse;">Email</th>
        <th style="border: 2px solid black; border-collapse: collapse;">Action</th>
    </tr>

<?php
$rows = $conn->query("SELECT * FROM test1");


while ($row = $rows->fetch_assoc()):?>
    <tr style="border: 2px solid black; border-collapse: collapse;">
        <td style="border: 2px solid black; border-collapse: collapse;"><?php echo $row['name'] ?></td>
        <td style="border: 2px solid black; border-collapse: collapse;"><?php echo $row['email'] ?></td>
        <td style="border: 2px solid black; border-collapse: collapse;">
           
            <form method="post" action="">
                <input hidden type="number" name="id" value="<?php echo $row['id'] ?>">
                <button type="delete" value="<?php echo $row['id'] ?>" name="delete">Delete</button>
            </form>
        </td>
    </tr>
<?php endwhile; ?>
</table>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $id = $_POST['id'] ?? NULL;
    $isdelete =$_POST['delete'] ?? '';
    
    if ($name && $email && $password) {

    // echo "Name: " . $name . "<br>";
    // echo "Email: " . $email . "<br>";
    // echo "Password: " . $password . "<br>";

    // $conn->query("INSERT INTO test1 (name, email, password) VALUES ('$name', '$email', '$password')");
    
        $exec = $conn->prepare("INSERT INTO test1 (name, email, password) VALUES (?, ?, ?)");
        $exec->bind_param("sss", $name, $email, $password);
        $exec->execute();

        echo "done";
        $conn->close();
    }
    elseif ($id && $isdelete) {
        $exec = $conn->prepare("DELETE FROM test1 WHERE id = ?");
        $exec->bind_param("i", $id);
        $exec->execute();

        echo $id . " deleted";
        $conn->close();

    }
}
?>
