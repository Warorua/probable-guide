<!--begin::Content-->
<?php
include './includes/header.php';
?>
<!--begin::Wrapper-->
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header tablet and mobile-->
    <div class="header-mobile py-3">
        <!--begin::Container-->
        <div class="container d-flex flex-stack">
            <!--begin::Mobile logo-->
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <a href="./index.html">
                    <img alt="Logo" src="./assets/media/logos/logo-demo9.svg" class="h-35px" />
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
    <?php include './includes/topbar_asgklamd.php' ?>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row" id="kt_block_ui_2_target">

                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Summary-->
                            <!--begin::User Info-->
                            <div class="d-flex flex-center flex-column py-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <img src="./assets/media/avatars/300-6.jpg" alt="image" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 btn btn-primary fw-bolder mb-3 disabled placeholder col-4" aria-hidden="true"></a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="mb-9">
                                    <!--begin::Badge-->
                                    <span class="badge badge-lg badge-light-primary placeholder col-6"></span>
                                    <!--begin::Badge-->
                                </div>
                                <!--end::Position-->
                                <!--begin::Info-->
                            </div>
                            <!--end::User Info-->
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Registry of Persons Profile
                                    <span class="ms-2 rotate-180">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>

                            </div>
                            <!--end::Details toggle-->
                            <div class="separator"></div>
                            <!--begin::Details content-->
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <p class="bg-secondary rounded border border-transparent h-600px w-100" aria-hidden="true">
                                        <span class="placeholder"></span>
                                    </p>
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details2" role="button" aria-expanded="false" aria-controls="kt_user_view_details2">KRA Profile
                                    <span class="ms-2 rotate-180">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>

                            </div>
                            <!--end::Details toggle-->
                            <div class="separator"></div>
                            <!--begin::Details content-->
                            <div id="kt_user_view_details2" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <p class="bg-secondary rounded border border-transparent h-600px w-100" aria-hidden="true">
                                        <span class="placeholder"></span>
                                    </p>
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->


                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">

                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Overview</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Expound Data</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_events_and_logs_tab">Documents</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">

                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header mt-6">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2 class="mb-1">MSISDN Subscriber Verification Kit</h2>
                                        <div class="fs-6 fw-bold text-muted">Safaricom subscribers only!</div>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <form method="POST" id="msisdnVerif">
                                        <div class="rounded border border-transparent mt-12" aria-hidden="true">
                                            <!--begin::Input wrapper-->
                                            <div class="w-lg-50 position-relative">
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" minlength="9" maxlength="12" placeholder="Phone Number" name="phone_number" autocomplete="off" required />
                                                <!--end::Input-->

                                                <!--begin::CVV icon-->
                                                <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                                    <span class="svg-icon svg-icon-2hx">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor" />
                                                            <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor" />
                                                            <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::CVV icon-->
                                            </div>
                                            <hr />
                                            <button class="btn btn-primary" type="submit">Verify</button>
                                            <!--end::Input wrapper-->
                                        </div>
                                    </form>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <div id="phoneVerify"></div>
                            <div id="phoneVerifyStatus"></div>
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Common data Profile</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <p class="bg-secondary rounded border border-transparent h-1000px w-100 mt-12" aria-hidden="true">
                                        <span class="placeholder"></span>
                                    </p>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Availabe User Documents</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <p class="bg-secondary rounded border border-transparent h-1000px w-100 mt-12" aria-hidden="true">
                                        <span class="placeholder"></span>
                                    </p>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
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
<?php include './includes/scripts_aselkawer89.php' ?>
<script>
    $(document).on('submit', '#msisdnVerif', function(e) {
        e.preventDefault();

        // Check if the form is valid
        if (!this.checkValidity()) {
            // If the form is not valid, trigger the browser's default validation UI
            $('<input type="submit">').hide().appendTo($(this)).click().remove();
            return; // Stop the function here
        }

        var formData = new FormData(this);

        $.ajax({
            method: "POST",
            url: "phoneVerif",
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            enctype: 'multipart/form-data',
            dataType: 'json',
            success: function(data) {
                $('#phoneVerify').html(JSON.stringify(data));
                console.log(data);
                if ('queryId' in data) {
                    // Function to make the AJAX request
                    function makeRequest() {
                        $.ajax({
                            method: "POST",
                            url: "statusListener",
                            data: {
                                queryId: data.queryId
                            },
                            //processData: false, // tell jQuery not to process the data
                            //contentType: false, // tell jQuery not to set contentType
                            //enctype: 'multipart/form-data',
                            dataType: 'json', // Expecting JSON response
                            success: function(data) {
                                if (data.status !== 'waiting') {
                                    // If the response status is not 'waiting', clear the interval
                                    clearInterval(requestInterval);
                                    if (data.status == 'error') {
                                        $('#phoneVerifyStatus').html(JSON.stringify(data.error));
                                    }
                                    if (data.status == 'success') {
                                        $('#phoneVerifyStatus').html(JSON.stringify(data));
                                    }
                                } else {
                                    $('#phoneVerifyStatus').html('Awaiting verification...');
                                }
                            },
                            error: function(xhr, status, error) {
                                // Optionally handle AJAX request errors
                                clearInterval(requestInterval); // Stop on error to avoid continuous failed requests
                                console.error("Error: " + error);
                            }
                        });
                    }

                    // Set an interval to call makeRequest every half a second
                    var requestInterval = setInterval(makeRequest, 500);

                }

            }
        });
    });
</script>