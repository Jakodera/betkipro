 <?php
    session_start();
    require('../php_handlers/get_cookie.php');
    mango();
    $betid = $_GET['bet'];
    include('../conn/conn.php');
    $games = $_SESSION['betslip'];
    $games_list = explode(",", $games);
    $total = 1;
    if(!isset($_SESSION['usernumber'])){
        header('location:../index.php');
        exit();
        
    }
    
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betresult</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4M2S2XBJ16"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4M2S2XBJ16');
</script>
</head>

<body>
   
    <script>
        $(document).ready(function() {
            $('#placebet').keyup(function() {
                var stake = $("#placebet").val();
                var odds = $('.betslip-total-odds-value').html()
                $('.betslip-total-stake-value').html("KSH " + parseFloat(stake).toFixed(2));
                $('.betslip-potential-payout-value').html("KSH " + (odds * stake).toFixed(2));
            });
        });
    </script>
    <div class="betslip-container" id="modal">
        <div class="betslip-header-container">
            <div class="betslip-type-container"><span class="betslip-type">MultiBet</span> <span class="betslip-bet-count">( <?php echo count(array_filter(explode(",", $_SESSION['betslip']))); ?>)</span> <span class="betslip-odds"></span> </div>
        </div>
        <div class="betslip-clear" id="close"><span><a href="mybets.php">Close betslip</a></span></div>
        <div class="betslip-pick-container">
            <?php
            //$sql = "SELECT * FROM betsplaced WHERE user__id=? and bet_id=?";

            $my_id = $_SESSION['usernumber'];

            $sql=mysqli_query($conn, "SELECT `bets_table`.`bet_id` AS `bet_id`, `bets_table`.`user__id` AS `user__id`, `bets_table`.`bet_status` AS `bet_status`, `bets_table`.`bet_amount` AS `bet_amount`, `bets_table`.`possiblewin` AS `possiblewin`, `bets_table`.`total_odds` AS `total_odds`, `betslip_table`.`bet_value` AS `bet_value`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`gamestatus` AS `gamestatus`, `markets_table`.`result` AS `result`,`markets_table`.`total_goals`,`markets_table`.`halftime`,`markets_table`.`gg` FROM ((`bets_table` join `betslip_table` on(`bets_table`.`bet_id` = `betslip_table`.`bet_id`)) join `markets_table` on(`markets_table`.`fixture_id` = `betslip_table`.`fixture_id`)) WHERE bets_table.bet_id = '$betid' AND bets_table.user__id = '$my_id' " ) ;
            

            while ($row = mysqli_fetch_assoc($sql)) {
                $value = $row['bet_value'];
                $bet_value = $value;
                $gamestatus = $row['gamestatus'];
                $result = $row['result'];
                $total_goals = $row['total_goals'];
                $home_team = $row['home_team'];
                $away_team = $row['away_team'];
                $bet_amount = $row['bet_amount'];
                $total_odds = $row['total_odds'];
                $possiblewin = $row['possiblewin'];
                $bet_status = $row['bet_status'];

                if (
                    $gamestatus == "NS" || $gamestatus == "TBD" || $gamestatus == "1H" ||  $gamestatus == "PST" ||  $gamestatus == "CAN" ||  $gamestatus == "HT" ||  $gamestatus == "SUS" ||  $gamestatus == "2H"
                ) {
                    echo '<div class="betslip-pick">
                                <div class="pick-dismiss" style="color:blue;">
                                    <i class="fa fa-minus"></i>
                                    
                                </div>
                                <div class="pick-details">
                                    <span>Your Pick:';
                    if ($value == "1") {
                        echo ($home_team);
                    } elseif ($value == "3") {
                        echo ($away_team);
                    } elseif ($value == "2") {
                        echo ("Draw");
                    }elseif($value=="4"){
                        echo("Home/Draw");
                    }elseif($value=="5"){
                        echo("Home/Away");
                    }elseif($value=="6"){
                        echo("Away/Draw");
                    }elseif($value=="l"){
                        echo("Home Win to nill-Yes");
                    }elseif($value=="m"){
                        echo("Home Win to Nill-No");
                    }elseif($value=="n"){
                        echo("Away Win To Nill-yes");
                    }elseif($value=="o"){
                        echo("Away Win To Nill-No");
                    }elseif($value=="7"){
                        echo("Under 0.5");
                    }elseif($value=="8"){
                        echo("Over 0.5");
                    }elseif($value=="9"){
                        echo("Over 1.5");
                    }elseif($value=="0"){
                        echo("Under 1.5");
                    }elseif($value=="a"){
                        echo("Over 2.5");
                    }elseif($value=="b"){
                        echo("Under 2.5");
                    }elseif($value=="c"){
                        echo("Over 3.5");
                    }elseif($value=="d"){
                        echo("Under 3.5");
                    }elseif($value=="e"){
                        echo("Draw no Bet Home");
                    }elseif($value=="f"){
                        echo("Draw no Bet Away");
                    }elseif($value=="g"){
                        echo("Haltime - Home");
                    }elseif($value=="h"){
                        echo("Haltime - Draw");
                    }elseif($value=="i"){
                        echo("Haltime - Away");
                    }elseif($value=="j"){
                        echo("Both Team To Score");
                    }elseif($value=="k"){
                        echo("Both Teams To Score No");
                    }
                    echo '</span>
                                    <br/>
                                    <span>Status: pending </span>
                                    </br>
                                    <span>' . $home_team . ' vs ' . $away_team . '</span>
                                </div>
                                <div class="pick-odds"> Result: ' . $result . '</div>
                                </div>';
                } else {
                    if ($bet_value == 1 & $result == "home" || $bet_value == 2 & $result == "draw" || $bet_value == 3 & $result == "away" || 
                    $bet_value=="g" && $halftime == "home" || $bet_value=="h" && $halftime == "draw" || $bet_value=="i" && $halftime == "away" || 
                    $bet_value=="j" && $gg == 1 || $bet_value=="k" && $gg == 2 || ($bet_value=="4" && 
($result == "home" || $result=="draw")) || 
                    ($bet_value=="5" && ($result == "home" || $result=="away")) 
                    || ($bet_value=="6" && ($result == "away" || $result=="draw")) || ($bet_value=="l" && ($result=="home" && $gg==1)) || 
                    ($bet_value=="m" && ($result=="home" && $gg==2)) || ($bet_value=="n" && ($result=="away" && $gg==1)) || ($bet_value=="o" && ($result=="away" && $gg==2))
                    ||($bet_value==7 && $total_goals < 1) ||($bet_value==8 && $total_goals > 1) ||($bet_value==9 && $total_goals >1) || 
                    ($bet_value==0 && $total_goals<2) ||($bet_value=="a" && $total_goals>2) ||
                    ($bet_value=="b" && $total_goals<3) ||($bet_value=="c" && $total_goals>3) ||($bet_value=="d" && $total_goals<4) 
                    || ($bet_value == "e" && $result == "home") || ($bet_value == "f" && $result == "away") 
                    || ($bet_value == "e" && $result == "draw") || ($bet_value == "e" && $result == "draw")
                    ) 
                     {
                        echo '<div class="betslip-pick">
                                <div class="pick-dismiss" style="color:green;">
                                    <i class="fa fa-check"></i> 
                                    
                                </div>
                                <div class="pick-details">
                                    <span>Your Pick:';
                        if ($value == "1") {
                            echo ($home_team);
                        } elseif ($value == "3") {
                            echo ($away_team);
                        } elseif ($value == "2") {
                            echo ("Draw");
                        }elseif($value=="4"){
                            echo("Home/Draw");
                        }elseif($value=="5"){
                            echo("Home/Away");
                        }elseif($value=="6"){
                            echo("Away/Draw");
                        }elseif($value=="l"){
                            echo("Home Win to nill-Yes");
                        }elseif($value=="m"){
                            echo("Home Win to Nill-No");
                        }elseif($value=="n"){
                            echo("Away Win To Nill-yes");
                        }elseif($value=="o"){
                            echo("Away Win To Nill-No");
                        }elseif($value=="7"){
                            echo("Under 0.5");
                        }elseif($value=="8"){
                            echo("Over 0.5");
                        }elseif($value=="9"){
                            echo("Over 1.5");
                        }elseif($value=="0"){
                            echo("Under 1.5");
                        }elseif($value=="a"){
                            echo("Over 2.5");
                        }elseif($value=="b"){
                            echo("Under 2.5");
                        }elseif($value=="c"){
                            echo("Over 3.5");
                        }elseif($value=="d"){
                            echo("Under 3.5");
                        }elseif($value=="e"){
                            echo("Draw no Bet Home");
                        }elseif($value=="f"){
                            echo("Draw no Bet Away");
                        }elseif($value=="g"){
                            echo("Haltime - Home");
                        }elseif($value=="h"){
                            echo("Haltime - Draw");
                        }elseif($value=="i"){
                            echo("Haltime - Away");
                        }elseif($value=="j"){
                            echo("Both Team To Score");
                        }elseif($value=="k"){
                            echo("Both Teams To Score No");
                        }
                        echo '</span>
                                    <br/>
                                    <span>Status: Won </span>
                                    </br>
                                    <span>' . $home_team . ' vs ' . $away_team . '</span>
                                </div>
                                <div class="pick-odds"> Result: ' . $result . '</div>
                                </div>';
                    } else {
                        echo '<div class="betslip-pick">
                    <div class="pick-dismiss" style="color:red;">
                        <i class="fa fa-times"></i>
                        
                    </div>
                    <div class="pick-details">
                        <span>Your Pick:';
                        if ($value == "1") {
                            echo ($home_team);
                        } elseif ($value == "3") {
                            echo ($away_team);
                        } elseif ($value == "2") {
                            echo ("Draw");
                        }elseif($value=="4"){
                            echo("Home/Draw");
                        }elseif($value=="5"){
                            echo("Home/Away");
                        }elseif($value=="6"){
                            echo("Away/Draw");
                        }elseif($value=="l"){
                            echo("Home Win to nill-Yes");
                        }elseif($value=="m"){
                            echo("Home Win to Nill-No");
                        }elseif($value=="n"){
                            echo("Away Win To Nill-yes");
                        }elseif($value=="o"){
                            echo("Away Win To Nill-No");
                        }elseif($value=="7"){
                            echo("Under 0.5");
                        }elseif($value=="8"){
                            echo("Over 0.5");
                        }elseif($value=="9"){
                            echo("Over 1.5");
                        }elseif($value=="0"){
                            echo("Under 1.5");
                        }elseif($value=="a"){
                            echo("Over 2.5");
                        }elseif($value=="b"){
                            echo("Under 2.5");
                        }elseif($value=="c"){
                            echo("Over 3.5");
                        }elseif($value=="d"){
                            echo("Under 3.5");
                        }elseif($value=="e"){
                            echo("Draw no Bet Home");
                        }elseif($value=="f"){
                            echo("Draw no Bet Away");
                        }elseif($value=="g"){
                            echo("Haltime - Home");
                        }elseif($value=="h"){
                            echo("Haltime - Draw");
                        }elseif($value=="i"){
                            echo("Haltime - Away");
                        }elseif($value=="j"){
                            echo("Both Team To Score");
                        }elseif($value=="k"){
                            echo("Both Teams To Score No");
                        }
                        echo '</span>
                        <br/>
                        <span>Status: Lost </span>
                        </br>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds"> Result: ' . $result . '</div>
                    </div>';
                    }
                }
            }
            $sql = "SELECT * FROM bets_table WHERE user__id=? and bet_id=? ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();

            echo '</div>
                            <form method="post">
                            <div class="betslip-accumulators">
                            
                                <div class="accumulator-name">Multibet</div>
                                <div class="accumulator-amount"></div>
                            </div>
                            
                            <div class="betslip-details">
                                <div class="betslip-total-stake"><span>Total Stake</span>
                                <span class="betslip-total-stake-value">KSH ' . $bet_amount . '</span>
                            </div>
                            <div class="betslip-total-odds">
                                <span>Total Odds</span>
                                <span class="betslip-total-odds-value" id="odds">' . $total_odds . '</span>
                            </div>
                            <div class="betslip-potential-payout">
                                <span>Potential Payout</span>
                                <span class="betslip-potential-payout-value" id="payout">KSH ' . $possiblewin . '</span>
                            </div>
                            </div>';
            if ($bet_status == "Won") {
                echo '
                            <div class="betslip-submit">
                                <button disabled type="submit" class="betslip-submit-button" style="background-color:green;">' . $bet_status . '</button>
                            </div>
                            
                </div>
                        </form>
                ';
            } elseif ($bet_status == "Lost") {
                echo '
                    <div class="betslip-submit">
                        <button disabled type="submit" class="betslip-submit-button" style="background-color:red;">' . $bet_status . '</button>
                    </div>
                    
        </div>
                </form>
        ';
            } elseif ($bet_status == "pending") {
                echo '
                    <div class="betslip-submit">
                        <button disabled type="submit" class="betslip-submit-button" style="background-color:blue; color:white;">' . $bet_status . '</button>
                    </div>
                    
        </div>
                </form>
        ';
            }
            ?>
            
            <div>
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9098137659435840"
     crossorigin="anonymous"></script>
<!-- betkihorizontal -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9098137659435840"
     data-ad-slot="5844008917"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
            </div>

</body>

</html>