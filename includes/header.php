<?php
$script1 = str_replace('/verif/', '', $_SERVER['PHP_SELF']);
$script2 = str_replace('/', '', $script1);
$filename = __DIR__ . '/theSecurityTimeLimitTokenStorage223.json'; // Path to the rate limit file
$file = json_decode(file_get_contents($filename), true);
if (isset($_COOKIE['visitorId'])) {
    if (isset($file[$_COOKIE['visitorId']])) {
        if (isset($file[$_COOKIE['visitorId']]['banned'])) {
            if (!$file[$_COOKIE['visitorId']]['banned']) {
                if (isset($file[$_COOKIE['visitorId']]['active'])) {
                    include './includes/core.php';
                }
            }
        } elseif (!isset($file[$_COOKIE['visitorId']]['banned'])) {
            if (isset($file[$_COOKIE['visitorId']]['active'])) {
                include './includes/core.php';
            }
        } elseif (!isset($_GET['auth'])) {
            if (isset($_SESSION['authorizedUserToken'])) {
                unset($_SESSION['authorizedUserToken']);
            }

            if (isset($_GET['message'])) {
                $message = $_GET['message'];
            } else {
                $message = 'You have been banned from accessing the Kever Server!';
            }
            if ($script2 != 'fingerprint.php') {
                header('location: ./fingerprint.php?message=' . urlencode($message));
            }
            $_GET['message'] = $message;
            echo $_GET['message'];
        } elseif ($script2 == 'fingerprint.php' && isset($_GET['unban'])) {
            include './includes/core.php';
        }
    } else {
        setcookie('visitorId', '', time() - 3600, '/');
        header('location: ./fingerprint.php');
    }
} elseif ($script2 != 'fingerprint.php' || isset($_GET['auth'])) {
    include './includes/core.php';
}

if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<!--utilities/wizards/create-project.html :59:17-->
<!-- Kejanie.com -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Kejanie.com -->

<head>
    <title>BSN Kever</title>
    <meta charset="utf-8" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="./assets/img-bsn.png" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="./assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="./assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="./assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }
</script>

<?php
if (isset($_SESSION['authorizedUserToken'])) {
    /*
        ?>
            <ul class="nav nav-tabs mt-3">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Search Tunnel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list_data.php">Users Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="parking_data.php">D.Parking Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="s_parking_data.php">S.Parking Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kra_brs.php">3rd Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bill.php">Bills Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bypass.php">Bypass</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bypass_monitor.php">Bypass Monitor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kra_data.php">Revenue Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cpsb.php">CPSB Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mrw.php">Murang'a Women Data</a>
                </li>

            </ul>

            <div class="pull-right mt-2 mb-2">
                <a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-warning btn-large"><i class="icon-print"></i> Print Page Data</button></a>
            </div>
        <?php
        */
}
?>

<script>
    function Clickheretoprint() {
        var btcss = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';
        btcss += '<style> .nav, .btn, .badge, form, .php-error{ display: none; } </style>';
        btcss += '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">';
        var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
        disp_setting += "scrollbars=yes,width=800, height=400, left=100, top=25";
        var content_vlue = document.getElementById("content").innerHTML;

        var docprint = window.open("", "", disp_setting);
        docprint.document.open();
        docprint.document.write(btcss + '</head><body class="mt-5 mx-2" onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');
        docprint.document.write(content_vlue);
        docprint.document.close();
        docprint.focus();
    }
</script>
<div id="content">