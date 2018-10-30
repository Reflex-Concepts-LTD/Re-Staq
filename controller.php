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
} else if (is_menu_set('add_institution') != "") {
    $currentPage = WPATH . "modules/add_institution.php";
    set_title("staqpesa - Add Institution.");
} else if (is_menu_set('about_us') != "") {
    $currentPage = WPATH . "modules/about_us.php";
    set_title("staqpesa - About Us");
} else if (is_menu_set('app_staqpro') != "") {
    $currentPage = WPATH . "modules/app_staqpro.php";
    set_title("staqpesa - StaqPro Package");
} else if (is_menu_set('app_metro') != "") {
    $currentPage = WPATH . "modules/app_metro.php";
    set_title("staqpesa - Metro Package");
} else if (is_menu_set('app_excite') != "") {
    $currentPage = WPATH . "modules/app_excite.php";
    set_title("staqpesa - Excite Package");
} else if (is_menu_set('blog_single') != "") {
    $currentPage = WPATH . "modules/blog_single.php";
    set_title("staqpesa - Blog Single");
} else if (is_menu_set('blog') != "") {
    $currentPage = WPATH . "modules/blog.php";
    set_title("staqpesa - Our Blog");
} else if (is_menu_set('partners') != "") {
    $currentPage = WPATH . "modules/partners.php";
    set_title("staqpesa - Our Partners");
} else if (is_menu_set('contact') != "") {
    $currentPage = WPATH . "modules/contact.php";
    set_title("staqpesa - Contact Us");
} else if (is_menu_set('packages') != "") {
    $currentPage = WPATH . "modules/packages.php";
    set_title("staqpesa - Packages");
} else if (is_menu_set('features') != "") {
    $currentPage = WPATH . "modules/features.php";
    set_title("staqpesa - Features");
} else if (is_menu_set('cross_platform') != "") {
    $currentPage = WPATH . "modules/features/cross_platform.php";
    set_title("staqpesa - Cross Platform");
} else if (is_menu_set('saas') != "") {
    $currentPage = WPATH . "modules/features/saas.php";
    set_title("staqpesa - Software as a Service");
} else if (is_menu_set('bosa_management') != "") {
    $currentPage = WPATH . "modules/features/bosa_management.php";
    set_title("staqpesa - Back-Office Management");
} else if (is_menu_set('fosa_management') != "") {
    $currentPage = WPATH . "modules/features/fosa_management.php";
    set_title("staqpesa - Front-Office Management");
} else if (is_menu_set('scalability') != "") {
    $currentPage = WPATH . "modules/features/scalability.php";
    set_title("staqpesa - Easy Scalability");
} else if (is_menu_set('p_management') != "") {
    $currentPage = WPATH . "modules/features/p_management.php";
    set_title("staqpesa - Users/Personnel Management");
} else if (is_menu_set('secure') != "") {
    $currentPage = WPATH . "modules/features/secure.php";
    set_title("staqpesa - Secure Operations");
} else if (is_menu_set('marketing_tools') != "") {
    $currentPage = WPATH . "modules/features/marketing_tools.php";
    set_title("staqpesa - Integrated Marketing Tools");
} else if (is_menu_set('reporting_analytics') != "") {
    $currentPage = WPATH . "modules/features/reporting_analytics.php";
    set_title("staqpesa - Reporting & Analytics");
} else if (is_menu_set('redundant_backup') != "") {
    $currentPage = WPATH . "modules/features/redundant_backup.php";
    set_title("staqpesa - Redundant Backup");
} else if (is_menu_set('payment_gateway') != "") {
    $currentPage = WPATH . "modules/features/payment_gateway.php";
    set_title("staqpesa - Payment Gateway Integration");
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