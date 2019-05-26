<?php echo $header; ?>
<p align="center" style="color:red; font-weight: bold;">User Login Page</p>
<p align="center" id="status" style="color: red; font-weight: bold;"></p>
<form method="post" action="<?php echo base_url('user/signin'); ?>">
	<table border="1" align="center">
		<tr>
			<td>Email Address</td>
			<td>:</td>
			<td>
				<input type="email" name="email" required>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td>
				<input type="password" name="password" required>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<button type="submit" name="btnLogin">Login</button>
			</td>
		</tr>
	</table>
</form>
<div align="center">
	<a href="javascript:void(0);" onclick="fbLogin()" id="fbLink">
		<img src="<?php echo base_url(); ?>images/fblogin.png"/>
	</a>
    <!-- Display Google sign-in button -->
    <!--<a id="gSignIn" href="Javascript:void(0)" onclick="renderButton()">
    </a>-->

    <div id="gSignIn"></div>

</div>

<?php echo $footer; ?>


<script>
window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '<?php echo FBAPPID; ?>', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
    
    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //display user data
            //getFbUserData();
        }
    });
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {

        saveUserdata(response, 'facebook');
    });
}


function saveUserdata(userData, provider)
{
	
	$.ajax({
		type:"post",
		url: '<?php echo base_url("ajax/saveuserresponse"); ?>',
		data: {oauth_provider: provider, userData:JSON.stringify(userData) },
		success:function()
		{
			var targeturl = '<?php echo base_url("user/home"); ?>';
			window.location.href = targeturl;
		}
	});
}

// Logout from facebook
function fbLogout() {
    FB.logout(function() {
        
    });
}



//gmail login
function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}



// Sign-in success callback
function onSuccess(googleUser) {
    // Get the Google profile data (basic)
    //var profile = googleUser.getBasicProfile();
    
    // Retrieve the Google account data
    gapi.client.load('oauth2', 'v2', function () {
        var request = gapi.client.oauth2.userinfo.get({
            'userId': 'me'
        });

        request.execute(function (resp) {
            saveUserdata(resp, 'google');
        });
        
    });
}

// Sign-in failure callback
function onFailure(error) {
    alert(error);
}



</script>