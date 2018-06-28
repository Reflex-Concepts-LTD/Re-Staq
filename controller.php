<?php

require WPATH . "core/include.php";
$currentPage = "";

if (is_menu_set('logout') != "") 
    App::logOut();
else if (is_menu_set('dashboard') != "") {
    $currentPage = WPATH . "modules/home.php";
    set_title("Dashboard");
} else if (is_menu_set('home') != "") {
    $currentPage = WPATH . "modules/home.php";
    set_title("staqpesa - an integrated, transparent, accounting solution for chamaas.");
}else if (is_menu_set('about_us') != "") {
    $currentPage = WPATH . "modules/about_us.php";
    set_title("staqpesa - About Us");
} else if (is_menu_set('app_single') != "") {
    $currentPage = WPATH . "modules/app_single.php";
    set_title("staqpesa - App Single");
} else if (is_menu_set('blog_single') != "") {
    $currentPage = WPATH . "modules/blog_single.php";
    set_title("staqpesa - Blog Single");
} else if (is_menu_set('blog') != "") {
    $currentPage = WPATH . "modules/blog.php";
    set_title("staqpesa - Our Blog");
} else if (is_menu_set('contact') != "") {
    $currentPage = WPATH . "modules/contact.php";
    set_title("staqpesa - Contact Us");
} else if (is_menu_set('our_work') != "") {
    $currentPage = WPATH . "modules/our_work.php";
    set_title("staqpesa - Our Work");
} else if (is_menu_set('services_single') != "") {
    $currentPage = WPATH . "modules/services_single.php";
    set_title("staqpesa - Services Single");
} else if (is_menu_set('services') != "") {
    $currentPage = WPATH . "modules/services.php";
    set_title("staqpesa - Services");
} else if (!empty($_GET)) {
    App::redirectTo("?");
} else {
    $currentPage = WPATH . "modules/home.php";
    if (App::isLoggedIn()) {
        set_title("Home");
    }
}

if (App::isAjaxRequest())
    include $currentPage;
else {
    require WPATH . "core/template/layout.php";
}
?>