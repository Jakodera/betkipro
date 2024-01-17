<?php
require('../conn/conn.php');
$games = "";
$games_list = explode(",", $games);
$_fixture=$_GET['game'];
$sql=mysqli_query($conn,"SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time` AS 
`commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win`,`odds_table`.`onex` AS `oneX`,`odds_table`.`one2` 
AS `one2` ,`odds_table`.`X2` as `X2`,`odds_table`.`gg`,`odds_table`.`ngg`,`odds_table`.`dnb1`,`odds_table`.`dnb2`,
`odds_table`.`ov25`,`odds_table`.`ov35`,`odds_table`.`ov15`,`odds_table`.`ov05`,`odds_table`.`un05`,`odds_table`.`un15`,`odds_table`.`un25`,`odds_table`.`un35`,`odds_table`.`half1`,`odds_table`.`half2`,`odds_table`.`halfX`,`odds_table`.`half1n1`,`odds_table`.`half1n2`,`odds_table`.`half1nx`,`odds_table`.`halfxnx`,`odds_table`.`halfxn1`,`odds_table`.`halfxn2`,`odds_table`.`half2n1`,`odds_table`.`half2n2`,`odds_table`.`half2nx`,`odds_table`.`win2nillhome_yes`,`odds_table`.`win2nillhome_yes`,`odds_table`.`win2nillhome_no`,`odds_table`.`win2nillaway_yes`,`odds_table`.`win2nillaway_no` FROM (`markets_table`  join `odds_table` on(`markets_table`.`fixture_id` 
= `odds_table`.`fixture_id`)) where markets_table.fixture_id= '$_fixture' order by markets_table.commence_time asc" );

while($row = mysqli_fetch_assoc($sql)){
    $commence_time = $row['commence_time'];
    $home_team = $row['home_team'];
    $away_team = $row['away_team'];
    $home_win = $row['home_win'];
    $draw = $row['draw'];
    $away_win = $row['away_win'];
    $oneX = $row['oneX'];
    $one2 = $row['one2'];
    $X2 = $row['X2'];
    $win2nillhome_yes = $row['win2nillhome_yes'];
    $win2nillaway_no = $row['win2nillaway_no'];
    $win2nillhome_no =$row['win2nillaway_no'];
    $win2nillaway_yes = $row['win2nillaway_yes'];
    $un05 = $row['un05'];
    $ov05 = $row['ov05'];
    $ov15 = $row['ov15'];
    $un15 = $row['un15'];
    $ov25 = $row['ov25'];
    $ov35 = $row['ov35'];
    $dnb1 = $row['dnb1'];
    $dnb2 = $row['dnb2'];
    $half1 = $row['half1'];
    $halfX = $row['halfX'];
    $half2 = $row['half2'];
    $gg = $row['gg'];
    $ngg = $row['ngg'];
    $un35 = $row['un35'];
    $half1n1 = $row['half1n1'];
    $half1nx = $row['half1nx'];
    $half1n2 = $row['half1n2'];
    $half2n1 = $row['half2n1'];
    $half2n2 = $row['half2n2'];
    $half2nx = $row['half2nx'];
    $halfxn1 = $row['halfxn1'];
    $halfxnx = $row['halfxnx'];
    $halfxn2 = $row['halfxn2'];
    $un25 = $row['un25'];


}

$dateold = strtotime("+180 minutes", $commence_time);
$date = gmdate("d/m, G:i", $dateold);

if(date('H:m')> $commence_time){
    header('location:../index.php');
}
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
    <link rel="stylesheet" href="../css/more.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>More</title>
    <script src="https://kit.fontawesome.com/2dde817c71.js" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="back-icon">
    <a href="../index.php"><i class="fas fa-arrow-left"></i> Back</a>
</div>
    <div class="teams-info">

        <div class="teams-info-title">
            <div class="teams-info-left">
                <div class="teams-info-left__home-team uppercase">
                    <?php echo $home_team ?> </div>

            </div>
            <div class="teams-info-mid teams-info-title-vs">
                <div class="teams-info-mid__vs">
                    vs
                </div>
                <div class="teams-info-id">
                    <!--<?php echo($commence_time) ; ?>-->
                    <?php echo  $date  ; ?>
                    </div>
            </div>
            <div class="teams-info-right">
                <div class="teams-info-right__away-team uppercase">
                    <?php echo $away_team?> </div>

            </div>
        </div>
    </div>
    
    <div class="sidebet-header">1X2</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>1" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>Home</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win ?> </div>
            </div>
        </a>
        <div id="<?php echo $_fixture?>2" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
            <div class="outcome-title doublechance "><span>Draw</span></div>

            <div class="outcome-pricedecimal "><?php echo($draw) ?></div>
        </div>
        <div id="<?php echo $_fixture?>3" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
            <div class="outcome-title doublechance "><span>Away</span></div>

            <div class="outcome-pricedecimal"><?php echo $away_win ?></div>
        </div>
    </div>

    <!--double chance section-->
    <div class="sidebet-header">Double chance</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>4" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>1X</span></div>

                <div class="outcome-pricedecimal"><?php echo $oneX ?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>5" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>12</span></div>

                <div class="outcome-pricedecimal"><?php echo $one2?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>6" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>X2</span></div>

                <div class="outcome-pricedecimal"><?php echo $X2 ?></div>
            </div>
        </a>
    </div>
    <!--Win to Nill Home-->
    <div class="sidebet-header">Win to Nill Home</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>l" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>YES</span></div>

                <div class="outcome-pricedecimal"><?php echo($win2nillhome_yes);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>m" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>No</span></div>

                <div class="outcome-pricedecimal"><?php echo($win2nillhome_no); ?> </div>
            </div>
        </a>
    </div>
    <!--Win to Nill away-->
    <div class="sidebet-header">Win to Nill away</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>n" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>YES</span></div>

                <div class="outcome-pricedecimal"><?php echo($win2nillaway_yes);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>o" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>No</span></div>

                <div class="outcome-pricedecimal"><?php echo($win2nillaway_no);?> </div>
            </div>
        </a>
    </div>
    <!--Over and under section-->
    <div class="sidebet-header">Over/under</div>
    <div class="betdet" style="height: 22vh;">
        <a href="#" class="hello" >
            <div id="<?php echo $_fixture?>7" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch"
            >
                <div class="outcome-title doublechance "><span>UN 0.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $un05?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>8" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 0.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $ov05?> </div>
            </div>
        </a>

        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>9" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 1.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $ov15?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>0" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>UN 1.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $un15?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>a" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 2.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $ov25?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>b" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>UN 2.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $un25?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>c" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 3.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $ov35?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>d" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>UN 3.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $un35?></div>
            </div>
        </a>
    </div>

    <!--Draw no bet-->
    <div class="sidebet-header">Draw no bet</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>e" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Home</span></div>

                <div class="outcome-pricedecimal"><?php echo $dnb1?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>f" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Away</span></div>

                <div class="outcome-pricedecimal"><?php echo $dnb2?></div>
            </div>
        </a>
    </div>
    <!--Haltime result-->
    <div class="sidebet-header ">Halftime Result</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>g" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Home</span></div>

                <div class="outcome-pricedecimal"><?php echo($half1);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>h" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Draw</span></div>

                <div class="outcome-pricedecimal"><?php echo($halfX);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>i" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Away</span></div>

                <div class="outcome-pricedecimal"><?php echo($half2);?></div>
            </div>
        </a>
    </div>
    <!--Both team to score-->
    <div class="sidebet-header ">Both team to score</div>
    <div style="height: 8vh; " class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>j" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>YES</span></div>

                <div class="outcome-pricedecimal"><?php echo $gg?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>k" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>No</span></div>

                <div class="outcome-pricedecimal"><?php echo $ngg?></div>
            </div>
        </a>
    </div>
    <!--Halftime Fulltime-->
    <div class="sidebet-header ">Halftime/Fulltime</div>
    <div class="betdet" style="height: 22vh;">
        <a href="#" class="hello" class="betdet">
            <div id="<?php echo ($_fixture)?>p" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1/1</span></div>

                <div class="outcome-pricedecimal"><?php echo($half1n1);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>q" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1/X</span></div>

                <div class="outcome-pricedecimal"><?php echo($half1nx);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>r" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1/2</span></div>

                <div class="outcome-pricedecimal"><?php echo($half1n2);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>s" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2/1</span></div>

                <div class="outcome-pricedecimal"><?php echo($half2n1);?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>t" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2/X</span></div>

                <div class="outcome-pricedecimal"><?php echo($half2nx);?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>u" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2/2</span></div>

                <div class="outcome-pricedecimal"><?php echo($half2n2);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>v" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>X/1</span></div>

                <div class="outcome-pricedecimal"><?php echo($halfxn1);?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>w" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>X/X</span></div>

                <div class="outcome-pricedecimal"><?php echo($halfxnx);?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>x" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>X/2</span></div>

                <div class="outcome-pricedecimal"><?php echo($halfxn2);?> </div>
            </div>
        </a>
    </div>
    <!--Score-->
    
    <div class="sidebet-header">Exact Score</div>
    <div style="height: 50vh; " class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:0</span></div>

                <div class="outcome-pricedecimal"><?php echo $draw +=$un05 ?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:0</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win +=$ov05?> </div>
            </div>
        </a>
         <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:0</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win +=$ov15?></div>
            </div>
        </a>
          <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:0</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win +=$ov25?></div>
            </div>
        </a>
                <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:0</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win +=$ov35?></div>
            </div>
        </a>
                <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:1</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win +=$ov05 ?></div>
            </div>
        </a>
                <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:2</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win +=$ov15?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:3</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win  +=$ov25?></div>
            </div>
        </a>

        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:1</span></div>

                <div class="outcome-pricedecimal"><?php echo $draw  +=$un25?> </div>
            </div>
        </a>
      
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:1</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win  +=$ov25 ?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:2</span></div>

                <div class="outcome-pricedecimal"><?php echo $draw  +=$un05 ?></div>
            </div>
        </a>
      
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:1</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win  +=$ov35 ?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:2</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win  +=$ov35?></div>
            </div>
        </a>
        
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:3</span></div>

                <div class="outcome-pricedecimal"><?php echo $draw  +=$ov35 +=$ov25?></div>
            </div>
        </a>

        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:1</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win  +=$ov35 ?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:2</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win  +=$ov35 ?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:3</span></div>

                <div class="outcome-pricedecimal"><?php echo $home_win +=$ov35?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:4</span></div>

                <div class="outcome-pricedecimal"><?php echo $draw  +=$un05 ?> </div>
            </div>
        </a>
        

        
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:2</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win  +=$ov25?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:3</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win  +=$ov35 ?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:3</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win +=$ov35 ?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:4</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win +=$ov35?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:4</span></div>

                <div class="outcome-pricedecimal"><?php echo $away_win +=$ov35 ?></div>
            </div>
        </a>

    </div>
    <button id="float">
        <?php echo count(array_filter(explode(",", $_SESSION['betslip']))); ?>
    </button>
    <script src="../js/more.js"></script>
    <script src="../js/addtobet.js"></script>
</body>

</html>