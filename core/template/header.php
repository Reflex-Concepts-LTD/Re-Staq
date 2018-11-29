<?php 
$configs = parse_ini_file(WPATH . "core/configs.ini");
//$_SESSION['cPanelUrl'] = $configs["cPanelUrl"];
//$_SESSION['cPuser'] = $configs["cPuser"];
//$_SESSION['cPpass'] = $configs["cPpass"];
//$_SESSION['domain_name'] = $configs["domain_name"];
//$_SESSION['host_name'] = $configs["host_name"];
//$_SESSION['db_name'] = $configs["db_name"];
//$_SESSION['db_user'] = $configs["db_user"];
//$_SESSION['db_password'] = $configs["db_password"];
//$_SESSION['partners_db_password'] = $configs["partners_db_password"];
$_SESSION['api_url'] = $configs["api_url"];
//$_SESSION['displayed_website_link'] = $configs["displayed_website_link"];
//$_SESSION['website_url'] = $configs["website_url"];
$_SESSION['admin_url'] = $configs["admin_url"];
//$_SESSION['application_email'] = $configs["application_email"];
//$_SESSION['application_phone'] = $configs["application_phone"];
//$_SESSION['institution_name'] = $configs["institution_name"];
//$_SESSION['institution_email'] = $configs["institution_email"];
//$_SESSION['institution_phone'] = $configs["institution_phone"];
//
//$_SESSION['mail_host'] = $configs["mail_host"];
//$_SESSION['SMTPAuth'] = $configs["SMTPAuth"];
//$_SESSION['MUsername'] = $configs["MUsername"];
//$_SESSION['MPassword'] = $configs["MPassword"];
//$_SESSION['SMTPSecure'] = $configs["SMTPSecure"];
//$_SESSION['Port'] = $configs["Port"];
//$_SESSION['MUsernameFrom'] = $configs["MUsernameFrom"];
//$_SESSION['AltBody'] = $configs["AltBody"];

?>

<!-- ***** Header Area Start ***** -->
<header class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="?" class="logo">
                        <img src="images/brand/logo-light.svg" width="140" class="light-logo" alt="staqpesa"/>
                        <img src="images/brand/logo-dark.svg" width="140" class="dark-logo" alt="staqpesa"/>
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="?">HOME</a></li>
                        <li><a href="?features">FEATURES</a></li>
                        <li><a href="?packages">PACKAGES</a></li>
                        <!--<li><a href="?partners">PARTNERS</a></li><br />-->
                        <li><a href="?institution_self_registration" class="btn-nav-line">JOIN US</a></li>
                        <li><a href="?login" class="btn-nav-line">LOGIN</a></li>
<!--                        <li><a href="?about_us">ABOUT US</a></li>-->
                        <!--<li><a href="?blog">BLOG</a></li>-->
                        <li><a href="?contact" class="btn-nav-line">CONTACT</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->						
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
