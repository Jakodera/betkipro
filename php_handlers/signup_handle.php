<?php
include('../conn/conn.php');
$password = $_POST['password'];
$usernumber = $_POST['usernumber'];
if (isset($password)) {
    // $new_password = password_hash($password, PASSWORD_DEFAULT);
    $new_password = $password;
    $sql = "SELECT * FROM users_table where user__id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $number = $stmt->num_rows();

    $stmt->free_result();
    if (!empty($number)) {
        echo "regis";
    } else {
        $sql = "INSERT INTO users_table (user__id, user_number, user_password, account_balance) VALUES ('$usernumber', '$usernumber', '$new_password', '00.00')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        session_start();
        $_SESSION['usernumber'] = $usernumber;

        $sql = "UPDATE admintable set users_regis=users_regis+1 where admin_id= '0712345678' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "success";
    }
} else {
    echo "work";
}
