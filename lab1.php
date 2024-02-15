<!--begin::Content-->
<?php
include './includes/header.php';
$obj = '{"fullname":"NAOMI THOGORI NDUMO","firstname":"NAOMI ","activeFlag":null,"birthDistrict":2906,"birthTown":null,"citizen":null,"createdBy":null,"createdDt":null,"dateBirth":"1944-07-01T00:15:00Z","dbirth":null,"dbirth2":null,"fatherBirthDistrict":null,"fatherBirthTown":null,"fatherDateBirth":null,"fatherIdentityId":null,"fatherLastName":"GITHINJI","fatherMiddleName":"GATHUNGU","fathersFirstName":"LEWIL ","fingerPrint":null,"firstName":"NAOMI ","identityId":"1075921","isAlreadyRegistered":false,"isAlreadyRegisteredMig":false,"isValidNID":true,"issueDate":"1996-05-29T00:00:00Z","issuePlace":"OTHAYA ","lastName":"NDUMO","maritalStatus":null,"middleName":"THOGORI","motherBirthDistrict":null,"motherBirthTown":null,"motherDateBirth":null,"motherIdentityId":null,"motherLastName":"GATHUNGU","motherMiddleName":"WANGECI","mothersFirstName":"CECILIA ","natRegId":null,"photo":"","physicalAddress":"457 OTHAYA","pinNoforRegNIDMig":null,"replicationDt":null,"sex":"Female","spouseBirthDistrict":null,"spouseBirthTown":null,"spouseDateBirth":null,"spouseFirstName":null,"spouseIdentityId":null,"spouseLastName":null,"spouseMiddleName":null,"updatedBy":null,"updatedDt":null,"valid":true,"surname":"NDUMO","serial_no":"201277368","other_name":"THOGORI","id_number":"1075921","gender":"F","first_name":"Naomi","family":"","dob":"","citizenship":"Kenyan","year_ob":"1944","login":"A002195426L","user":"Naomi Thogori Ndumo","kra":"A002195426L","kra_pin":"A002195426L","full_name":"Naomi Thogori Ndumo","major_group":"-Agriculture","sub_group":"-Agricultural Labourers","minor_group":"-Crop Farm Labourers","id_no":"1075921","id_issue_date":"29\/05\/1996","id_issue_place":"OTHAYA","nssf_no":"","first_name_2":"Naomi","middle_name_2":"Thogori","last_name_2":"Ndumo","dob_2":"01\/07\/1944","place_of_birth":"2906","sex_2":"Female","marital_status":"","father_id_no":"","father_first_name":"LEWIL","father_middle_name":"GATHUNGU","father_last_name":"GITHINJI","father_place_of_birth":"brthPlace","father_dob":"","mother_id_no":"","mother_first_name":"CECILIA","mother_middle_name":"WANGECI","mother_last_name":"GATHUNGU","mother_place_of_birth":"brthPlace","mother_dob":"","spouse_id_no":"","spouse_first_name":"","spouse_middle_name":"","spouse_last_name":"","spouse_dob":"","spouse_place_of_birth":"brthPlace","lr_no_1":"","building_1":"Gatugi","street_road_1":"Nyeri-Othaya Rd","city_town_1":"Othaya","county_1":"Nyeri","district_1":"Nyeri South District","area_locality_1":"Othaya","descriptive_address_1":"Othaya","postal_code_1":"10106","postal_town":"OTHAYA","po_box_1":"457","address_line_4":"","address_line_5":"","address_line_6":"","telephone_number":"","mobile_number":"0700000000","mobile_number_2":"","mobile_number_3":"","main_email_1":"NAOMITHOGORINDUMO@GMAIL.COM","secondary_email_1":"","nssf_no_1":"","alien_no":"","middle_name":"Thogori","last_name":"Ndumo","origin_country":"","work_permit":"","lr_no":"","building":"","street_road":"","city_town":"","county":"","district":"","tax_area":"","descriptive_address":"","postal_code":"","town":"","po_box":"","first_name_1":"Naomi","middle_name_1":"Thogori","last_name_1":"Ndumo","dob_1":"01\/07\/1944","sex_1":"Female","passport_no":"","passport_issue_country":"","passport_issue_date":"","passport_expiry_date":"","address_line_1":"","address_line_2":"","address_line_3":"","country":"","telephone_no":"","mobile_no_1":"","mobile_no_2":"","mobile_no_3":"","main_email":"","secondary_email":"","sms_notifications":"No","alt_lr_no":"","alt_building":"","alt_street_road":"","alt_city_town":"","alt_county":"","alt_district":"","alt_tax_area":"","alt_descriptive_address":"","alt_postal_code":"","alt_town":"","alt_po_box":"","alt_telephone_no":"","alt_mobile_no":"","alt_email":"","bank_declaration":"No","bank_name":"","bank_branch_name":"","bank_city":"","bank_acc_holder_name":"","bank_acc_no":"","tax_obligation":"Income Tax Resident","tax_reg_date":"22\/11\/1994","itax_rollout_date":"01\/01\/2016","national_transport_and_safety_authority":{"error":"User does not have a Driving Licence!"},"national_health_insurance_fund":{"last_contribution_date":"2024-12","phone":"254727811399","id_number":"1075921","first_name":"NAOMI THOGORI","last_name":"NDUMO ","email":null,"marital_status":"Single","emp_name":"SELF-EMPLOYED","birthdate":"1944-12-31","gender":"Female","facility_name":"OTHAYA SUB-DISTRICT HOSPITAL","choose_facility":true,"opc_facility":"2226854","member_number":"3625920","branch_name":"NYERI BRANCH","rating":true,"rating_message":"How do you Rate Our Services","payment_status":"ACTIVE","payment_desc":"Payment is upto date"},"nairobi_revenue_services":{"error":"user does not exist"}}';
$bsn = json_decode($obj, true);
if (!isset($bsn['fullname'])) {
    $_SESSION['error'] = 'Unknown error! Please try again later';
    header('location: ./indVerify');
} elseif ($bsn['fullname'] == null) {
    $_SESSION['error'] = 'Document number not found!';
    header('location: ./indVerify');
}
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
    <?php 
    if(isset($bsn['serial_no'])){
        $serial_number = $bsn['serial_no'];
    }else{
        $serial_number = 'Serial Number not found!';
    }
    if(isset($bsn['kra'])){
        $kra_pin = $bsn['kra'];
    }elseif(isset($bsn['kra_pin'])){
        $kra_pin = $bsn['kra_pin'];
    }else{
        $kra_pin = 'KRA PIN not found!';
    }

    if(isset($bsn['issueDate'])){
        $issueDate = date("D d-M-Y", strtotime($bsn['issueDate']));
    }else{
        $issueDate = 'Date of Issue unavailable!';
    }

    if(isset($bsn['issuePlace'])){
        $issuePlace = $bsn['issuePlace'];
    }else{
        $issuePlace = 'Place of Issue unavailable!';
    }

    if(isset($bsn['dateBirth'])){
        $dateBirth = date("D d-M-Y", strtotime($bsn['dateBirth']));
    }else{
        $dateBirth = 'Date of Birth unavailable!';
    }

    if(isset($bsn['tax_reg_date'])){
        $tax_reg_date = $bsn['tax_reg_date'];
    }else{
        $tax_reg_date = 'Tax Reg Date unavailable!';
    }

    if(isset($bsn['itax_rollout_date'])){
        $itax_rollout_date = $bsn['itax_rollout_date'];
    }else{
        $itax_rollout_date = 'iTax Rollout Date unavailable!';
    }

    if(isset($bsn['tax_obligation'])){
        $tax_obligation = $bsn['tax_obligation'];
    }else{
        $tax_obligation = 'Tax Obligation unavailable!';
    }

    if(isset($bsn['major_group'])){
        $major_group = $bsn['major_group'];
    }else{
        $major_group = 'Major Group unavailable!';
    }

    if(isset($bsn['sub_group'])){
        $sub_group = $bsn['sub_group'];
    }else{
        $sub_group = 'Sub Group unavailable!';
    }

    if(isset($bsn['minor_group'])){
        $minor_group = $bsn['minor_group'];
    }else{
        $minor_group = 'Minor Group unavailable!';
    }
  include './lab4.php';
  include './lab3.php';
    $objitem = '
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">

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
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">'.$bsn['fullname'].'</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="mb-9">
                                    <!--begin::Badge-->
                                    <div class="badge badge-lg badge-light-primary d-inline">'.$bsn['sex'].'</div>
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

                            <!--begin::Profile content-->
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">National ID</div>
                                    <div class="text-gray-600">'.$bsn['identityId'].'</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">ID Serial Number</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$serial_number.'</a>
                                    </div>
                                    <!--begin::Details item-->


                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">ID Issue Date</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$issueDate.'</a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">ID Place of Issue</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$issuePlace.'</a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Date of Birth</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$dateBirth.'</a>
                                    </div>
                                    <!--begin::Details item-->

                                </div>
                            </div>
                            <!--end::Profile content-->
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
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details2" role="button" aria-expanded="false" aria-controls="kt_user_view_details">KRA Profile
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

                            <!--begin::Profile content-->
                            <div id="kt_user_view_details2" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">KRA PIN</div>
                                    <div class="text-gray-600">'.$kra_pin.'</div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Tax Registration Date</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$tax_reg_date.'</a>
                                    </div>
                                    <!--begin::Details item-->


                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">iTax Rollout Date</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$itax_rollout_date.'</a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Tax Obligation</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$tax_obligation.'</a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Work Group</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">Major: '.$major_group.'</a><br/>
                                        <a class="text-gray-600 text-hover-primary">Sub: '.$sub_group.'</a><br/>
                                        <a class="text-gray-600 text-hover-primary">Minor: '.$minor_group.'</a><br/>
                                    </div>
                                    <!--begin::Details item-->

                                </div>
                            </div>
                            <!--end::Profile content-->
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
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details2" role="button" aria-expanded="false" aria-controls="kt_user_view_details">KRA Profile
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

                            <!--begin::Profile content-->
                            <div id="kt_user_view_details2" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">KRA PIN</div>
                                    <div class="text-gray-600">'.$kra_pin.'</div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Tax Registration Date</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$tax_reg_date.'</a>
                                    </div>
                                    <!--begin::Details item-->


                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">iTax Rollout Date</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$itax_rollout_date.'</a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Tax Obligation</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">'.$tax_obligation.'</a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bolder mt-5">Work Group</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">Major: '.$major_group.'</a><br/>
                                        <a class="text-gray-600 text-hover-primary">Sub: '.$sub_group.'</a><br/>
                                        <a class="text-gray-600 text-hover-primary">Minor: '.$minor_group.'</a><br/>
                                    </div>
                                    <!--begin::Details item-->

                                </div>
                            </div>
                            <!--end::Profile content-->
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
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_expound_data">Expound Data</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_documents">Documents</a>
                        </li>
                        <!--end:::Tab item-->
                       
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                           '.$AIData.'
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_user_view_expound_data" role="tabpanel">
                           '.$expoundData.'
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_user_view_overview_documents" role="tabpanel">
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
                                    <!--begin::Table wrapper-->
                                    
                                    

                                    <!--end::Table wrapper-->
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
            <!--begin::Modals-->

            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
     '; 
     echo $objitem;
     ?>
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