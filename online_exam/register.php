<?php
include 'db.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        echo "Email already registered!";
    } else {
        $query = "INSERT INTO users (username, email, password, role)
                  VALUES ('$username', '$email', '$password', '$role')";

        if(mysqli_query($conn, $query)){
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <form method="POST">

        <select name="role">
            <option value="student">Student</option>
            <option value="admin">Admin</option>
        </select>

        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>

</html>
<?php include 'footer.php'; ?>