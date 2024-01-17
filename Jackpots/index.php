<?php
// include "html/navigation.php";
session_start();
require("conn/conn.php");
// $games = $_SESSION['betslip'];
$games = "";
$games_list = explode(",", $games);
if (empty($_SESSION['usernumber']) && !empty($_COOKIE['remember'])) {
    list($selector, $authenticator) = explode(":", $_COOKIE['remember']);
    $sql = "SELECT * from auth_tokes where selector= '$selector' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($authi, $selector, $token, $userid, $expires);
    $row = $stmt->fetch();
    $stmt->free_result();
    if (hash_equals($token, hash('sha256', base64_decode($authenticator)))) {
        $_SESSION['usernumber'] = $userid;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="robots" content="noindex">
    <meta name="description" content="Betting website">
    <meta name="keywords" content="Betting,Bet,Beting Bonus,betkipro,betkip, betting site online sports soccer gambling stake win beti">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">

    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/more.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Betkipro |Jackpot</title>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4M2S2XBJ16"></script>

    <!--screen refresh starts-->

    <!--screen refresh ends-->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4M2S2XBJ16');
    </script>
    <script>
        function hideandshow() {
            var avatar = document.getElementById('avatar');
            avatar.classList.toggle('hidden')
        }

        function showmobile() {
            var mobile = document.getElementById('mobile');
            mobile.classList.toggle('hidden')
        }
    </script>

    <style>
        /*body {*/
        /*    font-family: 'Inter', sans-serif;*/
        /*    margin: 0px; */
        /*    padding: 0px;*/
        /*}*/

        .searchre {
            display: none;
            background-color: #222;
            height: 100vh;
        }

        /* Style the search field */
        form.example input[type=text] {
            padding: 10px;
            font-size: 12px;
            border: 1px solid grey;
            float: left;
            width: 80%;
            background: #222;
            color: white;
        }

        /* Style the submit button */
        form.example button {
            float: left;
            width: 20%;
            padding: 10px;
            background: #2196F3;
            color: white;
            font-size: 12px;
            border: 1px solid grey;
            border-left: none;
            /* Prevent double borders */
            cursor: pointer;
        }

        form.example button:hover {
            background: #0b7dda;
        }

        /* Clear floats */
        form.example::after {
            content: "";
            clear: both;
            display: table;
        }

        .navbar {
            /*position: fixed !important;*/
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
        }

        navo ul {
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            background-color: #001833;
        }

        navo li {
            margin: 0 10px;
        }

        navo a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #0062cc;
            transition: color 0.3s ease;
        }

        navo a:hover {
            color: #FFFDD0;
        }

        @media (max-width: 768px) {

            navo {
                margin-top: 10px;
            }

            nav ul {
                flex-direction: column;
            }

            navo li {
                margin: 10px 0;
            }
        }

        * {
            box-sizing: border-box;
        }





        /* Clear floats */
        form.example::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <button onclick="showmobile()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>

                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>

                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>

                        </button>
                    </div>
                    <div class="flex-1 flex items-center justify-center sm:items-strech sm:justify-start">
                        <a href="../index.php">
                            <div class="flex-shrink-0 flex items-center ">
                                <p style="margin-right: 5px;" class="block lg:hidden h-8 w-auto text-3xl font-bold md:text-1xl mr-20" style="font-family: 'Kaushan Script', cursive;">betkipro
                                </p>
                                <p class="hidden lg:block h-8 w-auto text-3xl font-bold font-sans">betkipro</p>
                            </div>

                        </a>
                        <?php
                        if (isset($_SESSION['usernumber'])) {
                            echo '<div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="../html/deposit.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Deposit</a>
                        <a href="../html/mybets.php" class="bg-gray-300 text-white px-3 py-2 rounded-md text-sm font-medium">My bets</a>
                        <a href="../html/withdraw.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Withdraw</a>
                        ';
                            if (isset($_SESSION['usernumber']) == "0758778577") {
                                echo '<a href="html/dashboard.php" class="text-gray-900 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>';
                            }
                            echo '</div>
                </div>';
                        } else {
                            echo '
                    <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                     <!-- <a href="html/mybets.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">My Bets</a>-->
                     <!--<a href="html/login.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">mm</a>-->
                     <!--<a href="html/signup.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">mm</a>-->
                        
                    </div>
                </div>
                ';
                        }

                        ?>

                    </div>

                    <?php
                    if (!isset($_SESSION['usernumber'])) {

                        // $usernumber = $_SESSION['usernumber'];

                        echo '
                       
                    <div class="flex space-x-4">
                     <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                     <!-- <a href="html/mybets.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">My Bets</a>-->
                       <button > <a href="../html/login.php" class="bg-gray-700 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a></button>
                        <button><a href="../html/signup.php" class="bg-gray-500 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a></button>
                        
                    </div>
                    ';}?>

                    <?php
                    if (isset($_SESSION['usernumber'])) {
                        $usernumber = $_SESSION['usernumber'];
                        echo '
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a class="gg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <span class="sr-only">View notifications</span>
                    KSH 
                    ';
                        $sql = "SELECT account_balance from users_table where user__id= '$usernumber' ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $stmt->bind_result($account_balance);
                        $row = $stmt->fetch();
                        $stmt->free_result();
                        echo ($account_balance);
                        echo '
                    
                    </a>
                <div class="ml-3 relative">
                 <div>
                        <button id="avatarimage" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gry-800 focus:ring-white" id="user-menu" aria-haspopup="true" onclick="hideandshow()">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                    </div>
                
                
                    <div class=" hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black rinng-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu" id="avatar" >
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-700" role="menuitem">My profile</a>
                <a href="../html/deposit.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Deposit</a>
                <a href="../php_handlers/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
                </div>
            </div>
        </div>';
                    } ?>
                </div>
            </div>
            <?php
            if (isset($_SESSION['usernumber'])) {
                echo '<div id="mobile" class="hidden sm:hidden">
     <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="../html/deposit.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Deposit</div></a>
        <a href="../html/mybets.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">My bets</div></a>
        <a href="../html/withdraw.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Withdraw</div></a>
      ';
                if (isset($_SESSION['usernumber']) == "0758778577") {
                    echo '<a href="../html/dashboard.php"><div class="text-gray-900 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</div></a>';
                }
                echo '  
    </div>
</div>';
            } else {
                echo '<div id="mobile" class="hidden sm:hidden">
    
</div>';
            }  
            
            ?>

        </nav>
    </div>
    <!--<div class="bettingbody bg-white flex flex-col items-center">-->
    <div id="image-slider">
        <img src="images/head.jpg" alt="Image 1" width="100%">
        <!-- <img src="images/jackpot.jpg" alt="Image 2">
        <img src="images/head1.jpg" alt="Image 3"> -->
    </div>
    <script>
        var images = [
            // "images/head.jpg",
            "images/jackpot.jpg",
            // "images/head1.jpg"
        ];
        var currentIndex = 0;
        var image = document.querySelector("#image-slider img");

        function changeImage() {
            image.src = images[currentIndex];
            currentIndex++;
            if (currentIndex >= images.length) {
                currentIndex = 0;
            }
        }

        setInterval(changeImage, 3000); // Change image every 3 seconds
    </script>

    <navo>
        <ul>
            <li><a href="../index.php" style="font-weight: 980;"><sup><i class="fa fa-futbol-o" style="color: white; font-size: 12px;" aria-hidden="true"></i></sup>Soccer</a></li>
            <!--<li><a href="html/jackpot.php" style="font-weight: 900;"><sup><i class="fa fa-trophy" style="color: gold; font-size: 12px;" aria-hidden="true"></i></sup>Jackpots</a></li>-->
            <li><a href="#" style="font-weight: 900;"><sup><i class="fa fa-trophy" style="color: gold; font-size: 12px;" aria-hidden="true"></i></sup>Jackpots</a></li>
            <li><a href="#" style="font-weight: 900;"><sup><i class="fa fa-play" style="color: green; font-size: 12px;" aria-hidden="true"></i></sup>Casino</a></li>
            <li><a href="#" style="font-weight: 900;"><sup><i class="fa fa-circle" style="color: red; font-size: 10px;" aria-hidden="true"></i></sup>Live</a></li>
        </ul>
    </navo>

    <!-- <form class="example" action="" method="get">
        <input type="text" placeholder="Search.." id="search" name="search" autocomplete="OFF">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form> -->
    <!-- <div class="searchre"></div> -->
    <div class="bettingbody" style="width: 100%; overflow-x: hidden;">
        <div id="bettingbody"></div>
        <form action="" method="get" class="example">
            <input type="text" name="search_term" placeholder="Search for a team">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <?php
        // use your default timezone to work correctly with unix timestamps
        // and in line with other parts of your application

        $current_time = time();
        $search_term = isset($_GET['search_term']) ? $_GET['search_term'] : '';

        $sql = "SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time` AS`commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win`,`league_table`.`league_name` AS `league_name`,`league_table`.`country` AS `country`
    FROM (`markets_table` inner join odds_table  on markets_table.fixture_id = odds_table.fixture_id inner join league_table on markets_table.league_id = league_table.league_id )
    WHERE `home_team` LIKE '%$search_term%' OR `away_team` LIKE '%$search_term%'
    ORDER BY `commence_time` ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($fixture_id, $home_team, $away_team, $commence_time, $home_win, $draw, $away_win, $league_name, $country);
        $counter = 0; 
        while ($row = $stmt->fetch()) {
            $dateold = strtotime("+180 minutes", $commence_time);
            $date = gmdate("d/m, G:i", $dateold);

            // if($commence_time>time()){

        if ((empty($search_term) || stripos($home_team, $search_term) !== false || stripos($away_team, $search_term) !== false) && $home_win>2.50 && $away_win >2.50 && $commence_time <time()) {
                echo '
             <div class="teams-info">
                <div class="teams-info-title">
                    <div class="teams-info-left">
                        <div class="teams-info-left__home-team uppercase">
                        ' . $date . ' </div>
                       
                    </div>
                    
                </div>
            </div>
            <div style="height: 8vh;" class="betdet">
                <a href="#" class="hello">
                    <div id="' . $fixture_id . '1" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                        <div class="outcome-title doublechance "><span>' . $home_team . '</span></div>
                        <div class="outcome-pricedecimal">' . $home_win . ' </div>
                    </div>
                </a>
                <div id="' . $fixture_id . '2" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                    <div class="outcome-title doublechance "><span>Draw</span></div>
                    <div class="outcome-pricedecimal ">' . $draw . '</div>
                </div>
                <div id="' . $fixture_id . '3" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                    <div class="outcome-title doublechance "><span> ' . $away_team . '</span></div>
                    <div class="outcome-pricedecimal">' . $away_win . '</div>
                </div>
            </div>
            ';
             $counter++;
             if ($counter === 13) {
            break;
        }
            }
        }
        // }
        ?>
    </div>



    <footer>
        <div class="row inner">
            <span class="copyright">
                &copy; <div id="year"> </div> betkipro
            </span>

            <span class="meta">
                <?php
                if (isset($_SESSION['usernumber'])) {
                    echo '
                <ul class="links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../html/deposit.php">Deposit</a></li>
                    
                    <li><a href="https://www.gamblinghelponline.org.au/making-a-change/gambling-responsibly">Gamble Responsibly</a></li>
                </ul>
                ';
                } else {
                    echo '
                        <ul class="links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../html/login.php">Login</a></li>
                    <li><a href="../html/signup.php">Signup</a></li>
                    <li><a href="../html/deposit.php">Deposit</a></li>
                    <li><a href="https://www.gamblinghelponline.org.au/making-a-change/gambling-responsibly">Gamble Responsibly</a></li>
                </ul>
                ';
                }
                ?>

                <ul class="icons">

                    <li>
                        <a href="https://wa.me/+254115755902" target="_blank" rel="noopener noreferrer">
                            <span class="fab fa-2x fa-whatsapp"></span></a>
                    </li>
                </ul>

            </span>
        </div>
    </footer>

    <button id="float">
        <?php echo count(array_filter(explode(",", $_SESSION['betslip']))); ?>
    </button>
    <!-- <script src="js/search.js"></script> -->
    <script src="js/addtobet.js"></script>
    <script src="js/more.js"></script>
    <script>
        $("#year").html(new Date().getFullYear());
    </script>
</body>

</html>