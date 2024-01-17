<?php
include('../conn/conn.php');
if (isset($_POST['status']) && $_POST['status'] == true) {
    $user = $_POST['usernumber'];
    $password = $_POST['password'];
    $rem = $_POST['remember'];
    $sql = "SELECT * FROM users_table where user__id='$user' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $number = $stmt->num_rows();
    if ($number > 0) {
        $stmt->bind_result($user__id, $user_number, $user_password, $account_balance);

        if ($row = $stmt->fetch()) {
            // $pwdcheck = password_verify($password, $user_password);
            if ($user_password == $password) {
                session_start();
                $_SESSION['usernumber'] = $user;
                if ($rem == 'true') {
                    $selector = base64_encode(random_bytes(9));
                    $authenticator = random_bytes(3);
                    setcookie('remember', $selector . ':' . base64_encode($authenticator), time() + (86400 * 30), '/', 'betkipro.com');
                    $_COOKIE['remember'] = $selector;
                    $sql = "INSERT INTO auth_tokes(selector,token,userid,expires) values(:selector,:token,:userid,:expires)";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        "selector" => $selector,
                        "token" => hash('sha256', $authenticator),
                        "userid" => $user,
                        "expires" => date('Y-m-d\TH:i:s', time() + 86400 * 30)
                    ]);
                }

                echo ('login');
            }
        }
    } else {
        echo "nouser";
    }
} else {
    echo ("hello world");
}
