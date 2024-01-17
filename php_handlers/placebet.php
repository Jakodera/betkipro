<?php
session_start();

function generateRandomString($length = 10)
{
    $characters = '0123456789';
    // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$accountb = 1000;
require('../conn/conn.php');

if (empty($_SESSION['usernumber']) && !empty($_COOKIE['remember'])) {
    list($selector, $authenticator) = explode(":", $_COOKIE['remember']);
    $sql = "SELECT * from auth_tokes where selector= '$selector' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($token, $userid, $authid, $selector, $expires);
    $row = $stmt->fetch();
    if (hash_equals($token, hash('sha256', base64_decode($authenticator)))) {
        $_SESSION['usernumber'] = $userid;
    }
}
if (isset($_SESSION['usernumber'])) {
    $games_list = explode(',', $_SESSION['betslip']);
    if (isset($_POST['placebet'])) {
        $word = $_POST['placebet'];
    } else {

        $word = NULL;
    }
    $bet_id = generateRandomString(6);
    if (!empty($word) && $word >= 50 && is_int((int)$word)) {
        $username = $_SESSION['usernumber'];
        $sql = "SELECT account_balance FROM users_table where user__id= '$username' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($account_balance);
        $row = $stmt->fetch();
        $stmt->free_result();
        $account = $account_balance;

        if ($account < $word) {
            $sql = "DELETE from bets_table where bet_id='$bet_id' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            header('location:../html/success.php?message=balance');
        } else {

            $possible_win = $_SESSION['total'] * $word;
            $total_odds = $_SESSION['total'];

            mysqli_query($conn,"INSERT INTO bets_table(bet_id,user__id,bet_status,bet_amount,possiblewin,total_odds) VALUES ('$bet_id','$username','not placed','$word','$possible_win','$total_odds') " );
        
            foreach ($games_list as $key => $market_id) {
                $fix_id= substr($market_id, 0, -1);
                $get = mysqli_query($conn,"SELECT * FROM markets_table WHERE fixture_id='$fix_id' ");

                if(mysqli_num_rows($get)>0){
                    while($data = mysqli_fetch_assoc($get)){
                        $commence_time = $data['commence_time'];
                    }
                }else{
                    $commence_time = '';
                }

                if ($commence_time > time()) {
                    echo "got here";
                    try {

                        $conn->begin_transaction();

                        $betslip = generateRandomString(8);


                        $fixture_id = substr($market_id, 0, -1);
                        $bet_value = substr($market_id, -1);


                        $sql = mysqli_query($conn,"INSERT INTO betslip_table (betslip_id,bet_id,fixture_id,bet_value) VALUES('$betslip','$bet_id','$fixture_id','$bet_value')" );
                        $account_bal = intval($account) - intval($word);

                        mysqli_query($conn, "UPDATE users_table SET account_balance = '$account_bal' WHERE user__id = '$username' ");
                        
                        mysqli_query($conn,"UPDATE bets_table SET bet_status = 'pending' WHERE bet_id='$bet_id'");
                        
                        $conn->commit();
                    } catch (Exception $e) {
                        $conn->rollBack();
                        $sql = "DELETE FROM bets_table WHERE bet_id = '$bet_id' ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        header('location:../html/success.php?message=err');
                        exit();
                    }
                }
            }
            $stmt->free_result();

            $sql = "UPDATE admintable set account_balance='$word',betsplaces='1',amount_paid_in='$word' where admin_id='0706885761' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            // $stmt->debugDumpParams();

            $message = 'betkipro Bet ' . $bet_id . ' placed successfully. Possible win ' . $_SESSION['total'] * $word . ' Best of luck.';
            $url = 'https://mysms.celcomafrica.com/api/services/sendsms/';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


            $curl_post_data = array(
                //Fill in the request parameters with valid values
                'partnerID' => '',
                'apikey' => '',
                'mobile' => $username,
                'message' => $message,
                'shortcode' => 'CELCOM_SMS',
                'pass_type' => 'plain', //bm5 {base64 encode} or plain
            );

            $data_string = json_encode($curl_post_data);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

            $curl_response = curl_exec($curl);

            header('location:../html/success.php?message=success');
        }
    } else {
        echo "the problem lies here";
        $sql = "DELETE from bets_table where bet_id= '$bet_id' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header('location:../html/success.php?message=zero');
    }
} else {
    header("location:../html/login.php");
}
