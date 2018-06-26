<html>
    <head>
        <meta name="google-signin-client_id" content="713116378232-k6d3kkgf7575s2oh5gf2teqp95t6b6s0.apps.googleusercontent.com">
        <script src="platform.js"></script>
        <script src="jquery.min.js"></script>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </head>
    <body>
        <h1>WELCOME <?= $_GET['name'] ?></h1>  
        <a href="#" onclick="signOut();">Signout</a>
        <div class="g-signin2" style="visibility: hidden"></div>
        <script>function signOut() {
<?php if ($_GET['id'] == 'google') { ?>
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                    });
    <?php
}
if ($_GET['id'] == 'facebook') {
    ?>
                    FB.getLoginStatus(function (response) {
                        if (response.status === 'connected') {
                            FB.logout();
                        }
                    });
<?php } ?>
<?php if ($_GET['id'] == 'linkedin') { ?>
                    function onLoad() {
                        try {
                            IN.User.logout();
                        } catch (err) {
                            console.log(err);
                        }
                    }
<?php } ?>
                location = "lab.php";
            }
        </script>

    </body>
</html>
