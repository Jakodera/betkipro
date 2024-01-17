<?php
require('../conn/conn.php');
$_fixture=$_GET['game'];
$games = "";
$games_list = explode(",", $games);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/more.css">
    <title>Betkipro |Jackpot</title>
    <script src="https://kit.fontawesome.com/2dde817c71.js" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="back-icon">
    <a href="../index.php"><i class="fas fa-trophy"></i> 13 Game Jackpot</a>
</div>
       <div class="banner-slider">
         <swiper>
           <div class="s-wrapper swiper swiper-container">
               <div class="slider slider-mob">
                 <div class="slide_viewer">
                  <div class="slide_group">
                   <img class="slide" src="../images/jackpot.jpg" alt="betkipro" />
                   <!--<img class="slide" src="../images/head1.jpg" alt="betkipro" />-->
                  </div>
                </div>
             </div>
          </div>
         </swiper>
       </div>
       
       <div class="bettingbody">

        <div id="bettingbody"></div>
    
        <?php


        // use your default timezone to work correctly with unix timestamps
        // and in line with other parts of your application

        $current_time = time();
        //$sql = "SELECT * from game_odds /* where commence_time > ? and gamestatus= ? ORDER BY commence_time ASC*/";
        $sql = "SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time`
    AS`commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win`,`league_table`.`league_name` AS `league_name`,`league_table`.`country` AS `country`
    FROM (`markets_table` join odds_table  on markets_table.fixture_id = odds_table.fixture_id join league_table on markets_table.league_id = league_table.league_id ) order by commence_time asc ;";
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $stmt->bind_result($fixture_id, $home_team, $away_team, $commence_time, $home_win, $draw, $away_win, $league_name, $country);
        while ($row = $stmt->fetch()) {
            $dateold = strtotime("+180 minutes", $commence_time);
            //$dateold = strtotime(date('Y-m-d'));
                
                
            
            // $date = gmdate("d D, F,Y,g:i a", $dateold);
            $date = gmdate("d/m, G:i", $dateold);
        
            
            
            
            if($home_win>2.50 && $away_win >2.50 && $commence_time>time()){
                echo '
           <div class="teams-info">

        <div class="teams-info-title">
            <div class="teams-info-left">
                <div class="teams-info-left__home-team uppercase">
                ' . $home_team . ' </div>
            <div class="teams-info-left__away-team uppercase">
                ' . $away_team . ' </div>
        </div>
            <div class="teams-info-mid teams-info-title-vs">
                <div class="teams-info-id">
                ' . $date . '</div>
            </div>
        </div>
    </div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="' . $fixture_id . '1" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>Home</span></div>

                <div class="outcome-pricedecimal">' . $home_win . ' </div>
            </div>
        </a>
        <div id="' . $fixture_id . '2" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
            <div class="outcome-title doublechance "><span>Draw</span></div>

            <div class="outcome-pricedecimal ">' . $draw . '</div>
        </div>
        <div id="' . $fixture_id . '3" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
            <div class="outcome-title doublechance "><span>Away</span></div>

            <div class="outcome-pricedecimal">' . $away_win . '</div>
        </div>
    </div>
    <div>

                        ';
            }
                        
                        
        }

        ?>
    </div>
    <script src="../js/more.js"></script>
</body>

</html>