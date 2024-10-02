<?php
session_start();
include('config.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM faculty WHERE username = :username");
    $query->bindParam(':username', $username);
    $query->execute();
    $faculty = $query->fetch(PDO::FETCH_ASSOC);

    if ($faculty && password_verify($password, $faculty['password'])) {
        $_SESSION['faculty_id'] = $faculty['id'];
        header("Location: profile.php");
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Faculty Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit" name="login">Login</button>
    </form>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>