<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/signup.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4M2S2XBJ16"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4M2S2XBJ16');
</script>
    <title>Signup</title>
</head>

<body>

    <div class="min-h-screen flex items-center justify-center bg-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <a href="../index.php"><p class="mx-auto h-12 w-auto text-indigo-600 text-center text-7xl" style="font-family: 'Kaushan Script', cursive;">betkipro</p></a>
                <img src="" alt="" class="mx-auto h-12 w-auto">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign Up to get a Bonus</h2>
                <p class="mt-2 text-center text-sm text-gray-600">or
                    <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Already have an account ?

                    </a>
                </p>
            </div>
            <form id="sign" action="" method="POST" class="mt-8 space-y-6">
                <!--<input class="hidden" name="remember" value="true" />-->
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Phone Number</label>
                        <input maxlength="10" type="text" name="email" id="email-address" autocomplete="OFF" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:z-10 sm:text-sm" placeholder="Phone Number">
                    </div>
                    <div class=" py-1">
                        <label for="password" class="sr-only">password</label>
                        <input type="password" id="password" name="password" autocomplete="current-password" required="required" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Repeat Password</label>
                        <input type="password" id="password1" name="password" autocomplete="current-password" required="required" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:z-10 sm:text-sm" placeholder="Repeat Password">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <!--<div class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember_me" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">remember me</label>
                    </div>-->
                    <div class="text-sm"><a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">Aready have an account?</a></div>

                </div>
                
                <div class="text-sm font-medium text-indigo-200 hover:text-indigo-200">Refer and get 10% of their deposits</div>
                <div>
                        <label for="email-address" class="sr-only">Referral Code</label>
                        <input maxlength="10" type="text" name="email" id="email-address" autocomplete="OFF" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:z-10 sm:text-sm" placeholder="Referral code">
                    </div>
                    
                     <div class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember_me" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">By registering an account, you agree to our terms of use. You must be 18 yrs and above in order to register</label>
                    </div>
                <div>
                    <button id="submit" type="submit" name="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span id="lock" class=" absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Sign up
                    </button>
                </div>
            </form>
        </div>
    </div>
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
<script>
    $(document).ready(function() {
        var one = false,
            two = false;
        $("#password").keypress(function() {
            var pass = $(this).val().length;
            if (pass < 5) {
                one = false;
                $(this).addClass("border-red-600", "focus:border-red-600").removeClass('focus:border-indigo-600');
            } else {
                $(this).removeClass("border-red-600", "focus:border-red-600").addClass('focus:border-indigo-600');
                one = true;
            }
        })
        $("#password1").keypress(function() {
            var pass1 = $(this).val().length;
            if (pass1 < 5) {
                one = false;
                $(this).addClass("border-red-600", "focus:border-red-600").removeClass('focus:border-indigo-600');
            } else {
                one = true;
                $(this).removeClass("border-red-600", "focus:border-red-600").addClass('focus:border-indigo-600');
            }
        });
    });
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9098137659435840"
     crossorigin="anonymous"></script>

</html>