<?php
  session_start();
  require('../conn/conn.php');
  if (empty($_SESSION['usernumber']) && !empty($_COOKIE['remember'])) {
    list($selector, $authenticator) = explode(":", $_COOKIE['remember']);
    $sql = "SELECT * from auth_tokes where selector= '$selector' ";
    

    $stmt = $conn->prepare($sql);
    $stmt->execute();
  


    if (hash_equals($token, hash('sha256', base64_decode($authenticator)))) {
        $_SESSION['usernumber'] = $userid;
    }
}
  if($_SESSION['usernumber']!="0712345678"){
    header('location:../index.php');
  }
 
 
  
?>



<?php

$bets_placed =mysqli_num_rows(mysqli_query($conn,'select * from bets_table '));

$users =mysqli_num_rows(mysqli_query($conn,'select * from users_table '));


$bets_won =mysqli_num_rows(mysqli_query($conn,"select * from bets_table where bet_status='won' "));

$bets_lost =mysqli_num_rows(mysqli_query($conn,"select * from bets_table where bet_status='Lost' "));

$pending =mysqli_num_rows(mysqli_query($conn,"select * from bets_table where bet_status='pending' "));

$get =mysqli_query($conn,"select * from bets_table ");
if(mysqli_num_rows($get)>0){
    while($data = mysqli_fetch_assoc($get)){
        $amount_paid+=$data['bet_amount'];
    }
}


$get =mysqli_query($conn,"select * from users_table ");
if(mysqli_num_rows($get)>0){
    while($data = mysqli_fetch_assoc($get)){
        $account_balance+=$data['account_balance'];
    }
}

$get =mysqli_query($conn,"select * from bets_table where bet_status='won'");
if(mysqli_num_rows($get)>0){
    while($data = mysqli_fetch_assoc($get)){
        $possiblewin+=$data['possiblewin'];
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<style>
  .row{
    background-color: #1b2431;
  }
</style>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,600" />
  <link rel="stylesheet" href="../css/das.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.selectric/1.10.1/selectric.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
  <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">User/Main Site</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="../php_handlers/logout.php">Sign out</a>
      </li>
    </ul>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <i class="zmdi zmdi-widgets"></i>
                Dashboard <span class="sr-only"></span>
              </a>
            </li>
            
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center pl-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <i class="zmdi zmdi-plus-circle-o"></i>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Social engagement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Year-end sale
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
        <div class="card-list">
          <div class="row">
              
            <!--  <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">-->
            <!--  <div class="card green">-->
            <!--    <div class="title">Server Threshold</div>-->
            <!--    <i class="zmdi zmdi-upload"></i>-->
            <!--    <div class="value"><?php echo date("y-m-d");?></div>-->
                
            <!--  </div>-->
            <!--</div>-->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card blue">
                <div class="title">Bets Placed</div>
                <i class="zmdi zmdi-upload"></i>
                <div class="value"><?php echo $bets_placed; ?></div>
            
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card green">
                <div class="title">Bets Won</div>
                <i class="zmdi zmdi-upload"></i>
                <div class="value"><?php echo $bets_won ?></div>
                
              </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card green">
                <div class="title">Bets Lost</div>
                <i class="zmdi zmdi-upload"></i>
                <div class="value"><?php echo $bets_lost ?></div>
                
              </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card green">
                <div class="title">Ongoing |Pensing</div>
                <i class="zmdi zmdi-upload"></i>
                <div class="value"><?php echo $pending ?></div>
                
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card orange">
                <div class="title">Amount Paid out</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value">KES <?php echo $possiblewin ?></div>
                
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card red">
                <div class="title">AMOUNT PAID IN</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value">KES <?php echo $amount_paid; ?></div>
                
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card green">
                <div class="title">Account balance</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value">KES <?php echo $account_balance; ?></div>
                
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card blue">
                <div class="title">Users</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value"><?php echo $users; ?> Users</div>
                
              </div>
            </div>
          </div>
        </div>
        
        <div style="color:green;">
            
            <?php
            if(isset($_GET['cancel_id'])){
                $id = $_GET['cancel_id'];
                mysqli_query($conn,"update bets_table set bet_status='cancel' where bet_id='$id' ");
                
                echo "<p>Changes saved successfully.</p>";
            }
            ?>
            
            
             <?php
            if(isset($_GET['delete_id'])){
                $id = $_GET['cancel_id'];
                mysqli_query($conn,"delete from  bets_table where bet_id='$id' ");
                
                echo "<p>Bet removed from list.</p>";
            }
            ?>
            
        </div>
        
        
        <div class="projects mb-4">
          <div class="projects-inner">
            <header class="projects-header">
              <div class="title">Ongoing Bets</div>
              <div class="count">| Pending</div>
              <i class="zmdi zmdi-download"></i>
            </header>
            <table class="projects-table">
              <thead>
                <tr>
                  <th>Bet id</th>
                  <th>Time placed</th>
                  <th>User Number</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th class="text-right">Actions</th>
                </tr>
              </thead>
<?php 
date_default_timezone_set('UTC');
$sql=mysqli_query($conn, "SELECT * from bets_table where bet_status= 'pending' or bet_status='cancel' ORDER BY possiblewin desc ");


while($row = mysqli_fetch_assoc($sql) ){
    
  $bet_id = $row['bet_id'];
  $time_placed = $row['time_placed'];
  $user__id = $row['user__id'];
  $possiblewin =$row['possiblewin'];

  $bet_amount = $row['bet_amount'];
  $bet_status = $row['bet_status'];
  
   $date = new DateTime($time_placed);
   $date->setTimezone(new DateTimeZone('Africa/Nairobi'));
   $time_placed = $date->format('Y-m-d H:i:s');

echo "<tr>
<td>
 <a href='view_bet.php?bet=$bet_id' target='_blank'> <p>$bet_id</p></a>
 
</td>
<td>
  <p>$time_placed</p>
  
</td>
<td class='member'>
  <div class='member-info'>
    <p>$user__id</p>
    
  </div>
</td>
<td>
  <p>Ksh $possiblewin</p>
  <p> Ksh $bet_amount </p>
</td>
<td class='status'>
  <span class='status-text status-blue'>$bet_status</span>
</td>
<td>
  
  <a class='btn btn-danger btn-sm' href='dashboard.php?cancel_id=$bet_id'>Cancel</a>
  <a class='btn btn-warning btn-sm' href='dashboard.php?delete_id=$bet_id'>Delete</a>
  
</td>
</tr>"

;}
?>
              

            </table>
          </div>
        </div>
        
        
                <div class="projects mb-4">
          <div class="projects-inner">
            <header class="projects-header">
              <div class="title">Bets Won</div>
              <div class="count">| Won</div>
              <i class="zmdi zmdi-download"></i>
            </header>
            <table class="projects-table">
              <thead>
                <tr>
                  <th>Bet id</th>
                  <th>Time placed</th>
                  <th>User Number</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th class="text-right">Actions</th>
                </tr>
              </thead>
<?php 
$sql=mysqli_query($conn, "SELECT * from bets_table where bet_status= 'won' or bet_status='cancel' ORDER BY possiblewin desc ");


while($row = mysqli_fetch_assoc($sql) ){
  $bet_id = $row['bet_id'];
  $time_placed = $row['time_placed'];
  $user__id = $row['user__id'];
  $possiblewin =$row['possiblewin'];

  $bet_amount = $row['bet_amount'];
  $bet_status = $row['bet_status'];

echo "<tr>
<td>
 <a href='view_bet.php?bet=$bet_id' target='_blank'> <p>$bet_id</p></a>
 
</td>
<td>
  <p>$time_placed</p>
  
</td>
<td class='member'>
  <div class='member-info'>
    <p>$user__id</p>
    
  </div>
</td>
<td>
  <p>Ksh $possiblewin</p>
  <p> Ksh $bet_amount </p>
</td>
<td class='status'>
  <span class='status-text status-green'>$bet_status</span>
</td>

</tr>"

;}
?>
              

            </table>
          </div>
        </div>
        
                        <div class="projects mb-4">
          <div class="projects-inner">
            <header class="projects-header">
              <div class="title">Bets Lost</div>
              <div class="count">| Lost</div>
              <i class="zmdi zmdi-download"></i>
            </header>
            <table class="projects-table">
              <thead>
                <tr>
                  <th>Bet id</th>
                  <th>Time placed</th>
                  <th>User Number</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th class="text-right">Actions</th>
                </tr>
              </thead>
<?php 
$sql=mysqli_query($conn, "SELECT * from bets_table where bet_status= 'Lost' or bet_status='cancel' ORDER BY possiblewin desc ");


while($row = mysqli_fetch_assoc($sql) ){
  $bet_id = $row['bet_id'];
  $time_placed = $row['time_placed'];
  $user__id = $row['user__id'];
  $possiblewin =$row['possiblewin'];

  $bet_amount = $row['bet_amount'];
  $bet_status = $row['bet_status'];

echo "<tr>
<td>
 <a href='view_bet.php?bet=$bet_id' target='_blank'> <p>$bet_id</p></a>
 
</td>
<td>
  <p>$time_placed</p>
  
</td>
<td class='member'>
  <div class='member-info'>
    <p>$user__id</p>
    
  </div>
</td>
<td>
  <p>Ksh $possiblewin</p>
  <p> Ksh $bet_amount </p>
</td>
<td class='status'>
  <span class='status-text status-red'>$bet_status</span>
</td>
</tr>"

;}
?>
              

            </table>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.selectric/1.10.1/jquery.selectric.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>

<script src="../js/dashboard.js"></script>

</html>