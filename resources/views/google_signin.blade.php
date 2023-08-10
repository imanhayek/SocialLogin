<!DOCTYPE html>
<html>

<head>
    <title>Google Sign-In Test</title>
    <!-- Add any necessary CSS and JS dependencies here -->
</head>

<body>
    <div>
        <h1>Google Sign-In Test</h1>
        <p>Click the button below to sign in with Google:</p>
        <button id="google-signin-button">Sign in with Google</button>

        <!-- Add a container to display user information after successful login -->
        <div id="user-info" style="display: none;">
            <h3>Welcome, <span id="user-name"></span>!</h3>
            <p>Email: <span id="user-email"></span></p>
        </div>

        <!-- Add any other UI elements as needed -->
    </div>

    <!-- Include the Google Sign-In API -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <script>
        // Initialize the Google Sign-In API with your client ID
        function onGoogleSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            var userName = profile.getName();
            var userEmail = profile.getEmail();

            // Display user information
            document.getElementById("user-info").style.display = "block";
            document.getElementById("user-name").textContent = userName;
            document.getElementById("user-email").textContent = userEmail;
        }

        function onGoogleSignInFailure(error) {
            console.log("Google Sign-In failed:", error);
        }

        // Attach click event to the Google Sign-In button
        document.getElementById("google-signin-button").addEventListener("click", function() {
           
            gapi.load('auth2', function() {
                gapi.auth2.init({
                    client_id: '487256522501-mq99vrb693f93cpj4o5fsao7jrij144n.apps.googleusercontent.com',
                    client_secret: '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',
                    redirect: 'https://eventbuz.com/login/google/callback'
                });
            });
            // gapi.auth2.getAuthInstance().signIn().then(onGoogleSignIn, onGoogleSignInFailure);
        });
    </script>
</body>

</html>
