<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--
Client ID
    713116378232-k6d3kkgf7575s2oh5gf2teqp95t6b6s0.apps.googleusercontent.com
Client Secret
    KlU4jYdayLB1GN2yQ8atVX6b 
-->
<html>
    <head>
        <meta name="google-signin-client_id" content="713116378232-k6d3kkgf7575s2oh5gf2teqp95t6b6s0.apps.googleusercontent.com">
        <script src="jquery.min.js"></script>
        <!--google-->
        <script src="https://apis.google.com/js/platform.js" async defer>
        </script>
        <!--linkedin-->
        <script type="text/javascript" src="//platform.linkedin.com/in.js">
            api_key:   77opzf1465tlxu
            onLoad:    onLinkedInLoad
        </script>
        <!--facebook-->
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '197482467670368',
                    cookie: true,
                    xfbml: true,
                    version: 'v2.11'
                });
                FB.AppEvents.logPageView();
            };
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
        <title>Social App</title>
    </head>
    <body>
        <br>
        <!--facebook-->
    <fb:login-button 
        scope="public_profile,email"
        onlogin="checkLoginState();">
    </fb:login-button>
    <br/><br/>
    <script>
        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    //console.log(response.authResponse.accessToken);

                    FB.api('/me?fields=email,id,name,picture', function (response) {
                        //console.log(JSON.stringify(response.picture.data.url));
                        //console.log(JSON.stringify(response.id));
                        var name = response.name;
                        var id = response.id;
                        var email = response.email;
                        var image = response.picture.data.url;
                        var data = {'name': name, 'email': email, 'image': image};
                        $.post("insert.php", //jquery = "$"
                                {
                                    query: data //query=>input
                                },
                                function (data) { //func of success
                                    if (!data)
                                    {
                                        return;
                                    }
                                    var list = JSON.stringify(data);
                                    var tr = JSON.parse(list);
                                });
                                location="welcome.php?id=facebook&name="+name;
                    });
                }
            });
        }
    </script>
    <!--google-->
    <div class="g-signin2" data-onsuccess="onSignIn"></div><br>
    <script>
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            //console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            //console.log('Name: ' + profile.getName());
            //console.log('Image URL: ' + profile.getImageUrl());
            //console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
            var name = profile.getName();
            var id = profile.getId();
            var email = profile.getEmail();
            var image = profile.getImageUrl();
            var data = {'name': name, 'email': email, 'image': image};
            $.post("insert.php", //jquery = "$"
                    {
                        query: data //query=>input
                    },
                    function (data) { //func of success
                        if (!data)
                        {
                            return;
                        }
                        var list = JSON.stringify(data);
                        var tr = JSON.parse(list);
                    });
                     location="welcome.php?id=google&name="+name;
        }
    </script>
    <!--linked in -->
    <script type="in/Login"></script>
    <script type="text/javascript">
        // Setup an event listener to make an API call once auth is complete
        function onLinkedInLoad() {
            IN.Event.on(IN, "auth", getProfileData);
        }
        // Handle the successful return from the API call
        function onSuccess(data) {
            console.log(data);
            //console.log(data.values[0].id);
            //console.log(data.values[0].firstName+" "+data.values[0].lastName);
            //console.log(data.values[0].emailAddress);
            //console.log(data.values[0].pictureUrl);
            var name = data.values[0].firstName + " " + data.values[0].lastName;
            var id = data.values[0].id;
            var email = data.values[0].emailAddress;
            var image = data.values[0].pictureUrl;
            var data = {'name': name, 'email': email, 'image': image};
            $.post("insert.php", //jquery = "$"
                    {
                        query: data //query=>input
                    },
                    function (data) { //func of success
                        if (!data)
                        {
                            return;
                        }
                        var list = JSON.stringify(data);
                        var tr = JSON.parse(list);
                    });
                    location="welcome.php?id=linkedin&name="+name;
        }
        // Handle an error response from the API call
        function onError(error) {
            console.log(error);
        }
        // Use the API call wrapper to request the member's basic profile data
        function getProfileData() {
            //IN.API.Raw("/people/~").result(onSuccess).error(onError);
            IN.API.Profile("me").fields("id", "first-name", "last-name", "headline", "location", "picture-url", "public-profile-url", "email-address").result(onSuccess).error(onError);
        }
    </script>
</script>
</body>
</html>