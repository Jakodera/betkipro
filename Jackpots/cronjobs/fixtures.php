<?php
require('../conn/conn.php');
// mysqli_query($conn, "DELETE from markets_table ");

$newdate=gmdate("Y-m-d",time());
$yest=gmdate('Y-m-d',strtotime('-4 day',time()));
$dates=[$newdate,$yest,gmdate('Y-m-d',strtotime('+1 day',time()))];
foreach ($dates as $key => $value) {
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
		"X-RapidAPI-Host: api-football-v1.p.rapidapi.com",
		"X-RapidAPI-Key: d7309da350msh4db2d49cab9421cp1dc27fjsn0baba4527c7d"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$resarr=json_decode($response);
curl_close($curl);

$x=0;
while($x<700){
if ($err) {
	echo "cURL Error #:" . $err;
} else {
    try{
    
        $fixture_id=($resarr->api->fixtures[$x]->fixture_id);
        $timestamp=($resarr->api->fixtures[$x]->event_timestamp);
        $status=($resarr->api->fixtures[$x]->statusShort);
        $hometeam=($resarr->api->fixtures[$x]->homeTeam->team_name);
        $awayteam=($resarr->api->fixtures[$x]->awayTeam->team_name);
        $results=($resarr->api->fixtures[$x]->score->fulltime);
        $id=($resarr->api->fixtures[$x]->league_id);
        $half=" ";
        $total=" ";
        $gg=" ";
       $sql=mysqli_query($conn, "INSERT INTO markets_table(fixture_id,home_team,away_team,commence_time,gamestatus,result,total_goals,halftime,gg,league_id) VALUES('$fixture_id','$hometeam','$awayteam','$timestamp','$status','$results','$total','$half','$gg','$id')" );

//echo" one worked";
       echo $conn->error;
}
    catch(Exception $e){
        
        echo "one failed";
    }
    $x++;
}}

}