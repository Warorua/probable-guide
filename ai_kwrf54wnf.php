<?php
include './includes/core2.php';

logCustomError(json_encode($_POST));

$obj = json_decode($_POST['payload'], true);
//echo $obj['payload'];
//$dt2 = json_decode($obj['payload'],true);
//echo $obj['fullname'];
$output = [];
if(!isset($obj['fullname'])){
    $output['error'] = 'No data parsed or query error!';
}else{
    $ai_info = $_POST['payload'];
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

$responseText = AI_res($ai_info);

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

$output['gptRes'] = $htmlText;
echo json_encode($output);
?>
