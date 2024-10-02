<?php
session_start();
include('FDA2.php');

// Redirect if not logged in
if (!isset($_SESSION['faculty_id'])) {
    header("Location: Login1.php");
    exit();
}

$faculty_id = $_SESSION['faculty_id'];

// Fetch current faculty data
$query = $conn->prepare("SELECT * FROM faculty WHERE id = :id");
$query->bindParam(':id', $faculty_id);
$query->execute();
$faculty = $query->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    // Update faculty profile
    $updateQuery = $conn->prepare("UPDATE faculty SET name = :name, email = :email, department = :department WHERE id = :id");
    $updateQuery->bindParam(':name', $name);
    $updateQuery->bindParam(':email', $email);
    $updateQuery->bindParam(':department', $department);
    $updateQuery->bindParam(':id', $faculty_id);
    $updateQuery->execute();

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $faculty['name']; ?>" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $faculty['email']; ?>" required><br><br>
        
        <label>Department:</label><br>
        <input type="text" name="department" value="<?php echo $faculty['department']; ?>" required><br><br>
        
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>