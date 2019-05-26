<?php echo $header; ?>
<div align="center">
	<div id="gSignIn" style="display: none;"></div>
	<div>You are logged in as: <b><?php echo $fullname; ?></div></b><br/>
	<div>Your email address is: <b><?php echo $email ?></b></div>
	<a onclick="<?php echo ($oauth_provider == 'google') ? 'signOut()' : 'fbLogout()'; ?>" href="<?php echo ($oauth_provider == 'google') ? 'Javascript:void(0)' : base_url('user/logout');  ?>">[Log out]</a>
</div>
<?php echo $footer; ?>

<script type="text/javascript">
function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark'
    });
}
// Sign out the user
function signOut() {
	//alert('From gmail');
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.disconnect();
    auth2.signOut();
    /*auth2.signOut().then(function () {
    });*/

    var targeturl = '<?php echo base_url("user/logout"); ?>';
	window.location.href = targeturl;
}


window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : 'InsertYourFacebookAppId', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
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


// Logout from facebook
function fbLogout() {
    FB.logout(function() {
        var targeturl = '<?php echo base_url("user/logout"); ?>';
		window.location.href = targeturl;
    });
}
</script>
