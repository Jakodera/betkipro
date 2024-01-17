<?php
require('../conn/conn.php');

  $money=$_POST['money'];
$number=$_POST['number'];
  /* Urls */
  $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $b2c_url = 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
  if(isset($number) && isset($money)){
    
    $sql="SELECT account_balance from users_table where user__id =?";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$number]);
    $row=$stmt->fetch();
    

    // $account_balance = 1000;

    if((int)($account_balance) > (int)$money){

  /* Required Variables */
  $consumerKey = 'WN2WhBH9pECFtXQA0M95ifTbrf2squ7u';        # Fill with your app Consumer Key
  $consumerSecret = 'xEJSRXHIjRlB4qQA';     # Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  
  /* from the test credentials provided on you developers account */
  $InitiatorName = 'juneawuor';      # Initiator
  $SecurityCredential = '748a3b3db8bbf7405e06f79ef05912964daa26a7197c8ab45d0e6142c7e8b53e'; 
  $CommandID = 'PromotionPayment';          # choose between SalaryPayment, BusinessPayment, PromotionPayment 
  $Amount = $money;
  $PartyA = '3036687';             # shortcode 1
  $PartyB = '254758778577';             # Phone number you're sending money to 
  $Remarks = 'Congratulations';      # Remarks ** can not be empty
  
  $QueueTimeOutURL = 'https://www.betkipro.com/callbacks/with.php';    # your QueueTimeOutURL
  $ResultURL = 'https://www.betkipro.com/callbacks/with.php';   
  $Occasion = 'winning';           # Occasion

  /* Obtain Access Token */
  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
  curl_close($curl);

  /* Main B2C Request to the API */
  $b2cHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2c_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cHeader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => $InitiatorName,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL,
    'Occasion' => $Occasion
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  //print_r($curl_response);
  $resonse=json_decode($curl_response,true);
  
  print_r($resonse);
    echo($resonse)['ResponseCode'];
}else{
  echo("bal");
}

}

?>
