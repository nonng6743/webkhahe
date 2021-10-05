<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SocialAuth</title>

    <style media="screen">
        #fb-btn {
            margin: auto;
            padding: auto;
            background-color: #008CBA;;
            
        }
       

        #profile,
        #logout {
            display: none
        }


    </style>
</head>

<body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '231959892239714',
                cookie: true,
                xfbml: true,
                version: 'v2.8'
            });

            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function statusChangeCallback(response) {
            if (response.status === 'connected') {
                console.log('Logged in and authenticated');
                setElements(true);
                testAPI();
            } else {
                console.log('Not authenticated');
                setElements(false);
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        function testAPI() {
            FB.api('/me?fields=name,email,birthday,location', function(response) {
                if (response && !response.error) {
                    //console.log(response);
                    buildProfile(response);
                }

            })
        }

        function buildProfile(user) {
            let profile = `
          <h3>${user.name}</h3>
          <ul class="list-group">
            <li class="list-group-item">User ID: ${user.id}</li>
            <li class="list-group-item">Email: ${user.email}</li>
            <li class="list-group-item">Birthday: ${user.birthday}</li>
            <li class="list-group-item">User ID: ${user.location.name}</li>
          </ul>
        `;

            document.getElementById('profile').innerHTML = profile;
        }






        function setElements(isLoggedIn) {
            if (isLoggedIn) {
                document.getElementById('logout').style.display = 'block';
                document.getElementById('profile').style.display = 'block';

                document.getElementById('fb-btn').style.display = 'none';
                document.getElementById('heading').style.display = 'none';
            } else {
                document.getElementById('logout').style.display = 'none';
                document.getElementById('profile').style.display = 'none';

                document.getElementById('fb-btn').style.display = 'block';
                document.getElementById('heading').style.display = 'block';
            }
        }

        function logout() {
            FB.logout(function(response) {
                setElements(false);
            });
        }
    </script>

    <div class="container">
        <fb:login-button  id="fb-btn" scope="public_profile,email,user_birthday,user_location,user_posts" onlogin="checkLoginState();">
        </fb:login-button>
        <h3 id="heading">Log in to view your profile</h3>
        <div id="profile"></div>


        <a id="logout" href="#" onclick="logout()">Logout</a>
    </div>
</body>

</html>