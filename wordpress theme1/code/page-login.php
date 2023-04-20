<?php
    /**
    * Template Name: Login Page
    */
?>
<?php get_header();?>

<div class="login-branding">
  <a href="#" class="login-logo"><?php bloginfo( 'charset' );?></a>
  <p class="login-desc">
    <?php bloginfo();?> is a design weblog dedicated to designers and bloggers. We constantly publish useful tricks, tools, tutorials and inspirational artworks.
  </p>
</div>
<div class="login-form">
<?php
$args = array(
    'redirect' => home_url(), 
    'id_username' => 'user',
    'id_password' => 'pass',
   ) 
;?>
<?php wp_login_form( $args ); ?>
</div>

<?php
$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

if ( $login === "failed" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
} elseif ( $login === "empty" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
} elseif ( $login === "false" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
}



function redirect_login_page() {
  $login_page  = home_url( '/login/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);
 
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');

function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);


function logout_page() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . "?login=false" );
  exit;
}
add_action('wp_logout','logout_page');


?>

<?php get_footer();?>
