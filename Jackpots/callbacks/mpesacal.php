<?php
require('../conn/conn.php');

$json = file_get_contents('php://input');

$obj = json_decode($json, TRUE);
$status = $obj['Body']['stkCallback']['ResultCode'];
$amount = $obj['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
$transid = $obj['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
$date = $obj['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
$number="0".substr($date,3);

$myfile = fopen("log.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);

/*
echo($number);
$sql="INSERT into transactions_table VALUES(:transaction_id,:user,:transaction_type,:transaction_time,:transaction_amount)";
$stmt=$conn->prepare($sql);
$stmt->debugDumpParams();
$stmt->execute([
    "transaction_id"=>$transid,
    "user"=>$number,
    "transaction_type"=>$status,
    "transaction_time"=>time(),
    "transaction_amount"=>(int)$amount
]);

*/

if($status=="0"){
    
    $balance = 0;
    
    $get = mysqli_query($conn, "select * from users_table where user__id= '$number' " );
    if(mysqli_num_rows($get)>0){
        while($data = mysqli_fetch_assoc($get)){
            $balance = $data['account_balance'];
        }
    }
    
    $new_balance = $amount+$balance;
    $sql=mysqli_query($conn, "UPDATE users_table set account_balance='$new_balance' where user__id= '$number' ");
}
