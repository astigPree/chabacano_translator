<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include dirname(__DIR__) . '/config/DBConnector.php';

echo "Script started<br>";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo "Username and password are set<br>";
    echo "Username : $username<br>";
    echo "Password : $password<br>";

    $query = "SELECT * FROM admins_tb WHERE username = :username";
    $stmt = $conn->prepare($query);
    echo "Query prepared<br>";

    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    echo "Value bound<br>";

    try {
        $stmt->execute();
        echo "Query executed<br>";

        if ($stmt->rowCount() > 0) {
            echo "User found<br>";
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row['password'])) {
                echo "Password verified<br>";
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['isLoggedIn'] = true;
                header('Location: ../view/admin/index.php');
            } else {
                echo "Invalid username or password<br>";
            }
        } else {
            echo "No user found<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
} else {
    echo "Username or password not set<br>";
}
?>
