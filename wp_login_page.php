<?php
function bcloud_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(/wp-content/uploads/2020/12/cropped-IG-logo.png);
		height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'bcloud_login_logo' );

function bcloud_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'bcloud_login_logo_url' );

function bcloud_login_logo_url_title() {
    return 'Incredible Gifts';
}
add_filter( 'login_headertext', 'bcloud_login_logo_url_title' );
