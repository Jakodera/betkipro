<?php
require '../conn/conn.php';

$newdate=gmdate("Y-m-d",time());
$yest=gmdate('Y-m-d',strtotime('+1 day',time()));
$dates=[$newdate,$yest,gmdate('Y-m-d',strtotime('-4 day',time()))];
foreach ($dates as $key => $value) {
    # code...

$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/fixtures/date/".$value."?timezone=Africa%2FNairobi",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: api-football-v1.p.rapidapi.com",
		"X-RapidAPI-Key: d7309da350msh4db2d49cab9421cp1dc27fjsn0baba4527c7d" 
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$resarr=json_decode($response);
curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    
    $x=0;
    while($x<700){
        try{
    $fixture_id=($resarr->api->fixtures[$x]->fixture_id);
    $timestamp=($resarr->api->fixtures[$x]->event_timestamp);
    $status=($resarr->api->fixtures[$x]->statusShort);
    $hometeam=($resarr->api->fixtures[$x]->goalsHomeTeam);
    $awayteam=($resarr->api->fixtures[$x]->goalsAwayTeam);
    $half1=($resarr->api->fixtures[$x]->score->halftime);
    $id=($resarr->api->fixtures[$x]->league_id);
    $result;
    $gg;
    $asnw;
    $half;
 if($status=="FT"){
    if($hometeam>$awayteam){
        $result="home";
    }elseif($awayteam>$hometeam){
        $result="away";
    }elseif($hometeam==$awayteam){
        $result="draw";
    }
    if($hometeam>0 && $awayteam>0){
        $gg=1;
    }else{
        $gg=2;
    }
    if((int)substr($half1,0)>(int)substr($half1,2)){
        $half="home";
    }elseif ((int)substr($half1,0)<(int)substr($half1,2)) {
        $half="away";
    }elseif ((int)substr($half1,0)==(int)substr($half1,2)) {
        $half="draw";
    }

    $asnw=$hometeam+$awayteam;


    mysqli_query($conn, "UPDATE markets_table set result='$result',gamestatus='$status',total_goals='$asnw',gg='$gg',halftime='$half',league_id= '$id' where fixture_id='$fixture_id' " );
    

echo"Wallet threshold Ksh. 10,000 <br/>";
     
 }
else{
    mysqli_query($conn, "UPDATE markets_table set gamestatus='$status',league_id= '$id' where fixture_id='$fixture_id' ");
    
}}
catch(Exception $e){
    
    echo "one failed";
}
    
    //$stmt->debugDumpParams();
    $x++;
    
    }
}
}
