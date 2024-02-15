<?php
//include './includes/header.php';

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

$responseText = "Based on the JSON provided, we can establish a comprehensive profile of the individual named Ruth Warorua Njeri. Below is an expounded profile that addresses the most significant aspects of the information provided: 1. **Basic Personal Information**: - **Name**: Ruth Warorua Njeri. It's clear from the naming convention that she likely hails from a region where such names are common, potentially pointing towards Kenyan heritage. - **Gender**: Female. - **Birth Date**: 24th May 1987, making her 36 years old at the time of this information's cutoff in 2023. - **Marital Status**: Information not provided; the field is null. 2. **Contact Information**: - **Email**: RNJERI39@YAHOO.COM. This email address suggests she might not use professional or work-related email services for communication or does not have one linked to this profile. - **Mobile Number**: +254727828772 (Presuming the country code given the Kenyan citizenship). - **Postal Address**: P.O Box 1356, Thika, 01000. This suggests she might either live or prefer to receive mail in or near Thika, a significant town in Kenya. - **Residence**: Lives in a building named \"gatanga\" on Gatanga Road, Thika. This provides a clear indication of her residential location. 3. **Identification and Citizenship**: - **National ID (NID)**: Number 26121480, issued on 16th January 2015. The presence of a Kenyan national ID confirms her Kenyan citizenship beyond the citizenship code. - **Citizenship Code**: KE, confirming Kenyan citizenship. - **PIN Number**: A008344832R. This is a tax identification number in Kenya, indicating she is registered with the Kenyan Revenue Authority (KRA). 4. **Taxpayer Information**: - **Taxpayer Type**: Individual (INDI), indicating she files taxes in her capacity as an individual rather than as a corporation or non-individual entity. - **Taxpayer Name**: Matches her full name, ensuring consistency in her identification across different official capacities. 5. **Employment and Profession**: - The information does not directly address her profession or employment status. Fields that could hint at a work permit number or other professions are null or not applicable, suggesting she might either be employed locally within Kenya without the need for a work permit or this detail was not captured or is deemed irrelevant for this profile. 6. **Status and Authentication**: - **Active Flag**: Active, which likely indicates that her profile or account status in whatever system this data is drawn from is current and not deactivated or suspended. - **Effective Date**: 16th January 2015, which could be significant for reasons such as the date of registration or the latest update to her data. 7. **Other Details**: - She does not hold an account or an ERP (Enterprise Resource Planning) account with the service or database providing this JSON data, suggesting she might be listed for purposes unrelated to user account functionality(e.g., tax, legal, or demographic databases). In summary, Ruth Warorua Njeri is a 36-year-old Kenyan female living in Thika, with clear identification and taxpayer status in Kenya. She communicates through a personal email and possesses a Kenyan mobile number. Her profile, while lacking in professional detail, gives a solid overview of her identity, location, and fiscal responsibilities in Kenya.";

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
    '.$htmlText.';
     
    </div>
    <!--end::Card body-->
</div>
<!--end::Tasks-->
';
//echo $htmlText;
?>
