<?php


/*LOGIN STUFFS
function redirect_login_page() {
    $login_page  = home_url( '/login/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);
 
    if( ($page_viewed == "wp-login.php" || $page_viewed == "admin") && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');

function admin_bar_logout_redirect(){
  wp_redirect(home_url());
  exit();
}
add_action('wp_logout','admin_bar_logout_redirect');
#END LOGIN*/