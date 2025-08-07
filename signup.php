
<?php
// Replace with your actual RDS DB credentials
$host = 'mydatabase.cdiyu2mmghlj.ap-south-1.rds.amazonaws.com';
$db = 'your_database_name';
$user = 'admin';
$pass = 'Ravi12345#';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$username, $email, $password]);
        echo "Signup successful!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
