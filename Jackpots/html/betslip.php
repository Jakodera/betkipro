<?php
session_start();
$games = $_SESSION['betslip'];
$games_list = explode(",", $games);
include('../conn/conn.php');
$total = 1;
//To do
//haltime result
// win to nill
//haltime fulltime
//correct score
//retrive from api

?>
<script>
    $(document).ready(function() {
        $('.remove').click(function(e) {
            e.preventDefault();
            var commarket = $(this).attr('id');
            $.get('../index.php').then(function(html) {

                if (sessionStorage.getItem("names") === null) {
                    var ids = []
                } else {
                    var ids = JSON.parse(sessionStorage.getItem("names"))
                }
                const index2 = ids.indexOf(commarket.substring(0, 6) + "m")
                if (index2 > -1) {
                    ids.splice(index2, 1);
                }
                const index = ids.indexOf(commarket)
                if (index > -1) {
                    ids.splice(index, 1);
                }
                sessionStorage.setItem("names", JSON.stringify(ids))
                //location.href="../index.php";
                //location.reload();
                $("#" + commarket).removeClass('clicked');
            })

            $.ajax({
                url: 'php_handlers/remove.php',
                type: 'POST',
                data: {
                    remove: commarket
                },
                success: function(data) {
                    console.log(data);
                    $("#bettingbody").load('html/betslip.php');
                    $("#float").html(data);
                }
            });
        });
    });
</script>
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
    <div class="betslip-clear" id="close"><span><a href="#" onclick="myname()">Close betslip</a></span></div>
    <div class="betslip-pick-container">
        <?php
        
     if (count(array_filter($games_list))) {
            foreach ($games_list as $key => $marketid) {

                $markenewtid = substr($marketid, 0, -1);

                $sql = "SELECT `markets_table`.`fixture_id`    AS `fixture_id`,
                `markets_table`.`home_team`     AS `home_team`,
                `markets_table`.`away_team`     AS `away_team`,
                `markets_table`.`commence_time` AS `commence_time`,
                `odds_table`.`home_win`         AS `home_win`,
                `odds_table`.`draw`             AS `draw`,
                `odds_table`.`away_win`         AS `away_win`,
                `odds_table`.`onex`             AS `oneX`,
                `odds_table`.`one2`             AS `one2`,
                `odds_table`.`x2`               AS `X2`,
                `odds_table`.`gg`,
                `odds_table`.`ngg`,
                `odds_table`.`dnb1`,
                `odds_table`.`dnb2`,
                `odds_table`.`ov25`,
                `odds_table`.`ov35`,
                `odds_table`.`ov15`,
                `odds_table`.`ov05`,
                `odds_table`.`un05`,
                `odds_table`.`un15`,
                `odds_table`.`un25`,
                `odds_table`.`un35`,
                `odds_table`.`half1`,
                `odds_table`.`half2`,
                `odds_table`.`halfx`,
                `odds_table`.`half1n1`,
                `odds_table`.`half1n2`,
                `odds_table`.`half1nx`,
                `odds_table`.`halfxnx`,
                `odds_table`.`halfxn1`,
                `odds_table`.`halfxn2`,
                `odds_table`.`half2n1`,
                `odds_table`.`half2n2`,
                `odds_table`.`half2nx`,
                `odds_table`.`win2nillhome_yes`,
                `odds_table`.`win2nillhome_no`,
                `odds_table`.`win2nillaway_yes`,
                `odds_table`.`win2nillaway_no`
         FROM   (`markets_table`
                 JOIN `odds_table`
                   ON( `markets_table`.`fixture_id` = `odds_table`.`fixture_id` ))
         WHERE  markets_table.fixture_id ='$markenewtid' ";

                

                $value = substr($marketid, -1);


                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->bind_result(
                    $fixture_id,
                    $home_team,
                    $away_team,
                    $commence_time,
                    $home_win,
                    $draw,
                    $away_win,
                    $onex,
                    $one2,
                    $X2,
                    $gg,
                    $ngg,
                    $dnb1,
                    $dnb2,
                    $ov25,
                    $ov35,
                    $ov15,
                    $ov05,
                    $un05,
                    $un15,
                    $un25,
                    $un35,
                    $half1,
                    $halfX,
                    $half2,
                    $half1n1,
                    $half1nx,
                    $half1n2,
                    $half2n1,
                    $half2nx,
                    $half2n2,
                    $halfxn1,
                    $halfxnx,
                    $halfxn2,
                    $win2nillhome_yes,
                    $win2nillhome_no,
                    $win2nillaway_yes,
                    $win2nillaway_no
                );
                $row = $stmt->fetch();
                if ($value == 1) {
                    echo '<div class="betslip-pick">
                        <div class="pick-dismiss"><a href="#" class="remove" id="' . $marketid . '">
                            <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                            </a>
                        </div>
                        <div class="pick-details">
                            <span>' . $home_team . '</span>
                            <br/>
                            <span>Home Win</span><br/>
                            <span>' . $home_team . ' vs ' . $away_team . '</span>
                        </div>
                        <div class="pick-odds">' . $home_win . '</div>
                        </div>';
                    $total = $total * $home_win;
                } elseif ($value == 2) {
                    echo '<div class="betslip-pick">
                        <div class="pick-dismiss"><a href="#" class="remove" id="' . $marketid . '" >
                            <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                            </a>
                        </div>
                        <div class="pick-details">
                            <span>Draw</span>
                            <br/>
                            <span>Draw</span><br/>
                            <span>' . $home_team . ' vs ' . $away_team . '</span>
                        </div>
                        <div class="pick-odds">' . $draw . '</div>
                        </div>';
                    $total = $total * $draw;
                } elseif ($value == 3) {
                    echo '<div class="betslip-pick">
                        <div class="pick-dismiss">
                        <a href="#" class="remove" id="' . $marketid . '">
                            <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                        </a>
                            </div>
                        <div class="pick-details">
                            <span>' . $away_team . '</span>
                            <br/>
                            <span>Away Win</span><br/>
                            <span>' . $home_team . ' vs ' . $away_team . '</span>
                        </div>
                        <div class="pick-odds">' . $away_win . '</div>
                        </div>';
                    $total = $total * $away_win;
                } elseif ($value == 4) {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Double Chance</span>
                        <br/>
                        <span>1/X</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $oneX . '</div>
                    </div>';
                    $total = $total * $oneX;
                } elseif ($value == 5) {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Double Chance</span>
                        <br/>
                        <span>1/2</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $one2 . '</div>
                    </div>';
                    $total = $total * $one2;
                } elseif ($value == 6) {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Double Chance</span>
                        <br/>
                        <span>X/2</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $X2 . '</div>
                    </div>';
                    $total = $total * $X2;
                } elseif ($value == 7) {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 0.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $un05 . '</div>
                    </div>';
                    $total = $total * $un05;
                } elseif ($value == 8) {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 0.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $ov05 . '</div>
                    </div>';
                    $total = $total * $ov05;
                } elseif ($value == 9) {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 1.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $ov15 . '</div>
                    </div>';
                    $total = $total * $ov15;
                } elseif ($value == 0) {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 1.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $un15 . '</div>
                    </div>';
                    $total = $total * $un15;
                } elseif ($value == "a") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 2.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $ov25 . '</div>
                    </div>';
                    $total = $total * $ov25;
                } elseif ($value == "b") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 2.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $un25 . '</div>
                    </div>';
                    $total = $total * $un25;
                } elseif ($value == "c") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 3.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $ov35 . '</div>
                    </div>';
                    $total = $total * $ov35;
                } elseif ($value == "d") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 3.5</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $un35 . '</div>
                    </div>';
                    $total = $total * $un35;
                } elseif ($value == "e") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Draw no Bet</span>
                        <br/>
                        <span>Home</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $dnb1 . '</div>
                    </div>';
                    $total = $total * $dnb1;
                } elseif ($value == "f") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Draw no Bet</span>
                        <br/>
                        <span>Away</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $dnb2 . '</div>
                    </div>';
                    $total = $total * $dnb2;
                } elseif ($value == "j") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Both Teams To Score</span>
                        <br/>
                        <span>Yes</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $gg . '</div>
                    </div>';
                    $total = $total * $gg;
                } elseif ($value == "k") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Both Teams To Score</span>
                        <br/>
                        <span>No</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $ngg . '</div>
                    </div>';
                    $total = $total * $ngg;
                } //begining haltime of g,h,i
                elseif ($value == "g") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Halftime Result</span>
                        <br/>
                        <span>Home</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half1 . '</div>
                    </div>';
                    $total = $total * $half1;
                } elseif ($value == "h") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime Result</span>
                        <br/>
                        <span>Draw</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $halfX . '</div>
                    </div>';
                    $total = $total * $halfX;
                } elseif ($value == "i") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Halftime Result</span>
                        <br/>
                        <span>Away</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half2 . '</div>
                    </div>';
                    $total = $total * $half2;
                }
                //will to nill l,m,n,o
                elseif ($value == "l") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Home Win To Nill</span>
                        <br/>
                        <span>Yes</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $win2nillhome_yes . '</div>
                    </div>';
                    $total = $total * $win2nillhome_yes;
                } elseif ($value == "m") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Home Win To Nill</span>
                        <br/>
                        <span>No</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $win2nillhome_no . '</div>
                    </div>';
                    $total = $total * $win2nillhome_no;
                } elseif ($value == "n") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Away Win To Nill</span>
                        <br/>
                        <span>Yes</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $win2nillaway_yes . '</div>
                    </div>';
                    $total = $total * $win2nillaway_yes;
                } elseif ($value == "o") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Away Win To Nill</span>
                        <br/>
                        <span>No</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $win2nillaway_no . '</div>
                    </div>';
                    $total = $total * $win2nillaway_no;
                }
                //halftime fulltime results consisting of p,q,r,s,t,u,v,w,x
                elseif ($value == "p") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Home/Home</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half1n1 . '</div>
                    </div>';
                    $total = $total * $half1n1;
                } elseif ($value == "q") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Home/Draw</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half1nx . '</div>
                    </div>';
                    $total = $total * $half1nx;
                } elseif ($value == "r") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Home/Away</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half1n2 . '</div>
                    </div>';
                    $total = $total * $half1n2;
                } elseif ($value == "s") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Away/Home</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half2n1 . '</div>
                    </div>';
                    $total = $total * $half2n1;
                } elseif ($value == "t") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Away/Draw</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half2nx . '</div>
                    </div>';
                    $total = $total * $half2nx;
                } elseif ($value == "u") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Away/Away</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $half2n2 . '</div>
                    </div>';
                    $total = $total * $half2n2;
                } elseif ($value == "v") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Draw/Home</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $halfxn1 . '</div>
                    </div>';
                    $total = $total * $halfxn1;
                } elseif ($value == "w") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Draw/Draw</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $halfxnx . '</div>
                    </div>';
                    $total = $total * $halfxnx;
                } elseif ($value == "x") {
                    echo '<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="' . $marketid . '">
                        <i class="fa fa-minus-circle" style="color: #e81111;"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Haltime/Fultime</span>
                        <br/>
                        <span>Draw/Away</span><br/>
                        <span>' . $home_team . ' vs ' . $away_team . '</span>
                    </div>
                    <div class="pick-odds">' . $halfxn2 . '</div>
                    </div>';
                    $total = $total * $halfxn2;
                }
                $_SESSION['total'] = round($total, 2);
                $stmt->free_result();
            }
            echo '</div>
                    <form action="php_handlers/placebet.php" method="post">
                    <div class="betslip-accumulators">
                    
                        <div class="accumulator-amount"><input id="placebet" name="placebet" autocomplete="off" required/></div>
                    </div>
                   
                    <div class="betslip-details">
                        <div class="betslip-total-stake"><span>Total Stake</span>
                        <span class="betslip-total-stake-value">KSH 49</span>
                    </div>
                    <div class="betslip-total-odds">
                        <span>Total Odds</span>
                        <span class="betslip-total-odds-value" id="odds">JACKPOT</span>
                    </div>
                    <div class="betslip-potential-payout">
                        <span>Potential Payout</span>
                        <span class="betslip-potential-payout-value" id="payout">KSH 20,000</span>
                    </div>
                    </div>
                    <div class="betslip-submit">
                        <button type="submit" class="betslip-submit-button">Place Bet</button>
                    </div> 
                    
        </div>
                </form>
        ';
        }
        ?>