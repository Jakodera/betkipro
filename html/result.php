<?php
require ('../conn/conn.php');
$game=$_POST['name'];
// use your default timezone to work correctly with unix timestamps
// and in line with other parts of your application
//echo('<script src="js/addtobet.js"></script>');
$current_time = time();
$sql = "SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time`
AS`commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win`,`league_table`.`league_name`,`league_table`.`country`
FROM (`markets_table` join odds_table  on markets_table.fixture_id = odds_table.fixture_id join league_table on markets_table.league_id = league_table.league_id ) WHERE (`markets_table`.`home_team` like  ?  or markets_table.away_team like ? ) and commence_time > ? and gamestatus=?";

$stmt = $conn->prepare($sql);
$stmt->execute([$game.'%',$game.'%',time(),"NS"]);
while ($row = $stmt->fetch()) {
  
  $dateold = strtotime("+180 minutes", $commence_time);
  $date = gmdate("d/m, G:i", $dateold);
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
                <a id="' . $fixture_id . 'm"; class="more-markets" href="html/markets.php?game=' . $fixture_id . '">+30 Markets</a>
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
                    ';

}
echo('<script src="js/addtobet.js"></script>');
?>