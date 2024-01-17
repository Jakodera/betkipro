jQuery(function($) {
    var all_pass = true;
    $('#submit').click(function(e) {
        e.preventDefault();
        $(this).text('Signing up');
        if (all_pass) {

            var number = $('#email-address').val();
            var pass = $('#password').val();
            var pass2 = $('#password1').val();
            $.ajax({
                url: "../php_handlers/signup_handle.php",
                type: "POST",
                data: {
                    password: pass2,
                    usernumber: number
                },
                success: function(data) {
                    var result = $.trim(data);
                    if (result == "success") {
                        window.location.replace("../index.php");
                    } else if (result == 'regis') {
                        alert("number registered try a different number");
                        $("submit").text('Sign up');
                    } else if (result == "stop") {
                        alert("STOP!!!!!!");
                        $("#submit").text('Sign up');
                    } else if (result == "work") {
                        alert('ana error occured.Please try again');
                        $("#submit").text('Sign up');
                    }

                    console.log(data)
                }
            });
        }
    
    

    });
});

function allFilled($fields) {
    return (
        $fields.filter(function() {
            return this.value === "";
        }).length == 0
    );
}