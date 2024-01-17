<?php
//generate Jackpot Games
require ('../conn/conn.php'); 

$sql="SELECT fixture_id,home_win,draw,away_win from odds_table";
$stmt=$conn->prepare($sql);
$stmt->execute();
$row=$stmt->fetch();
$count=$stmt->rowCount();
$x=0;
while($x<$count){
    echo($over=((1/$home_win)*100)+((1/$draw)*100)+((1/$away_win)*100));
    $over=bcdiv($over, 1, 2);
    $x++;
}


