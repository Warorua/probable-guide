<?php include './includes/header.php' ?>
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <?php include './includes/menu_stjhsfyj.php' ?>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header tablet and mobile-->
                <div class="header-mobile py-3">
                    <!--begin::Container-->
                    <div class="container d-flex flex-stack">
                        <!--begin::Mobile logo-->
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="./home">
                                <img alt="Logo" src="./assets/img-bsn.png" class="h-35px" />
                            </a>
                        </div>
                        <!--end::Mobile logo-->
                        <!--begin::Aside toggle-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-2x me-n1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Aside toggle-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header tablet and mobile-->
                <!--begin::Header-->
                <div id="kt_header" class="header py-6 py-lg-0" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{lg: '300px'}">
                    <!--begin::Container-->
                    <div class="header-container container-xxl">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 py-3 py-lg-0 me-3">
                            <!--begin::Heading-->
                            <h1 class="d-flex flex-column text-dark fw-bolder my-1">
                                <span class="text-white fs-1">Individual Verification</span>
                            </h1>
                            <!--end::Heading-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-line fw-bold fs-7 my-1">
                                <li class="breadcrumb-item text-gray-600">
                                    <a href="./home" class="text-gray-600">Home</a>
                                </li>
                                <li class="breadcrumb-item text-gray-400">Individual Verification</li>
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title=-->
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center flex-wrap">
                            <!--begin::Action-->
                            <div class="d-flex align-items-center py-3 py-lg-0">
                                <!--begin::Item-->
                                <div class="me-3">
                                    <a href="#" class="btn btn-icon btn-custom btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                        <span class="svg-icon svg-icon-1 svg-icon-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor" />
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="./assets/media/avatars/300-1.jpg" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">Max Smith
                                                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                                    </div>
                                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="./account/overview.html" class="menu-link px-5">My Profile</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="./apps/projects/list.html" class="menu-link px-5">
                                                <span class="menu-text">My Projects</span>
                                                <span class="menu-badge">
                                                    <span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                                                </span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <a href="#" class="menu-link px-5">
                                                <span class="menu-title">My Subscription</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/referrals.html" class="menu-link px-5">Referrals</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/billing.html" class="menu-link px-5">Billing</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/statements.html" class="menu-link px-5">Payments</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/statements.html" class="menu-link d-flex flex-stack px-5">Statements
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="View your statements"></i></a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3">
                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                            <span class="form-check-label text-muted fs-7">Notifications</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="./account/statements.html" class="menu-link px-5">My Statements</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <a href="#" class="menu-link px-5">
                                                <span class="menu-title position-relative">Language
                                                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                                        <img class="w-15px h-15px rounded-1 ms-2" src="./assets/media/flags/united-states.svg" alt="" /></span></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/settings.html" class="menu-link d-flex px-5 active">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1" src="./assets/media/flags/united-states.svg" alt="" />
                                                        </span>English</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/settings.html" class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1" src="./assets/media/flags/spain.svg" alt="" />
                                                        </span>Spanish</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/settings.html" class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1" src="./assets/media/flags/germany.svg" alt="" />
                                                        </span>German</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/settings.html" class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1" src="./assets/media/flags/japan.svg" alt="" />
                                                        </span>Japanese</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="./account/settings.html" class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1" src="./assets/media/flags/france.svg" alt="" />
                                                        </span>French</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5 my-1">
                                            <a href="./account/settings.html" class="menu-link px-5">Account Settings</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="./authentication/flows/basic/sign-in.html" class="menu-link px-5">Sign Out</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <div class="menu-content px-5">
                                                <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                                                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="./dark/home" />
                                                    <span class="pulse-ring ms-n1"></span>
                                                    <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::User account menu-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Theme mode-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Menu toggle-->
                                    <a href="#" class="btn btn-icon btn-custom btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                        <i class="fonticon-sun fs-2"></i>
                                        <i class="fonticon-moon fs-2 d-none"></i>
                                    </a>
                                    <!--begin::Menu toggle-->
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-primary fw-bold py-4 fs-6 w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-1">
                                            <a href="create-project.html" class="menu-link px-3 active">
                                                <span class="menu-icon">
                                                    <i class="fonticon-sun fs-2"></i>
                                                </span>
                                                <span class="menu-title">Light</span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-1">
                                            <a href="./dark/utilities/wizards/create-project.html" class="menu-link px-3">
                                                <span class="menu-icon">
                                                    <i class="fonticon-moon fs-2"></i>
                                                </span>
                                                <span class="menu-title">Dark</span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Theme mode-->
                                <!--begin::Item-->
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-3x">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M20.335 15.537C21.725 14.425 21.57 12.812 21.553 11.224C21.4407 9.50899 20.742 7.88483 19.574 6.624C18.5503 5.40102 17.2668 4.4216 15.817 3.757C14.4297 3.26981 12.9703 3.01966 11.5 3.01701C8.79576 2.83108 6.11997 3.66483 4 5.35398C2.289 6.72498 1.23101 9.12497 2.68601 11.089C3.22897 11.6881 3.93029 12.1214 4.709 12.339C5.44803 12.6142 6.24681 12.6888 7.024 12.555C6.88513 12.9965 6.85078 13.4644 6.92367 13.9215C6.99656 14.3786 7.17469 14.8125 7.444 15.189C7.73891 15.5299 8.10631 15.8006 8.51931 15.9812C8.93232 16.1619 9.38047 16.2478 9.831 16.233C10.0739 16.2296 10.3141 16.1807 10.539 16.089C10.7371 15.9871 10.9288 15.8732 11.113 15.748C12.1594 15.2831 13.3275 15.1668 14.445 15.416C15.7795 15.7213 17.1299 15.952 18.49 16.107C18.7927 16.1438 19.0993 16.1313 19.398 16.07C19.7445 15.9606 20.0639 15.7789 20.335 15.537Z" fill="currentColor" />
                                            <path d="M19.008 16.114C18.9486 16.6061 18.7934 17.0817 18.551 17.514C18.229 18.114 17.581 18.314 17.103 18.752C16.457 19.343 16.595 20.38 16.632 21.164C16.6522 21.3437 16.621 21.5254 16.542 21.688C16.4335 21.835 16.2751 21.9373 16.0965 21.9758C15.9179 22.0143 15.7314 21.9863 15.572 21.897C15.2577 21.7083 15.0072 21.4296 14.853 21.097C14.581 20.607 14.362 20.085 14.053 19.612C13.3182 18.7548 12.4201 18.0525 11.411 17.546C10.9334 17.1942 10.5857 16.6942 10.422 16.124C10.459 16.111 10.499 16.106 10.536 16.09C10.7336 15.9879 10.925 15.8741 11.109 15.749C12.1554 15.2842 13.3234 15.1678 14.441 15.417C15.7754 15.7223 17.1259 15.953 18.486 16.108C18.6598 16.1191 18.834 16.1211 19.008 16.114ZM18.8 10.278V3C18.8 2.73478 18.6946 2.48044 18.5071 2.29291C18.3196 2.10537 18.0652 2 17.8 2C17.5348 2 17.2804 2.10537 17.0929 2.29291C16.9053 2.48044 16.8 2.73478 16.8 3V10.278C16.4187 10.4981 16.1207 10.8379 15.9522 11.2447C15.7838 11.6514 15.7542 12.1024 15.8681 12.5277C15.9821 12.953 16.2332 13.3287 16.5825 13.5967C16.9318 13.8648 17.3597 14.0101 17.8 14.0101C18.2403 14.0101 18.6682 13.8648 19.0175 13.5967C19.3668 13.3287 19.6179 12.953 19.7318 12.5277C19.8458 12.1024 19.8162 11.6514 19.6477 11.2447C19.4793 10.8379 19.1813 10.4981 18.8 10.278ZM13.8 2C13.5348 2 13.2804 2.10537 13.0929 2.29291C12.9053 2.48044 12.8 2.73478 12.8 3V8.586L12.312 9.07397C11.8792 8.95363 11.4188 8.98003 11.0026 9.14899C10.5864 9.31794 10.2379 9.61994 10.0115 10.0079C9.78508 10.3958 9.69351 10.8478 9.75109 11.2933C9.80867 11.7387 10.0122 12.1526 10.3298 12.4702C10.6474 12.7878 11.0612 12.9913 11.5067 13.0489C11.9522 13.1065 12.4042 13.0149 12.7921 12.7885C13.18 12.5621 13.4821 12.2136 13.651 11.7974C13.82 11.3812 13.8463 10.9207 13.726 10.488L14.507 9.70697C14.6945 9.51948 14.7999 9.26519 14.8 9V3C14.8 2.73478 14.6946 2.48044 14.5071 2.29291C14.3196 2.10537 14.0652 2 13.8 2ZM9.79999 2C9.53478 2 9.28042 2.10537 9.09289 2.29291C8.90535 2.48044 8.79999 2.73478 8.79999 3V4.586L7.31199 6.07397C6.87924 5.95363 6.41882 5.98004 6.00263 6.14899C5.58644 6.31794 5.23792 6.61994 5.0115 7.00787C4.78508 7.39581 4.69351 7.84781 4.75109 8.29327C4.80867 8.73874 5.01216 9.1526 5.32977 9.47021C5.64739 9.78783 6.06124 9.99131 6.50671 10.0489C6.95218 10.1065 7.40417 10.0149 7.7921 9.78851C8.18004 9.56209 8.48207 9.21355 8.65102 8.79736C8.81997 8.38117 8.84634 7.92073 8.726 7.48798L10.507 5.70697C10.6945 5.51948 10.7999 5.26519 10.8 5V3C10.8 2.73478 10.6946 2.48044 10.5071 2.29291C10.3196 2.10537 10.0652 2 9.79999 2Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Item-->
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                    <div class="header-offset"></div>
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Container-->
                    <div class="container-xxl" id="kt_content_container">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Individual Verification</h3>
                                <div class="card-toolbar">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                        <span class="svg-icon svg-icon-3x">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M10.613 16.163L7.837 13.387C7.65313 13.203 7.54983 12.9536 7.54983 12.6935C7.54983 12.4334 7.65313 12.184 7.837 12L14.775 5.06201C14.9589 4.87814 15.2084 4.7749 15.4685 4.7749C15.7286 4.7749 15.978 4.87814 16.162 5.06201L18.938 7.83801C19.1219 8.02197 19.2252 8.2714 19.2252 8.53149C19.2252 8.79159 19.1219 9.04102 18.938 9.22498L12 16.163C11.816 16.3468 11.5666 16.4502 11.3065 16.4502C11.0464 16.4502 10.797 16.3468 10.613 16.163ZM4.71301 17.203L2.48498 20.322C2.3675 20.4863 2.31218 20.687 2.32879 20.8883C2.3454 21.0896 2.43288 21.2784 2.57571 21.4213C2.71853 21.5641 2.90743 21.6516 3.10873 21.6682C3.31003 21.6848 3.51067 21.6294 3.67498 21.512L6.794 19.2841L4.71301 17.203Z" fill="currentColor" />
                                                <path opacity="0.3" d="M7.83701 12L2.28699 6.44995C2.10306 6.26582 1.99976 6.01624 1.99976 5.75598C1.99976 5.49572 2.10306 5.24614 2.28699 5.06201L5.06201 2.28699C5.24614 2.10306 5.49575 1.99976 5.75601 1.99976C6.01627 1.99976 6.26588 2.10306 6.45001 2.28699L12 7.83704L7.83701 12ZM18.937 21.713L21.712 18.938C21.8959 18.7539 21.9992 18.5043 21.9992 18.244C21.9992 17.9838 21.8959 17.7342 21.712 17.55L16.162 12L12 16.163L17.55 21.713C17.7341 21.8969 17.9837 22.0002 18.244 22.0002C18.5042 22.0002 18.7539 21.8969 18.938 21.713H18.937ZM9.146 21.634C9.25064 21.7386 9.37833 21.8172 9.51883 21.8636C9.65933 21.9101 9.80874 21.923 9.95511 21.9014C10.1015 21.8797 10.2407 21.824 10.3618 21.7389C10.4828 21.6537 10.5822 21.5415 10.652 21.411C11.0778 20.2848 11.1695 19.0596 10.9161 17.8826C10.6628 16.7055 10.0752 15.6265 9.22385 14.7751C8.37248 13.9238 7.29352 13.3362 6.11646 13.0829C4.93939 12.8296 3.71424 12.9213 2.58801 13.347C2.45756 13.4169 2.34528 13.5162 2.26013 13.6372C2.17499 13.7582 2.11933 13.8976 2.09766 14.0439C2.07598 14.1903 2.08889 14.3397 2.13531 14.4802C2.18174 14.6207 2.26038 14.7484 2.36499 14.853L9.146 21.634ZM19.181 6.83398C19.3013 6.79376 19.4094 6.72347 19.495 6.62976C19.5806 6.53605 19.6408 6.42209 19.6699 6.29858C19.6991 6.17508 19.6962 6.04615 19.6615 5.92407C19.6269 5.802 19.5616 5.69074 19.472 5.60095L18.401 4.53003C18.3112 4.44036 18.2 4.37509 18.0779 4.34045C17.9559 4.30582 17.827 4.30288 17.7035 4.33203C17.58 4.36118 17.4659 4.42139 17.3722 4.50696C17.2785 4.59252 17.2082 4.7007 17.168 4.82104L16.855 5.75903L18.243 7.14697L19.181 6.83398Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                            </div>
                            <!--begin::Card body-->
                            <div class="card-body">
                                <form>
                                    <div class="w-100">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Heading-->
                                            <div class="mb-3">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold">
                                                    <span class="required">Individual Type</span>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="This option must be provided to facilitate verification!"></i>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Description-->
                                                <div class="fs-7 fw-bold text-muted">Select the individual type</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Radio group-->
                                            <div class="btn-group w-100 w-lg-50" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                                <!--begin::Radio-->
                                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active" data-kt-button="true">
                                                    <!--begin::Input-->
                                                    <input class="btn-check" type="radio" checked="checked" name="method" value="1" />
                                                    <!--end::Input-->
                                                    Citizen
                                                </label>
                                                <!--end::Radio-->

                                                <!--begin::Radio-->
                                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                                    <!--begin::Input-->
                                                    <input class="btn-check" type="radio" name="method" value="2" />
                                                    <!--end::Input-->
                                                    Resident
                                                </label>
                                                <!--end::Radio-->

                                                <!--begin::Radio-->
                                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                                    <!--begin::Input-->
                                                    <input class="btn-check" type="radio" name="method" value="3" />
                                                    <!--end::Input-->
                                                    Foreigner
                                                </label>
                                                <!--end::Radio-->
                                            </div>
                                            <!--end::Radio group-->
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Document Type</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Varies with individual type"></i>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Option-->
                                            <input type="radio" class="btn-check" name="doc_type" value="id_no" checked="checked" id="kt_doc_type_option_1" />
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_doc_type_option_1">
                                                <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                                                <span class="svg-icon svg-icon-4x me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21ZM16 11V9C16 6.8 14.2 5 12 5C9.8 5 8 6.8 8 9V11C7.2 11 6.5 11.7 6.5 12.5C6.5 13.3 7.2 14 8 14V15C8 17.2 9.8 19 12 19C14.2 19 16 17.2 16 15V14C16.8 14 17.5 13.3 17.5 12.5C17.5 11.7 16.8 11 16 11ZM13.4 15C13.7 15 14 15.3 13.9 15.6C13.6 16.4 12.9 17 12 17C11.1 17 10.4 16.5 10.1 15.7C10 15.4 10.2 15 10.6 15H13.4Z" fill="currentColor" />
                                                        <path d="M9.2 12.9C9.1 12.8 9.10001 12.7 9.10001 12.6C9.00001 12.2 9.3 11.7 9.7 11.6C10.1 11.5 10.6 11.8 10.7 12.2C10.7 12.3 10.7 12.4 10.7 12.5L9.2 12.9ZM14.8 12.9C14.9 12.8 14.9 12.7 14.9 12.6C15 12.2 14.7 11.7 14.3 11.6C13.9 11.5 13.4 11.8 13.3 12.2C13.3 12.3 13.3 12.4 13.3 12.5L14.8 12.9ZM16 7.29998C16.3 6.99998 16.5 6.69998 16.7 6.29998C16.3 6.29998 15.8 6.30001 15.4 6.20001C15 6.10001 14.7 5.90001 14.4 5.70001C13.8 5.20001 13 5.00002 12.2 4.90002C9.9 4.80002 8.10001 6.79997 8.10001 9.09997V11.4C8.90001 10.7 9.40001 9.8 9.60001 9C11 9.1 13.4 8.69998 14.5 8.29998C14.7 9.39998 15.3 10.5 16.1 11.4V9C16.1 8.5 16 8 15.8 7.5C15.8 7.5 15.9 7.39998 16 7.29998Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->

                                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-3">ID Number</span>
                                                    <span class="text-muted fw-bold fs-6">
                                                        This is the National Identification Number given by the Registrar of persons.
                                                    </span>
                                                </span>
                                            </label>
                                            <!--end::Option-->

                                            <!--begin::Option-->
                                            <input type="radio" class="btn-check" name="doc_type" value="kra" id="kt_doc_type_option_2" />
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center" for="kt_doc_type_option_2">
                                                <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                                                <span class="svg-icon svg-icon-4x me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->

                                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-3">KRA PIN</span>
                                                    <span class="text-muted fw-bold fs-6">The Personal Identification Number(PIN) provided by the Kenya Revenue Authority(KRA).</span>
                                                </span>
                                            </label>
                                            <!--end::Option-->

                                            <!--begin::Option-->
                                            <input type="radio" class="btn-check" name="doc_type" value="passport" id="kt_doc_type_option_3" disabled />
                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center" for="kt_doc_type_option_3">
                                                <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                                                <span class="svg-icon svg-icon-4x me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->

                                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-3">Passport</span>
                                                    <span class="text-muted fw-bold fs-6">This is the Kenyan passport number.</span>
                                                </span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Heading-->
                                            <div class="mb-3">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-bold">
                                                    <span class="required">Document Number</span>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="This option must be provided to facilitate verification!"></i>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Description-->
                                                <div class="fs-7 fw-bold text-muted">This is the default number being verified!</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Block-->
                                            <div class="py-5">
                                                <div class="rounded border p-10">
                                                    <!--begin::Input wrapper-->
                                                    <div class="w-lg-50 position-relative">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" placeholder="Document №" name="card_cvv" />
                                                        <!--end::Input-->
                                                        <!--begin::CVV icon-->
                                                        <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                                            <span class="svg-icon svg-icon-2hx">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor" />
                                                                    <path d="M12.0006 11.1542C13.1434 11.1542 14.0777 10.22 14.0777 9.0771C14.0777 7.93424 13.1434 7 12.0006 7C10.8577 7 9.92348 7.93424 9.92348 9.0771C9.92348 10.22 10.8577 11.1542 12.0006 11.1542Z" fill="currentColor" />
                                                                    <path d="M15.5652 13.814C15.5108 13.6779 15.4382 13.551 15.3566 13.4331C14.9393 12.8163 14.2954 12.4081 13.5697 12.3083C13.479 12.2993 13.3793 12.3174 13.3067 12.3718C12.9257 12.653 12.4722 12.7981 12.0006 12.7981C11.5289 12.7981 11.0754 12.653 10.6944 12.3718C10.6219 12.3174 10.5221 12.2902 10.4314 12.3083C9.70578 12.4081 9.05272 12.8163 8.64456 13.4331C8.56293 13.551 8.49036 13.687 8.43595 13.814C8.40875 13.8684 8.41781 13.9319 8.44502 13.9864C8.51759 14.1133 8.60828 14.2403 8.68991 14.3492C8.81689 14.5215 8.95295 14.6757 9.10715 14.8208C9.23413 14.9478 9.37925 15.0657 9.52439 15.1836C10.2409 15.7188 11.1026 15.9999 11.9915 15.9999C12.8804 15.9999 13.7421 15.7188 14.4586 15.1836C14.6038 15.0748 14.7489 14.9478 14.8759 14.8208C15.021 14.6757 15.1661 14.5215 15.2931 14.3492C15.3838 14.2312 15.4655 14.1133 15.538 13.9864C15.5833 13.9319 15.5924 13.8684 15.5652 13.814Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::CVV icon-->
                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                            </div>
                                            <!--end::Block-->
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-xxl d-flex flex-column flex-md-row flex-stack">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-gray-400 fw-bold me-1">Created by</span>
                            <a href="https://keenthemes.com/" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">Keenthemes</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a href="https://keenthemes.com/" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://devs.keenthemes.com/" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    <!--end::Main-->
    <!--begin::Engage drawers-->

    <!--end::Engage drawers-->
    <!--begin::Engage toolbar-->
    <div class="engage-toolbar d-flex position-fixed px-5 fw-bolder zindex-2 top-50 end-0 transform-90 mt-20 gap-2">
        <!--begin::Demos drawer toggle-->
        <button id="kt_engage_demos_toggle" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0" title="Check out 22 more demos" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click" data-bs-trigger="hover">
            <span id="kt_engage_demos_label">Demos</span>
        </button>
        <!--end::Demos drawer toggle-->
        <!--begin::Help drawer toggle-->
        <button id="kt_help_toggle" class="engage-help-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm px-5 rounded-top-0" title="Learn &amp; Get Inspired" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click" data-bs-trigger="hover">Help</button>
        <!--end::Help drawer toggle-->
        <!--begin::Purchase link-->
        <a href="https://1.envato.market/EA4JP" target="_blank" class="engage-purchase-link btn btn-color-gray-700 bg-body btn-active-color-gray-900' btn-flex h-35px px-5 shadow-sm rounded-top-0">Buy now</a>
        <!--end::Purchase link-->
    </div>
    <!--end::Engage toolbar-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->
    <!--begin::Modals-->

    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "./assets/home";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="./assets/plugins/global/plugins.bundle.js"></script>
    <script src="./assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="./assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="./assets/js/widgets.bundle.js"></script>
    <script src="./assets/js/custom/widgets.js"></script>
    <script src="./assets/js/custom/apps/chat/chat.js"></script>
    <script src="./assets/js/custom/intro.js"></script>
    <script src="./assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/type.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/budget.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/settings.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/team.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/targets.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/files.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/complete.js"></script>
    <script src="./assets/js/custom/utilities/modals/create-project/main.js"></script>
    <script src="./assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
<?php include './includes/alert.php' ?>
<!--utilities/wizards/create-project.html :59:18-->

</html>