<?php
ob_start();
ini_set('display_errors', '0');
error_reporting(E_ALL);

require './vendor/autoload.php';

use simplehtmldom\HtmlDocument;

//include './includes/core.php';
// Example usage
//logCustomError("This is a custom error message.");


include './includes/core2.php';
logCustomError(json_encode($_POST));

//*
$postType = $_POST['type'];
$postDocType = $_POST['doc_type'];
$postDocNumber = $_POST['doc_number'];

if($postType == 1){
    if($postDocType == "id_no"){
        $idno =  $postDocNumber;
    }elseif($postDocType == "kra"){
        $pinOwner = json_decode(pinOwnerKRA($postDocNumber), true);
        $idno =  $pinOwner['txprIndDtlsDTO']['nidNo'];
    }else{

    }
}
//*/
//$idno = '4838593';
//$idno = '29441907';
$type = 'd';
//$idno = $_POST['idno'];
//$type = $_POST['type'];

$object = '';
$bsn = [];

if ($idno != '') {
    if (!isset($fname)) {
        // $dt1 = httpPost('https://nairobiservices.go.ke/api/authentication/auth/individual/kra/detail', ['id_number' => $idno]);
        $dt1 = idNumberSearch($idno);
        $obj = json_decode($dt1, true);
    } else {
        $obj = [];
    }


    if (is_array($obj)) {

        if (isset($obj['error'])) {
            if ($obj["error"] == "Kindly try again later" || $obj["error"] == "null") {
                $object .= 'Could not process ID at the moment. Error: ' . $obj['error'];
                $bsn['error'] = 'Could not process ID at the moment. Error: ' . $obj['error'];
            } elseif ($obj["error"] == 'Record with id number ' . $idno . ' not found') {
                $object .= '<br/><b style="color:red;padding:20px;background-color:black;border:none;border-radius:5px">ID Number not found</b>';
                $bsn['error'] = 'ID Number not found';
           
            } else {
                $object .= '<br/><b style="color:red;padding:20px;background-color:black;border:none;border-radius:5px">' . $obj['error'] . '</b>';
                $bsn['error'] = $obj['error'] ;
           
            }
        } else {
            if (!isset($obj['identityId'])) {
                if (!isset($fname)) {
                    //$object .= $obj['data']['name'];
                    $object_1 = [];
                    if (isset($obj['name'])) {
                        $obj['name'] = $obj['name'];
                        $object_1['fullname'] = $fullname = $fullname = $obj['name'];

                        $object_1['firstname'] = $firstname = substr($fullname, 0, strpos($fullname, " "));
                        $object .= $firstname;
                    } else {
                        $obj['name'] = null;
                        $object_1['fullname'] = $fullname = $fullname = $obj['name'];
                        $object_1['firstname'] = $firstname =  $obj['name'];
                        $object .= $firstname;
                    }
                   
                } else {
                    $object_1['firstname'] = $firstname = $fname;
                    $object .= $firstname;
                }
            } else {
                $object_1 = [];
                $object_1['fullname'] = $fullname = $fullname = $obj['firstName'] . ' ' . $obj['middleName'] . ' ' . $obj['lastName'];

                $object_1['firstname'] = $firstname = $obj['firstName'];
                $object .= $firstname;

                foreach ($obj as $id => $key) {
                    $object_1[$id] = $key;
                }
            }

            $obj22 = idSearchPesaflow($idno, $firstname);
            //echo $obj22;

            $obj_2 = json_decode($obj22, true);


            if (isset($obj_2['customer_data'])) {
                foreach ($obj_2['customer_data'] as $id => $key) {
                    $object_1[$id] = $key;
                }
            }



            $fields = [
                //'_csrf_token' => authCookie(),

                'first_name' => $firstname,
                'id_number' => $idno,
                'id_type' => $type,

                // 'first_name'=>'jackson',
                //  'id_number'=>682640,
                //'id_type'=>'resident',
            ];

            $url = 'https://accounts.ecitizen.go.ke/lookup';

            //httpPost($url, $fields);
            //$dt2 = citizen_a($url, $fields);
            //$obj_2 = json_decode($dt2, true);

            if ($type == 'resident') {
                if (isset($obj_2['errors'])) {
                    foreach ($obj_2['errors'] as $id => $rsed) {
                        $object_1[$id . '_ERROR'] = $rsed;
                    }
                } else {
                    foreach ($obj_2 as $id => $rsed) {
                        $object_1[$id] = $rsed;
                    }
                }
            } else {
                if(isset($object_1['dob'])){
                    $dob = $object_1['dob'];
                }else{
                    $dob = '1970';
                }
                
                $object_1['year_ob'] = date("Y", strtotime($dob));
                if (isset($obj_2['serial_no'])) {
                    $object_1['serial_no'] = $obj_2['serial_no'];
                }

                /*
                //OLD PIN Fetching
                $gt1 = json_decode(httpPost('https://nairobiservices.go.ke/api/authentication/auth/user_info', ['id_number' => $idno]), true);
                if (isset($gt1['data']['pin_no'])) {
                    $brs_pin = $gt1['data']['pin_no'];
                } else {
                    //$dt3 = ctGet($idno, $firstname);
                    //$obj_3 = json_decode($dt3, TRUE);



                    //$brs_pin = 'A013405880X';
                    /////
                    $ddt1 = KraNrsFetch($idno);
                    if ($ddt1['status'] && $ddt1['kra'] != 'null') {
                        $brs_pin = $ddt1['kra'];
                    } else {
                        $obj_3 = innerFetch($idno);
                        /////
                        if (isset($obj_3['profile']['kra_pin'])) {
                            $brs_pin = $obj_3['profile']['kra_pin'];
                        } elseif (isset($obj_3['result']['data']['pin'])) {
                            $brs_pin = $obj_3['result']['data']['pin'];
                        } else {
                            $object_1['kra'] = 'KRA Not retrieved. Result:';
                            if (isset($gt1['data'])) {
                                foreach ($gt1['data'] as $gtid => $gt1r) {
                                    $object_1[$gtid] = $gt1r;
                                }
                            }
                        }
                    }
                }
                //*/

                /*
                $gt1 = json_decode(httpGet('https://nairobiservices.go.ke/api/iprs/user/kra/id/'.$idno,[]), true);
                if(is_array($gt1)){
                    if(isset($gt1['error'])){
                        $object_1['kra'] = 'KRA Not retrieved. Result: '.$gt1['error'];
                    }elseif(isset($gt1['type'])){
                        foreach ($gt1 as $gtid => $gt1r) {
                            $object_1[$gtid] = $gt1r;
                        }
                        if(isset($gt1['pin_no'])){
                            $brs_pin = $gt1['pin_no'];
                        }elseif(isset($gt1['tax_payer_id'])){
                            $fri = getPin($gt1['tax_payer_id']);
                            $brs_pin = $fri[$gt1['tax_payer_id']];
                            //echo json_encode(getPin($gt1['tax_payer_id']));
                        }else{
                            $object_1['kra'] = 'KRA PIN Not available for Identity Provided!';
                        }
                        
                    }else{
                        $object_1['kra'] = 'KRA Fetching error. Result: '.json_encode($gt1);
                    }
                }else{
                    $object_1['kra'] = 'KRA Fetching error. Result: '.json_encode($gt1);
                }
                //*/

                //*
                function extractPIN($sentence) {
                    // Define the pattern to match the sentence format
                    $pattern = '/^User\s([A-Z0-9]+)\sis\salready\sregistered\.$/';
                
                    // Perform the regular expression match
                    if (preg_match($pattern, $sentence, $matches)) {
                        // If a match is found, return the dynamic word
                        return $matches[1];
                    } else {
                        // If no match is found, return false
                        return false;
                    }
                }
                $data = [
                    "pin"=> $idno,
                    "token"=> "20e92a436d4bf28e8c08565df22ae2d6dd3d495709a43d0ce52e9ab2847d995b",
                    "ishara"=> "016086dc439441d36c739223bf356e676e8ff109a9ca885e915719fe4561af61",
                    "version"=> "3.0",
                    "lugha"=> "0"
                ];
                $data = json_encode($data);
                //echo $data;
                $gt1 = json_decode(httpPost('https://api.kra.go.ke/m-service/user/verify',$data, ['Content-Type: application/json']), true);
                if (is_array($gt1)) {
                    if (isset($gt1[0]['login'])) {
                        foreach ($gt1[0] as $gtid => $gt1r) {
                            $object_1[$gtid] = $gt1r;
                        }
                        $brs_pin = $gt1[0]['login'];
                    } elseif(isset($gt1['M-Service'])) {
                        //$object_1['kra'] = 'KRA PIN Not available for Identity Provided!';
                        $pin_extract = extractPIN($gt1['M-Service']);
                        if ($pin_extract !== false) {
                            $brs_pin = $pin_extract;
                        } else {
                            $object_1['kra'] = 'KRA Fetching error. Result: ' . $gt1['M-Service'];
                        }
                        $object_1['kra'] = 'KRA Fetching error. Result: ' . $gt1['M-Service'];
                    }else {
                        //$object_1['kra'] = 'KRA PIN Not available for Identity Provided!';
                        $object_1['kra'] = 'KRA Fetching error. Result: ' . json_encode($gt1);
                    }
                } else {
                    $object_1['kra'] = 'KRA Fetching error. Result: ' . json_encode($gt1);
                }
                //*/


                if (isset($brs_pin)) {
                    $doc_active = TRUE;
                    $kra = $object_1['kra'] = $brs_pin;
                    if ($kra != '' && strlen($kra) > 4) {
                        $url = 'https://itax.kra.go.ke/KRA-Portal/eTreAmendment.htm?actionCode=loadViewProfile&taxPayerPin=' . $kra;

                        $fields = array(
                            'applicantType' => 'taxpayer',
                            'cmbTaxpayerType' => 'INDI',
                            'fieldsToSkip' => 'representativeName,taxPayerName',
                            'representativeName' => '',
                            'representativePin' => '',
                            //'taxPayerName' => $fullname,
                            'taxPayerPin' => $kra,
                            'viewProfileFlag' => 'Y',
                        );


                        $dt3 = httpPost($url, $fields);
                        //   $data = $dt3;
                        $object_101 = scrape_2($dt3);
                        if (is_array($object_101)) {
                            foreach ($object_101 as $id => $object_102) {
                                $object_1[$id] = $object_102;
                            }
                        }
                        //$object_1 = $dt3;
                        //$object .= 'KRA = ' . $dt2['profile']['kra_pin'] . '<br/>';
                    }
                }
                /*
                $dt4 = httpPost('https://verify.iebc.or.ke/index.php/webapi/submit_voter', array('idno' => $idno, 'yob' => $object_1['year_ob']));
                $obj_4 = scrape($dt4);
                //$obj_4 = 'NotFound';

                if ($obj_4 == 'NotFound') {
                    $object .= " <b style='color:red'>DID NOT VOTE</b> <br>";
                } else {
                    $object .= " <b style='color:green'>VOTED</b> <br>";
                    foreach ($obj_4 as $id => $row) {
                        $object_1[$id]  = $row;
                    }
                }
                //*/
            }
            foreach($object_1 as $id=>$row){
                $bsn[$id]=$row;
            }
            //echo json_encode($bsn).'<br/><br/>';


            if ($type != 'resident') {
                $dt5 = httpPost('https://nairobiservices.go.ke/api/authentication/auth/user_info', ['id_number' => $idno]);
                $obj_5 = json_decode($dt5, true);
                if (isset($obj_5['data'])) {
                    foreach ($obj_5['data'] as $id => $obj5) {
                        $object_1[$id . '_B'] = $obj5;
                    }
                    if (isset($obj_5['data']['RESULT'])) {
                        foreach ($obj_5['data']['RESULT'] as $id => $obj5) {
                            $object_1[$id . '_B'] = $obj5;
                        }
                    }
                }

                /*
                if (isset($object_1['serial_no'])) {
                    if ($object_1['serial_no'] != '') {
                        $dt6 = httpGet('https://tims.ntsa.go.ke/rbac/user/getIsIDRegistered.htm?idNo=' . $object_1['serial_no'], ['id_number' => $object_1['serial_no']]);
                        $obj_6 = json_decode($dt6, true);
                        if (isset($obj_6['userInfo'])) {
                            foreach ($obj_6['userInfo'] as $id => $obj6) {
                                if ($id != 'DATE_OF_ISSUE') {
                                    $object_1[$id . '_C'] = $obj6;
                                } else {
                                    $object_1['ID_DATE_OF_ISSUE'] = date('d-M-Y h:i:s', $obj6['time'] / 1000);
                                }
                            }
                        }
                    }
                }
                //*/

                if (!isset($brs_pin)) {
                    $year = date("Y", strtotime($dob));
                    $month = date("m", strtotime($dob));
                    $day = date("d", strtotime($dob));

                    $obj2 = kra($idno, $day, $month, $year);

                    if (is_array($obj2)) {
                        //  $f_names = preg_replace('/\s*/m', '', $obj2['firstName']);
                        foreach ($obj2 as $id => $row) {
                            if ($row != null) {
                                $pattern = '/\s*/m';
                                $replace = '';
                                //$row = preg_replace($pattern, $replace, $row);
                            }


                            if ($id == 'isAlreadyRegistered' && $row == 1) {
                                $object_1['KRA_STATUS'] = "<b style='color:green'>" . $firstname . " HAS A KRA PIN</b>";
                            } elseif ($id == 'isAlreadyRegistered' && $row != 1) {
                                $object_1['KRA_STATUS'] = "<b style='color:red'>" . $firstname . " HAS NO KRA PIN</b>";
                            }
                            if ($id == 'issuePlace') {
                                $object_1['ID_ISSUE_PLACE'] = $row;
                            }
                            if ($id == 'birthDistrict') {
                                $object_1['BIRTH_DISTRICT'] = $row;
                            }
                            $object_1['KRA_STATUS_OWNER'] = $obj2['firstName'] . ' ' . $obj2['lastName'];
                        }
                    } else {
                        $object_1['NO_KRA_ERROR'] = $obj2;
                    }
                }
            }


            //*
            if (isset($idno)) {
                //$dldt =  DLFetch($idno);
                //$bsn = [];
                $bsn['national_transport_and_safety_authority'] = [];

                $dldt = httpGet('https://serviceportal.ntsa.go.ke/api/i/v1/verify/driving-license?id_number='.$idno.'&id_type=citizen',[],['access-token: '.generateAccessToken(), 'User-Agent: Dart/3.4 (dart:io)']);
                $dldt_1 = json_decode($dldt, true);
                if (is_array($dldt_1)) {
                    $object_1['title_ntsa']  = badge('h2', 'NTSA DATA', 'success');
                    if (isset($dldt_1['data'])) {
                        foreach ($dldt_1['data'] as $id => $row) {
                            $object_1[$id . '_ntsa']  = $row;
                            $bsn['national_transport_and_safety_authority'][$id]  = $row;
                        }
                    }elseif(isset($dldt_1['error'])){
                        if(isset($dldt_1['error']['status'])){
                            if($dldt_1['error']['status'] == 'Not Found'){
                                $object_1['error_ntsa']  = $fullname.' does not have a Driving Licence!';
                                //ERR001NTSA
                                $bsn['national_transport_and_safety_authority']['error']  = 'User does not have a Driving Licence or record not captured in the system!';
                            }else{
                                $object_1['error_ntsa']  = $dldt_1['error']['status'];
                                //ERR002NTSA
                                $bsn['national_transport_and_safety_authority']['error']  = $dldt_1['error']['status'];
                            }
                        }else{
                            $object_1['error_ntsa']  = 'DL Error: '.json_encode($dldt_1);
                            //ERR003NTSA
                            $bsn['national_transport_and_safety_authority']['error']  = 'Driving Licence Error: ERR003NTSA';
                        }
                    }else{
                        $object_1['error_ntsa']  = 'DL Error: '.json_encode($dldt_1);
                        //ERR004NTSA
                        $bsn['national_transport_and_safety_authority']['error']  = 'Driving Licence Error: ERR004NTSA';
                    }
                }
               
            }
            //*/

            //*
            if (isset($idno)) {

                //$bsn = [];
                $bsn['national_health_insurance_fund'] = [];

                $bsn_dt = json_decode(FetchNHIFData($idno), true);
                if (is_array($bsn_dt)) {
                    if (isset($bsn_dt['status_code'])) {
                        if ($bsn_dt['status_code'] == '1000') {
                            $object_1['title_nhif']  = badge('h2', 'NHIF DATA', 'primary');
                            foreach ($bsn_dt['data'] as $id => $row) {
                                $object_1[$id . '_nhif']  = $row;
                                $bsn['national_health_insurance_fund'][$id] = $row;
                            }

                            $bsn['my_dependants'] = NHIFDependants($idno);

                        } elseif ($bsn_dt['status_code'] == '1002') {
                            $object_1['nhif_status']  = '<div class="font-monospace text-primary">' . $firstname . ' IS NOT REGISTERED FOR NHIF!</div>';
                            $bsn['national_health_insurance_fund']['error']  =  $firstname . ' IS NOT REGISTERED FOR NHIF!';
                        }
                    }
                }

                //echo json_encode($bsn).'<br/><br/>';
            }
            //*/
                 //*
                 if (isset($idno)) {

                    //$bsn = [];
                    $bsn['nairobi_revenue_services'] = [];
    
                    $nrs_dt = json_decode(httpGet('https://nairobiservices.go.ke/api/authentication/auth/get_user_details/?id_number='.$idno,[]), true);
                    if (is_array($nrs_dt)) {
                        if (isset($nrs_dt['status'])) {
                            if ($nrs_dt['status'] == 200) {
                                foreach ($nrs_dt['data'] as $id => $row) {
                                    $bsn['nairobi_revenue_services'][$id] = $row;
                                }
                            } elseif ($nrs_dt['status'] == 404) {
                                $bsn['nairobi_revenue_services']['error']  = $nrs_dt['error'];
                            }
                        }
                    }
    
                    //echo json_encode($bsn).'<br/><br/>';
                }
                //*/

        }
    } else {
        $object .= $dt1;
    }
} else {
    $object .= 'id no needed';
}

$jsonobj = json_encode($bsn);

//$obj = '{"fullname":"SIMON NJUGUNA MBOGO","firstname":"SIMON ","activeFlag":null,"birthDistrict":7350,"birthTown":null,"citizen":null,"createdBy":null,"createdDt":null,"dateBirth":"1971-04-14T00:00:00Z","dbirth":null,"dbirth2":null,"fatherBirthDistrict":null,"fatherBirthTown":null,"fatherDateBirth":null,"fatherIdentityId":null,"fatherLastName":" KARANJA","fatherMiddleName":"MBOGO","fathersFirstName":"JEREMIAH ","fingerPrint":null,"firstName":"SIMON ","identityId":"10892667","isAlreadyRegistered":false,"isAlreadyRegisteredMig":false,"isValidNID":true,"issueDate":"2002-06-21T00:00:00Z","issuePlace":"KANGEMI","lastName":" MBOGO","maritalStatus":null,"middleName":"NJUGUNA","motherBirthDistrict":null,"motherBirthTown":null,"motherDateBirth":null,"motherIdentityId":null,"motherLastName":" WANJIRU","motherMiddleName":null,"mothersFirstName":"ESTHER ","natRegId":null,"photo":"","physicalAddress":"644 NAKURU","pinNoforRegNIDMig":null,"replicationDt":null,"sex":"Male","spouseBirthDistrict":null,"spouseBirthTown":null,"spouseDateBirth":null,"spouseFirstName":null,"spouseIdentityId":null,"spouseLastName":null,"spouseMiddleName":null,"updatedBy":null,"updatedDt":null,"valid":true,"surname":"MBOGO","serial_no":"216644190","other_name":"NJUGUNA","id_number":"10892667","gender":"M","first_name":"Simon","family":"","dob":"","citizenship":"Kenyan","year_ob":"1971","login":"A002642213D","user":"Simon Njuguna Mbogo","kra":"A002642213D","kra_pin":"A002642213D","full_name":"Simon Njuguna Mbogo","major_group":"-Professionals","sub_group":"-Information and Communications Technology Professionals","minor_group":"-Systems Analysts","id_no":"10892667","id_issue_date":"21\/06\/2002","id_issue_place":"WESTLANDS","nssf_no":"","first_name_2":"Simon","middle_name_2":"Njuguna","last_name_2":"Mbogo","dob_2":"14\/04\/1971","place_of_birth":"7350","sex_2":"Male","marital_status":"","father_id_no":"","father_first_name":"JEREMIAH","father_middle_name":"MBOGO","father_last_name":"KARANJA","father_place_of_birth":"brthPlace","father_dob":"","mother_id_no":"","mother_first_name":"ESTHER","mother_middle_name":"","mother_last_name":"WANJIRU","mother_place_of_birth":"brthPlace","mother_dob":"","spouse_id_no":"","spouse_first_name":"","spouse_middle_name":"","spouse_last_name":"","spouse_dob":"","spouse_place_of_birth":"brthPlace","lr_no_1":"","building_1":"CFC Stanbic Hse","street_road_1":"HAILE SELASSIE","city_town_1":"NAIROBI CITY (EAST)","county_1":"Nairobi","district_1":"Westlands District","area_locality_1":"Westlands","descriptive_address_1":"Westlands","postal_code_1":"00100","postal_town":"NAIROBI GPO","po_box_1":"24522","address_line_4":"","address_line_5":"","address_line_6":"","telephone_number":"0722714163","mobile_number":"0722714163","mobile_number_2":"","mobile_number_3":"","main_email_1":"SNMBOGO@GMAIL.COM","secondary_email_1":"","nssf_no_1":"","alien_no":"","middle_name":"Njuguna","last_name":"Mbogo","origin_country":"","work_permit":"","lr_no":"","building":"","street_road":"","city_town":"","county":"","district":"","tax_area":"","descriptive_address":"","postal_code":"","town":"","po_box":"","first_name_1":"Simon","middle_name_1":"Njuguna","last_name_1":"Mbogo","dob_1":"14\/04\/1971","sex_1":"Male","passport_no":"","passport_issue_country":"","passport_issue_date":"","passport_expiry_date":"","address_line_1":"","address_line_2":"","address_line_3":"","country":"","telephone_no":"","mobile_no_1":"","mobile_no_2":"","mobile_no_3":"","main_email":"","secondary_email":"","sms_notifications":"No","alt_lr_no":"","alt_building":"","alt_street_road":"","alt_city_town":"","alt_county":"","alt_district":"","alt_tax_area":"","alt_descriptive_address":"","alt_postal_code":"","alt_town":"","alt_po_box":"","alt_telephone_no":"","alt_mobile_no":"","alt_email":"","bank_declaration":"No","bank_name":"","bank_branch_name":"","bank_city":"","bank_acc_holder_name":"","bank_acc_no":"","tax_obligation":"Income Tax Resident","tax_reg_date":"04\/11\/1999","itax_rollout_date":"01\/01\/2015","national_transport_and_safety_authority":{"date_of_expiry":"2024-07-20","dlclass":"B","full_name":"SIMON NJUGUNA MBOGO","license_number":"HSY47","ncClasses":"","status":"valid"},"national_health_insurance_fund":{"last_contribution_date":"2024-01","phone":null,"id_number":"10892667","first_name":"NJUGUNA SIMON","last_name":"MBOGO ","email":null,"marital_status":"Married","emp_name":"THE BRITISH COUNCIL","birthdate":"1971-12-31","gender":"Male","facility_name":"","choose_facility":true,"opc_facility":null,"member_number":"0694192","branch_name":"UPPER HILL BRANCH","rating":true,"rating_message":"How do you Rate Our Services","payment_status":"ACTIVE","payment_desc":"Payment is upto date"},"nairobi_revenue_services":{"id":245229,"id_number":"10892667","alien_id_number":null,"pin_no":null,"brs_no":null,"mobile_number":"0722714163","email_id":"","mobile_number_2nd":null,"secondary_email_id":null,"tax_payer_type":"INDI","tax_payer_name":"Simon Njuguna Mbogo","passport_no":null,"customer_id":"2020_240841","psv":false,"is_alien":false}}';
$obj = $jsonobj;
$bsn = json_decode($obj, true);
if (!isset($bsn['fullname'])) {
    $_SESSION['error'] = 'Unknown error! Please try again later';
    header('location: ./indVerify');
} elseif ($bsn['fullname'] == null) {
    $_SESSION['error'] = 'Document number not found!';
    header('location: ./indVerify');
}

$item = json_decode($obj, true);
function convertToReadableFormat($input)
{
    // Check if the input contains snake_case
    if (strpos($input, '_') !== false) {
        // Convert snake_case to readable format
        $words = explode('_', $input);
    } else {
        // Convert camelCase to readable format
        $words = preg_split('/(?=[A-Z])/', $input);
    }

    // Trim, capitalize the first letter of each word and make the rest lowercase
    $words = array_map(function ($word) {
        return ucfirst(strtolower(trim($word)));
    }, $words);

    // Join the words with spaces
    return implode(' ', $words);
}
$table1 = '
<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Common Data Profile</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0 pb-5">
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <table class="table align-middle table-striped gy-7 gs-7">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th></th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-bold text-gray-600">';
foreach ($item as $id => $row) {
    if (!is_array($row) && !is_bool($row) && $row != '' && $row != null) {
        $table1 .= '
                     <tr>
                        <td>' . convertToReadableFormat($id) . '</td>
                        <td>' . $row . '</td>
                     </tr>
                     ';
    }
}


$table1 .= '
                </tbody>
            </table>
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
';
//echo $table1;

$table2 = '
<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>National Transport Authority Profile</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0 pb-5">
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <table class="table align-middle table-striped gy-7 gs-7">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th></th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-bold text-gray-600">';
foreach ($item['national_transport_and_safety_authority'] as $id => $row) {
    if (!is_array($row)) {
        $table2 .= '
                     <tr>
                        <td>' . convertToReadableFormat($id) . '</td>
                        <td>' . $row . '</td>
                     </tr>
                     ';
    }
}


$table2 .= '
                </tbody>
            </table>
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
';
//echo $table2;



$table3 = '
<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Health Insurance Profile</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0 pb-5">
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <table class="table align-middle table-striped gy-7 gs-7">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th></th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-bold text-gray-600">';
foreach ($item['national_health_insurance_fund'] as $id => $row) {
    if (!is_array($row) && !is_bool($row) && $row != '' && $row != null) {
        $table3 .= '
                     <tr>
                        <td>' . convertToReadableFormat($id) . '</td>
                        <td>' . $row . '</td>
                     </tr>
                     ';
    }
}


$table3 .= '
                </tbody>
            </table>
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
';
//echo $table3;



$table4 = '
<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Nairobi County Profile</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0 pb-5">
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <table class="table align-middle table-striped gy-7 gs-7">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th></th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-bold text-gray-600">';
foreach ($item['nairobi_revenue_services'] as $id => $row) {
    if (!is_array($row) && !is_bool($row) && $row != '' && $row != null) {
        $table4 .= '
                     <tr>
                        <td>' . convertToReadableFormat($id) . '</td>
                        <td>' . $row . '</td>
                     </tr>
                     ';
    }
}


$table4 .= '
                </tbody>
            </table>
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
';

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

//contact obj
$contactObj = [];

if(isset($bsn['telephone_no'])){
    $contactObj['telephone_no'] =$bsn['telephone_no'];
}
if(isset($bsn['mobile_no'])){
    $contactObj['mobile_no'] =$bsn['mobile_no'];
}
if(isset($bsn['mobile_no_1'])){
    $contactObj['mobile_no_1'] =$bsn['mobile_no_1'];
}
if(isset($bsn['mobile_no_2'])){
    $contactObj['mobile_no_2'] =$bsn['mobile_no_2'];
}
if(isset($bsn['mobile_no_3'])){
    $contactObj['mobile_no_3'] =$bsn['mobile_no_3'];
}
if(isset($bsn['national_health_insurance_fund']['phone'])){
    $contactObj['mobile_no_4'] =$bsn['national_health_insurance_fund']['phone'];
}
if(isset($bsn['nairobi_revenue_services']['mobile_number'])){
    $contactObj['mobile_no_5'] =$bsn['nairobi_revenue_services']['mobile_number'];
}
if(isset($bsn['nairobi_revenue_services']['mobile_number_2nd'])){
    $contactObj['mobile_no_6'] =$bsn['nairobi_revenue_services']['mobile_number_2nd'];
}
if(isset($bsn['main_email_1'])){
    $contactObj['email'] =$bsn['main_email_1'];
}
if(isset($bsn['secondary_email_1'])){
    $contactObj['email_1'] =$bsn['secondary_email_1'];
}
if(isset($bsn['main_email'])){
    $contactObj['email_2'] =$bsn['main_email'];
}
if(isset($bsn['secondary_email'])){
    $contactObj['email_3'] =$bsn['secondary_email'];
}
if(isset($bsn['alt_email'])){
    $contactObj['email_4'] =$bsn['alt_email'];
}
if(isset($bsn['national_health_insurance_fund']['email'])){
    $contactObj['email_5'] =$bsn['national_health_insurance_fund']['email'];
}
if(isset($bsn['nairobi_revenue_services']['email_id'])){
    $contactObj['email_6'] =$bsn['nairobi_revenue_services']['email_id'];
}
if(isset($bsn['nairobi_revenue_services']['secondary_email_id'])){
    $contactObj['email_7'] =$bsn['nairobi_revenue_services']['secondary_email_id'];
}
$contactItem = '';
foreach($contactObj as $id=>$row){
    if($row != "" || $row != null){
    $contactItem .= '
    <!--begin::Details item-->
    <div class="fw-bolder mt-5">'.convertToReadableFormat($id).'</div>
    <div class="text-gray-600">' . $row . '</div>
     <!--begin::Details item-->
    ';
    }

}

//relatives obj
$relativesObj = '';
if(isset($bsn['my_dependants'])){
    if(is_array($bsn['my_dependants'])){
        foreach($bsn['my_dependants'] as $id=>$row){
            $relativesObj .= '
            <!--begin::Time-->
            <div class="d-flex flex-stack position-relative mt-6">
                <!--begin::Bar-->
                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                <!--end::Bar-->
                <!--begin::Info-->
                <div class="fw-bold ms-5">
                    <!--begin::ID Number-->
                    <div class="fs-7 mb-1">ID Number:  
                    <span class="fs-7 text-muted text-uppercase">'.$row['id_number'].'</span></div>
                    <!--end::ID Number-->
                    <!--begin::Name-->
                    <a class="fs-5 fw-bolder text-dark text-hover-primary mb-2">'.$row['first_name'].' '.$row['last_name'].'</a>
                    <!--end::Name-->
                    <!--begin::DOB-->
                    <div class="fs-7 text-muted">DOB:  
                    <a class="text-primary">'.$row['birthdate'].'</a></div>
                    <!--end::DOB-->
                    <!--begin::Relationship-->
                    <div class="fs-7 text-muted">Relationship:  
                    <a class="text-primary">'.$row['relationship'].'</a></div>
                    <!--end::Relationship-->
                    <!--begin::Gender-->
                    <div class="fs-7 text-muted">Gender:  
                    <a class="text-primary">'.$row['gender'].'</a></div>
                    <!--end::Gender-->
                </div>
            </div>
            <!--end::Time-->          
            ';
        }
    }
}
$relativesObj .= '
            <!--begin::Time-->
            <div class="d-flex flex-stack position-relative mt-6">
                <!--begin::Bar-->
                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                <!--end::Bar-->
                <!--begin::Info-->
                <div class="fw-bold ms-5">
                    <!--begin::ID Number-->
                    <div class="fs-7 mb-1">ID Number:  
                    <span class="fs-7 text-muted text-uppercase">'.$bsn['motherIdentityId'].'</span></div>
                    <!--end::ID Number-->
                    <!--begin::Name-->
                    <a class="fs-5 fw-bolder text-dark text-hover-primary mb-2">'.$bsn['mothersFirstName'].' '.$bsn['motherMiddleName'].' '.$bsn['motherLastName'].'</a>
                    <!--end::Name-->
                    <!--begin::DOB-->
                    <div class="fs-7 text-muted">DOB:  
                    <a class="text-primary">'.$bsn['motherDateBirth'].'</a></div>
                    <!--end::DOB-->
                    <!--begin::Relationship-->
                    <div class="fs-7 text-muted">Relationship:  
                    <a class="text-primary">Mother</a></div>
                    <!--end::Relationship-->
                    <!--begin::Gender-->
                    <div class="fs-7 text-muted">Gender:  
                    <a class="text-primary">Female</a></div>
                    <!--end::Gender-->
                </div>
            </div>
            <!--end::Time--> 
            
            <!--begin::Time-->
            <div class="d-flex flex-stack position-relative mt-6">
                <!--begin::Bar-->
                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                <!--end::Bar-->
                <!--begin::Info-->
                <div class="fw-bold ms-5">
                    <!--begin::ID Number-->
                    <div class="fs-7 mb-1">ID Number:  
                    <span class="fs-7 text-muted text-uppercase">'.$bsn['fatherIdentityId'].'</span></div>
                    <!--end::ID Number-->
                    <!--begin::Name-->
                    <a class="fs-5 fw-bolder text-dark text-hover-primary mb-2">'.$bsn['fathersFirstName'].' '.$bsn['fatherMiddleName'].' '.$bsn['fatherLastName'].'</a>
                    <!--end::Name-->
                    <!--begin::DOB-->
                    <div class="fs-7 text-muted">DOB:  
                    <a class="text-primary">'.$bsn['fatherDateBirth'].'</a></div>
                    <!--end::DOB-->
                    <!--begin::Relationship-->
                    <div class="fs-7 text-muted">Relationship:  
                    <a class="text-primary">Father</a></div>
                    <!--end::Relationship-->
                    <!--begin::Gender-->
                    <div class="fs-7 text-muted">Gender:  
                    <a class="text-primary">Male</a></div>
                    <!--end::Gender-->
                </div>
            </div>
            <!--end::Time-->       
            ';

$sidebar = '
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
                                <a class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">'.$bsn['fullname'].'</a>
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
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details2" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Contact Profile
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
                                '.$contactItem.'
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
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details2" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Relatives Profile
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
                                '.$relativesObj.'
                                </div>
                            </div>
                            <!--end::Profile content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                    
                 
                    
                </div>
                <!--end::Sidebar-->
';
$expoundData =  $table1 . $table2 . $table3 . $table4;
$output = [];
$output['json'] = $jsonobj;
$output['expoundDataHtml'] = $expoundData;
$output['sidebar'] = $sidebar;

ob_end_clean();
echo json_encode($output);
