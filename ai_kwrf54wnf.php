<?php
include './includes/core2.php';

logCustomError(json_encode($_POST));
$payload = $_POST['payload'];
$obj = json_decode($payload, true);

//$obj = '{"fullname":"SIMON NJUGUNA MBOGO","firstname":"SIMON ","activeFlag":null,"birthDistrict":7350,"birthTown":null,"citizen":null,"createdBy":null,"createdDt":null,"dateBirth":"1971-04-14T00:00:00Z","dbirth":null,"dbirth2":null,"fatherBirthDistrict":null,"fatherBirthTown":null,"fatherDateBirth":null,"fatherIdentityId":null,"fatherLastName":" KARANJA","fatherMiddleName":"MBOGO","fathersFirstName":"JEREMIAH ","fingerPrint":null,"firstName":"SIMON ","identityId":"10892667","isAlreadyRegistered":false,"isAlreadyRegisteredMig":false,"isValidNID":true,"issueDate":"2002-06-21T00:00:00Z","issuePlace":"KANGEMI","lastName":" MBOGO","maritalStatus":null,"middleName":"NJUGUNA","motherBirthDistrict":null,"motherBirthTown":null,"motherDateBirth":null,"motherIdentityId":null,"motherLastName":" WANJIRU","motherMiddleName":null,"mothersFirstName":"ESTHER ","natRegId":null,"photo":"","physicalAddress":"644 NAKURU","pinNoforRegNIDMig":null,"replicationDt":null,"sex":"Male","spouseBirthDistrict":null,"spouseBirthTown":null,"spouseDateBirth":null,"spouseFirstName":null,"spouseIdentityId":null,"spouseLastName":null,"spouseMiddleName":null,"updatedBy":null,"updatedDt":null,"valid":true,"surname":"MBOGO","serial_no":"216644190","other_name":"NJUGUNA","id_number":"10892667","gender":"M","first_name":"Simon","family":"","dob":"","citizenship":"Kenyan","year_ob":"1971","login":"A002642213D","user":"Simon Njuguna Mbogo","kra":"A002642213D","kra_pin":"A002642213D","full_name":"Simon Njuguna Mbogo","major_group":"-Professionals","sub_group":"-Information and Communications Technology Professionals","minor_group":"-Systems Analysts","id_no":"10892667","id_issue_date":"21\/06\/2002","id_issue_place":"WESTLANDS","nssf_no":"","first_name_2":"Simon","middle_name_2":"Njuguna","last_name_2":"Mbogo","dob_2":"14\/04\/1971","place_of_birth":"7350","sex_2":"Male","marital_status":"","father_id_no":"","father_first_name":"JEREMIAH","father_middle_name":"MBOGO","father_last_name":"KARANJA","father_place_of_birth":"brthPlace","father_dob":"","mother_id_no":"","mother_first_name":"ESTHER","mother_middle_name":"","mother_last_name":"WANJIRU","mother_place_of_birth":"brthPlace","mother_dob":"","spouse_id_no":"","spouse_first_name":"","spouse_middle_name":"","spouse_last_name":"","spouse_dob":"","spouse_place_of_birth":"brthPlace","lr_no_1":"","building_1":"CFC Stanbic Hse","street_road_1":"HAILE SELASSIE","city_town_1":"NAIROBI CITY (EAST)","county_1":"Nairobi","district_1":"Westlands District","area_locality_1":"Westlands","descriptive_address_1":"Westlands","postal_code_1":"00100","postal_town":"NAIROBI GPO","po_box_1":"24522","address_line_4":"","address_line_5":"","address_line_6":"","telephone_number":"0722714163","mobile_number":"0722714163","mobile_number_2":"","mobile_number_3":"","main_email_1":"SNMBOGO@GMAIL.COM","secondary_email_1":"","nssf_no_1":"","alien_no":"","middle_name":"Njuguna","last_name":"Mbogo","origin_country":"","work_permit":"","lr_no":"","building":"","street_road":"","city_town":"","county":"","district":"","tax_area":"","descriptive_address":"","postal_code":"","town":"","po_box":"","first_name_1":"Simon","middle_name_1":"Njuguna","last_name_1":"Mbogo","dob_1":"14\/04\/1971","sex_1":"Male","passport_no":"","passport_issue_country":"","passport_issue_date":"","passport_expiry_date":"","address_line_1":"","address_line_2":"","address_line_3":"","country":"","telephone_no":"","mobile_no_1":"","mobile_no_2":"","mobile_no_3":"","main_email":"","secondary_email":"","sms_notifications":"No","alt_lr_no":"","alt_building":"","alt_street_road":"","alt_city_town":"","alt_county":"","alt_district":"","alt_tax_area":"","alt_descriptive_address":"","alt_postal_code":"","alt_town":"","alt_po_box":"","alt_telephone_no":"","alt_mobile_no":"","alt_email":"","bank_declaration":"No","bank_name":"","bank_branch_name":"","bank_city":"","bank_acc_holder_name":"","bank_acc_no":"","tax_obligation":"Income Tax Resident","tax_reg_date":"04\/11\/1999","itax_rollout_date":"01\/01\/2015","national_transport_and_safety_authority":{"date_of_expiry":"2024-07-20","dlclass":"B","full_name":"SIMON NJUGUNA MBOGO","license_number":"HSY47","ncClasses":"","status":"valid"},"national_health_insurance_fund":{"last_contribution_date":"2024-01","phone":null,"id_number":"10892667","first_name":"NJUGUNA SIMON","last_name":"MBOGO ","email":null,"marital_status":"Married","emp_name":"THE BRITISH COUNCIL","birthdate":"1971-12-31","gender":"Male","facility_name":"","choose_facility":true,"opc_facility":null,"member_number":"0694192","branch_name":"UPPER HILL BRANCH","rating":true,"rating_message":"How do you Rate Our Services","payment_status":"ACTIVE","payment_desc":"Payment is upto date"},"nairobi_revenue_services":{"id":245229,"id_number":"10892667","alien_id_number":null,"pin_no":null,"brs_no":null,"mobile_number":"0722714163","email_id":"","mobile_number_2nd":null,"secondary_email_id":null,"tax_payer_type":"INDI","tax_payer_name":"Simon Njuguna Mbogo","passport_no":null,"customer_id":"2020_240841","psv":false,"is_alien":false}}';
//$obj = $payload = json_decode($obj, true);

//echo $obj['payload'];
//$dt2 = json_decode($obj['payload'],true);
//echo $obj['fullname'];
$output = [];
if (!isset($obj['fullname'])) {
    $output['error'] = 'No data parsed or query error!';
} else {
    $ai_info = json_encode($payload);
}
function AI_res($info)
{
    $apiKey = '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';

    $gpt4Model = 'gpt-4-turbo-preview'; // Adjust this to the correct GPT-4 model
    //$gpt4Prompt = "Analyze the profile of this person from the details in the JSON provided and provide useful insights(make its as brief as possible, 20 words max per insight) that a lending company should consider before loaning the person. Also, provide a brief of what the person might be. Create an analysis on a scale of 1 to 10 across five key factors: Financial Stability, Credit History, Income Predictability, Financial Responsibility, and Risk Level then place it between tags <visual></visual>:".$info; // Example prompt
    $gpt4Prompt = 'Analyze the profile of this person from the details in the data provided and explain and expound the profile providing extra details where necessary, making it moderately brief.' . $info;;
    // GPT-4 API URL for chat completions
    $gpt4Url = 'https://api.openai.com/v1/chat/completions';

    // cURL setup for GPT-4
    $ch = curl_init($gpt4Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['model' => $gpt4Model, 'max_tokens' => 1000, 'temperature' => 1, 'frequency_penalty' => 0, 'presence_penalty' => 0, 'messages' => [['role' => 'user', 'content' => $gpt4Prompt]]]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $apiKey]);

    // Execute GPT-4 request
    $response = curl_exec($ch);
    curl_close($ch);

    // Process GPT-4 response
    $responseData = json_decode($response, true);
    $gpt4Insight = $responseData['choices'][0]['message']['content'] ?? 'No insight generated.';
    return  $gpt4Insight;
}

function markdownToHtml($text)
{
    // Convert headings
    $text = preg_replace('/\d+\.\s\*\*(.*?)\*\*/', '<h2 class="text-info mt-4">$1</h2>', $text);

    // Make email addresses clickable
    $text = preg_replace('/\bEmail\:\s([^\s]+)\b/', 'Email: <a href="mailto:$1">$1</a>', $text);

    // Handle bold text
    $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);

    // Convert list items; first, split text into lines
    $lines = explode("\n", $text);
    $html = '';
    $inList = false;

    foreach ($lines as $line) {
        // Check if line is a list item
        if (strpos($line, '-') === 0) {
            $line = '<li>' . substr($line, 1) . '</li>'; // Remove dash and wrap in <li>
            if (!$inList) {
                $line = '<ul>' . $line;
                $inList = true;
            }
        } else {
            if ($inList) {
                $line = '</ul>' . $line;
                $inList = false;
            }
            $line = '<p>' . $line . '</p>';
        }
        $html .= $line;
    }

    // Close <ul> if it's still open
    if ($inList) {
        $html .= '</ul>';
    }

    return $html;
}

if (isset($ai_info)) {
    $responseText = AI_res($ai_info);
} else {
    $responseText = $output['error'];
}


$htmlText = markdownToHtml($responseText);
$htmlText = str_replace('</h2>:', '</h2>', $htmlText);
$htmlText = str_replace('</strong>:', '</strong>', $htmlText);
$htmlText = str_replace('- <strong>', '<strong>', $htmlText);
$AIData = '
<!--begin::Tasks-->
<div class="card card-flush mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header mt-6">
        <!--begin::Card title-->
        <div class="card-title flex-column">
        <h2 class="mb-1">AI-Powered User Insights Overview</h2>
        <div class="fs-6 fw-bold text-muted">Unlock Insights, Empower Decisions: AI-Driven Intelligence</div>
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body d-flex flex-column">
    ' . $htmlText . ';
     
    </div>
    <!--end::Card body-->
</div>
<!--end::Tasks-->
';

$output['gptRes'] = $htmlText;
echo json_encode($output);
