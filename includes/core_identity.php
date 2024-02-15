<?php
session_start();

function myToken()
{
    $curl = curl_init();
    //$cookiesFile = '../cookies/identity.txt';
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://identity.safaricom.com/graphql?grant_type=client_credentials',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        //CURLOPT_COOKIEJAR => realpath($cookiesFile),
        //CURLOPT_COOKIEFILE => realpath($cookiesFile),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "query": "\\n            query GenerateToken{\\n                generateToken{\\n                  status\\n                  message\\n                  token \\n                }\\n            }\\n           "
 }',
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
            'Accept: application/json, text/plain, */*',
            'Content-Type: application/json',
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.360101',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-site',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: identity.safaricom.com',
            //'Cookie: dtCookie=v_4_srv_3_sn_0A9306B63B9E78799A200569C5EF0832_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0; incap_ses_1020_2516540=4wAdZqSLWjE1G1MGlMUnDo1Zk2QAAAAA9Gsu5BDlZLo/l2bb/I88jg==; incap_ses_1023_2353962=7gEgem6KhxIY84DyD24yDr1Xk2QAAAAAxZI8AEsjqTpz8p4efYdGgw==; incap_ses_1213_2353962=6AuQMWnFTBCbm4PzBHLVEABZk2QAAAAAIIGbR6e3SCqnDWJvncYWtg==; incap_ses_1342_2353962=xp7HF3RSyWaRGDA2rL6fErVNk2QAAAAAs0bdvm4KM2de+Hi2XRnyZQ==; incap_ses_1548_2516540=6qWmWrq+cS2djC8pPJp7FeFXk2QAAAAA03eEKVrqc7V5wPHgBx4Nfg==; incap_ses_777_2353962=wCdAWwcZZQVlfUycVnbICuNOk2QAAAAA+qE8Sf424fVzwryaEwoz6w==; nlbi_2353962=rckiSFq8wRiotdQXq+f5rwAAAAB9OecGhz6gUsLRmYuEKNoG; nlbi_2516540=vDfrW03Fe05F7SCy3rmYCAAAAADLbr0Rfk/O490oKBGJg5hj; visid_incap_2353962=VoWSZBAJQ+GNYSZpTeHn67RNk2QAAAAAQUIPAAAAAABVRDcw9+YreklUpZX7PUeK; visid_incap_2516540=Vdj+hce2SV2I4r+FXQSUmJBPk2QAAAAAQUIPAAAAAAAIl3ltvkR1EtiwnXMmtesb'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function hashVerif($token)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.safaricom.com/graphql',
        CURLOPT_RETURNTRANSFER => true,
        //CURLOPT_ENCODING => '',
        //CURLOPT_MAXREDIRS => 10,
        //CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"operationName":"GetToken","variables":{},"query":"query GetToken {\\n  getToken {\\n    status\\n    message\\n    mobileNumber\\n    proceed\\n    hash\\n    __typename\\n  }\\n}\\n"}',
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
            'hetoken: ' . $token,
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
            'content-type: application/json',
            'accept: */*',
            'apollo-require-preflight: true',
            'x-apollo-operation-name: true',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: www.safaricom.com',
            'Cookie: dtCookie=v_4_srv_3_sn_0A9306B63B9E78799A200569C5EF0832_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0; incap_ses_1020_2516540=4wAdZqSLWjE1G1MGlMUnDo1Zk2QAAAAA9Gsu5BDlZLo/l2bb/I88jg==; incap_ses_1023_2353962=NOj/PEKsEzgE7InyD24yDtRkk2QAAAAAgnzqoVsmyCtn9QDMLVS3WQ==; incap_ses_1213_2353962=hMJIBqkXs0ZQZZnzBHLVEARvk2QAAAAAqvhQOfz6yHW01hrS1cmubA==; incap_ses_1342_2353962=xp7HF3RSyWaRGDA2rL6fErVNk2QAAAAAs0bdvm4KM2de+Hi2XRnyZQ==; incap_ses_1548_2516540=JS8YB/UT8FZWQEApPJp7FYhuk2QAAAAAuvrAZ0DH+zOfpwu3Labalg==; incap_ses_777_2353962=wCdAWwcZZQVlfUycVnbICuNOk2QAAAAA+qE8Sf424fVzwryaEwoz6w==; nlbi_2353962=Mo5eU6CWAG9EiSPIq+f5rwAAAAA1DB/xO/Z2sRwLZDehsFiA; nlbi_2516540=vDfrW03Fe05F7SCy3rmYCAAAAADLbr0Rfk/O490oKBGJg5hj; visid_incap_2353962=VoWSZBAJQ+GNYSZpTeHn67RNk2QAAAAAQUIPAAAAAABVRDcw9+YreklUpZX7PUeK; visid_incap_2516540=Vdj+hce2SV2I4r+FXQSUmJBPk2QAAAAAQUIPAAAAAAAIl3ltvkR1EtiwnXMmtesb; adobe_user_id=7e500a9b415326678b77b3c2aa440c8202dc23e6123a842efdef4e39316268ac; adobe_user_id.sig=SWqC6haH1OvonhPy55XniJpHQ4A; mySafaricomWorldProd=CYIVyjqMkx8cUVGd2n0pcyIXyYZoLv2e2f0uPrTdk914md8J0EKKoWf2MtCr7b%2BQguCDVJafroGKJ30C04jvOgfIWXN4O3tX0XNfMnmjIQJdA5kVRM1fGA%3D%3D%3BNjdcjtYUdutyjrakCC0kIMPhlijaKMeb'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function containsWord($string, $searchTerm)
{
    //$searchTerm = 'safaricom';
    $lowercaseString = strtolower($string);
    $lowercaseSearchTerm = strtolower($searchTerm);

    return strpos($lowercaseString, $lowercaseSearchTerm) !== false;
}


function getUserData($token, $cookiesFile)
{
    //$cookiesFile = '../cookies/identity.txt';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.safaricom.com/graphql',
        CURLOPT_RETURNTRANSFER => true,
        //CURLOPT_ENCODING => '',
        //CURLOPT_MAXREDIRS => 10,
        //CURLOPT_TIMEOUT => 0,
        //CURLOPT_FOLLOWLOCATION => true,
        //CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_COOKIEFILE => realpath($cookiesFile),
        CURLOPT_COOKIEJAR => realpath($cookiesFile),
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"operationName":"GetCustomerInfo","variables":{},"query":"query GetCustomerInfo {\\n  getCustomerInfo {\\n    status\\n    message\\n    customerType\\n    firstName\\n    lastName\\n     idNumber\\n    blazer\\n    blazeTariff\\n    tariff\\n    blazerId\\n    __typename\\n  }\\n}\\n"}',
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
            'hetoken: ' . $token,
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
            'content-type: application/json',
            'accept: */*',
            'apollo-require-preflight: true',
            'x-apollo-operation-name: true',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: www.safaricom.com',
            //'Cookie: dtCookie=v_4_srv_3_sn_B6E39360438A8600649B2594F18C36E7_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0_rcs-3Acss_0; incap_ses_1023_2353962=JoCRZQp6CSWJXIJEEm4yDn8comQAAAAAfX5nvFvD7EnoUL1jg8nDMA==; incap_ses_1362_2516540=EduKEp+Xi0a2bXUBmMzmEjoVomQAAAAAsVviR2IGfJL/PiIIjPPPzA==; nlbi_2353962=a16bX4FmxkBlMhr0q+f5rwAAAAAPDkwa60Vlze2zBl3YuZJy; nlbi_2516540=BEv7IMXh0Fbmxei83rmYCAAAAAAJNBb70axOCG7NqKQ63VAq; visid_incap_2353962=VoWSZBAJQ+GNYSZpTeHn67RNk2QAAAAAQUIPAAAAAABVRDcw9+YreklUpZX7PUeK; visid_incap_2516540=Vdj+hce2SV2I4r+FXQSUmJBPk2QAAAAAQUIPAAAAAAAIl3ltvkR1EtiwnXMmtesb; mySafaricomWorldProd=L2HKxhN45dfNdpw%2B0fDpBP3y%2FwCocVhRCaEQCqh71cyfQV9dKzx9z3JFAeY1RNOheU95CpKo8MbFF6reVU7jOpAOlew%2BPXZZezXtByEwQjATDt70Vb81%3BEJYZvtaP%2BIf2XHjJKPK%2FfbUrbzl%2F%2FdS4'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function tempFile($command = 'create', $filePath)
{
    if ($command == 'create') {
        $file = fopen($filePath, 'w'); // 'w' mode will erase content if file exists or create a new one if it doesn't
        fclose($file);
    } elseif ($command = 'delete') {
        unlink($filePath);
    }
}


function GetCustomerInfo($token)
{
    // The ip that queries the token needs to match and this is determined by the cookies. The request that gives this error response returns the cookies needed in the response.
    //What we are doing is forcing the script to generate the error so that we can fetch the cookies, then we are reusing this cookies in the next query to get the response.
    $cookieFile = "./temp_jhsrfbh57tt/custTempCookies_" . generateRandomString(10) . ".txt"; // Path to a file where cookies will be stored
    tempFile('create', $cookieFile);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.safaricom.com/graphql',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_COOKIEJAR => realpath($cookieFile),
        CURLOPT_COOKIEFILE => realpath($cookieFile),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"operationName":"GetCustomerInfo","variables":{},"query":"query GetCustomerInfo {\\n  getCustomerInfo {\\n    status\\n    message\\n    customerType\\n    firstName\\n    lastName\\n     idNumber\\n    blazer\\n    blazeTariff\\n    tariff\\n    blazerId\\n    __typename\\n  }\\n}\\n"}',
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
            'hetoken: ' . $token,
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
            'content-type: application/json',
            'accept: */*',
            'apollo-require-preflight: true',
            'x-apollo-operation-name: true',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: www.safaricom.com',
            //'Cookie: dtCookie=v_4_srv_12_sn_015E87AAE9C243D10EEA49DDEC5EB229_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0; incap_ses_1018_2353962=8xXUCmi1X3o3YopyFKsgDrQqzWUAAAAAfF6wbaeLNotUcV3CIt5EJA==; incap_ses_1319_2353962=u0q1EKebpgtjHmCEhQhOErIkzWUAAAAATIXQBJitjz/LsVA7xGri/g==; incap_ses_368_2516540=k7ZtfGMvvy19ax6mNGcbBQwpzWUAAAAAvWanVb+ZbQ3DVjyH5DNKQw==; nlbi_2353962=2hW2P5tNtlIQFna8q+f5rwAAAABFRBWYICb55Ne41iRN77tf; nlbi_2516540=f354bmSzDDQaYe5fFnrzdAAAAADZAVYP5ubBrUkoYmpi3DrV; visid_incap_2353962=4MDaBcgHQsina0kaYcnAZ0KZwmUAAAAAQUIPAAAAAABVVIyUt+xvoAqCAEzBYQOs; visid_incap_2516540=hLXDMOiJSumzuCmNmIla8mSZwmUAAAAAQUIPAAAAAADXWd3Q/jsgijCBxYdY5HtJ; adobe_user_id=7e500a9b415326678b77b3c2aa440c8202dc23e6123a842efdef4e39316268ac; adobe_user_id.sig=SWqC6haH1OvonhPy55XniJpHQ4A; mySafaricomWorldProd=DC7pO4jxMVK0X%2FHU1oykz2XThuJKb%2BcW0KsnQdZXNF%2BXcg3zslD8VJW6U0orMvgUE4SMvBdkrxH66e1kZjwcL7lhM6z9KclQ8E75JjA2ms49bnwg1thk77FNIvr8X06xJr39kGNrKeGBa2s4UFOKNlUBFWefywTbj%2ByGVhbnpCaJ3lqAMXAcv%2Fy%2FCqrYItK5EHXtHyacSJE9u8Uz3xpncw2XMEdsqFKBmC%2F%2FmzeV%2FuCLbW23hGfprJYSUwSLcau2a8O%2FTCDBcQEgGZ6pbXjm0mBX0zDMvROyAnTu7HnNic%2FgfvTsuQbYq7DFqyED%2Bs73x5GKFc%2FvapL13m6JLurXzfiddO9VWo6blMOQ9lm8RaTpYGYLLeoyeRBdssOcA6PspICLFY0AU3%2FbTWOt4si5I6P4VGC7bpFYTK2jZwMLOCcqOFku%2Bf1ZlfGEegi0Dyyc2uwJs8ZMIXdWxcfi2OZjCUhq7csi9T9M%2BjYG%2FRypfwm7u1xQ6mnOQchDnT1mRngXXQNTULQJVvnbiy9%2B8ynwNBFZPcCO0aqkkLG2SpSwwNlZK8eiGASD2WyJ7q71pnGU6upyYS1qiU99NAp7q%2F9PuQuPuwRmwit2xprOtTxjb1u%2BM6I029Cuki1c1jQ%2FCxcBSKMr504ep87w1Oi8Wgc0lfGo1CnUfTzGgGIya5gCpU%2Bk%2BP4NHoTs4%2FTXyI88NZU9ONGMmFu4eAmiKCR%2B7BwM9BJ5HWo3yhmm7eRin8BUAaXRUVV8EZJNsZQrkaisKud1rOlsHvHTnfwoH4KcIPxWYhUybGo9Hw8iY3PS1ghcPgvNkUWpKO7ZzUmTYyK1UzDqoRB4EpcZtViA%2FIDDg7qTeid44fYvlBIKf4jRpr3BM2PZaUDQZwxk7dvAXMEmxIkQCEVmTpmY8ikNLNMoOasYt02uSXyuFD5AvKIEGzDrFC5eqPJoAlg8QpXfAVH%2FXeWpeJjW1YvorrndqAs3y5ING6WtUDzxfTGGQm0DyadJeChxae1Legosj%2BrTx6BJzyZbx2x0xwy%2BU1%2B6eHQl%2FUPYVc3%2BAWzp58tpFicEutFYgu2%2F2rCHwtFHJynoRq0Wnt%2FzHW3pUUDWK0BhqX7a4AgY4sAGGezPD3Y99I45665W0ax3%2BAIKPXdFGXqcP7vnSF%2Br%2Bsc8Y2qHg11IMsonHot6ZPi%2FNbidllOj5Z5HJFaTmAPrZ7hiEx8BXdLFd02dLA3tUc71wCFIY1i2zFtrVg%2FCB7yXrzEQkCGUecp4qlmSNJ3p3vbRK1Kc3X8bk0zzc4ZuCVzCDu6vxsoWRecyAs3Pzh4pCBIp606rRLmP0iaU7nVNr9fv9roYd3l9WCC4jrhohP1VHG1tQEUd4SFvXzSFnDeeojgUaOnLMPXMYtSVpQ7AmTGkTAurRXzOl41vqkFx3zBcXydlcypqZjvJM6E8v298%3B00RvTSjBvb9WgGbp7nMEunEUzIesn%2BUY',
            //'Cookie: dtCookie=v_4_srv_10_sn_A6B51903A4943D0D53901829EDC528AB_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0; incap_ses_1319_2353962=XCsGJfLcyhqmpnuEhQhOEls3zWUAAAAAZ2xTyrTaPNr+CAM1hOd+Fg==; nlbi_2353962=ja6YTTZG7j+FZ71Oq+f5rwAAAAARgUFjY3vTN2BO5r5hBItV; visid_incap_2353962=4MDaBcgHQsina0kaYcnAZ0KZwmUAAAAAQUIPAAAAAABVVIyUt+xvoAqCAEzBYQOs; visid_incap_2516540=hLXDMOiJSumzuCmNmIla8mSZwmUAAAAAQUIPAAAAAADXWd3Q/jsgijCBxYdY5HtJ; mySafaricomWorldProd=tf1vMwpwxaYrtjIrhcjmVoFH5ld0isr%2Fj6O6CUl1XDFdC5W25gHpyncwYLo9OSv%2BEcPy2zifAirvKFeKi5GTvkeSK79rt4DAmTqmETB4gLUf3%2BfQ%2Bas8jNrYFBhK7Rw7d1dLzsSQwhVtz4nelv8rQSq8mE9H4mLe9J%2F8gDZzx%2B3CYl9uaJuLdXV2WqCyNwYZDkiOQoVOBlmnCoj3SQ4M7eGqDh1%2BElm5Zyk%2Bs2FEc%2BI4Io9KGK0NFjRiw5eEwSTTUFlacXAZGt73VPFo3Z2XC%2FWFa9D3KrOUWbRvawXjf7PkJCvRtkS37ank8DqXCUJ55l5GW2rMHDSJbx%2F%2FtiDSlmhLp9B9t3GjOpTAzctD%2FPWOBPFvOK2Ns8r%2B6DsfnmfTu%2BQOi2zwIeeT3nzhaazOX1tiX3pmiFeD7duLPYAE1uoZ8Is9mSk8FM%2Bsriz3Ds6ERJrTiibSwhamPetbkT6khx%2BQ05FKNEmq5X2bxzc5d09fN8aOWoLfeVfv53BHHu4Yo6%2FBFReTQFieNvwHaWPa8EEGPbHuRz%2FigO55qAoGL6kAHJXSb7pD%2FCNKP5m5zsPmUi8dQ7opIC5FqqyUUq7Ok%2Flu3lUi%2BsBidNABnkd1urUfZnfBBHnW7uUEw2FKuA3pK%2FpZTa0KFvwI4n36qFjrDYaqRaqlgZK%2BDYxZ2d4FykNazLNODJ1QQhHEaYXT7LyJzT9L6L0g0TbhjNYYEOSscNOEHKT6rfw6tz3XEJ5XqipoOpYX8rUO%2Bp5vy8S6WbUKr33U%2BBokrwoQT6%2Biuud66PVyqwcFEtA19ZBwVwE3u0m98cJJs00x8orbfvWth%2FIu5mwr3g6Rqkbs8q0VhEP%2Bx8%2BtN5jI3BpiGdlYTySYq76RQIQefr6Mrtucj1YoofPAg2Xpy1DA%2FKY8MX7zj0vrjqvz1c7W5io8gSL3puZH3Dbg80D%2F3Ug04p9F5vHsfCSfZ0Y2%2FvU5TdlefE1FYw%2BZt9T%2FS9i9RrM0P8IeRlXdGJ7Rcp0hBvWp%2FCaXF9z87n%2FkqFnlDQqr35ohOfi6Ns2S8mwo7crHviJc1DbESC127JrvZKKgujv5wavqx7k9LhC7exHz2ujKTwSdaOot7vvyKIll8aGwAB9t8a79sqgP8pRWZEFgQn6IcROSpaWKNcW0%2FrffJnm4Akr8GTIU1lTHGqsLdQjKCYNIOgmCP8mrcG2aZ%2FZ5%2FDq%2FXiRNn0ngE7hnAH%2BQ%2FJmhPg%2Bxm34m%2Bw0fhNQiuJVINl7jmD5Uwhv%2Bz2K6sIE%2BXIpMrdac8CredNnSZGOGSLSANpgN8mVBpT3vOqDtVKy24Ld6Io9yBfO8T5V%2BjqWcUrFRbJugCp%2FNnBAjUlTotIGh2tUg0pr%2F0amS74HooshKQSq5nHvh1HQSnNxkNU65hNvsAQHB3p4vTRDPxk%2BglGmmiBFdmfHsqhUKlPZZ%3BvAgkESwbNJ3dRsmhf4Hk0bKLL63gxp%2Bz'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    //*
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.safaricom.com/graphql',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_COOKIEFILE => realpath($cookieFile),
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"operationName":"GetCustomerInfo","variables":{},"query":"query GetCustomerInfo {\\n  getCustomerInfo {\\n    status\\n    message\\n    customerType\\n    firstName\\n    lastName\\n     idNumber\\n    blazer\\n    blazeTariff\\n    tariff\\n    blazerId\\n    __typename\\n  }\\n}\\n"}',
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
            'hetoken: ' . $token,
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
            'content-type: application/json',
            'apollo-require-preflight: true',
            'x-apollo-operation-name: true',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: www.safaricom.com',
            //'Cookie: dtCookie=v_4_srv_10_sn_A6B51903A4943D0D53901829EDC528AB_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0; incap_ses_1319_2353962=XCsGJfLcyhqmpnuEhQhOEls3zWUAAAAAZ2xTyrTaPNr+CAM1hOd+Fg==; nlbi_2353962=ja6YTTZG7j+FZ71Oq+f5rwAAAAARgUFjY3vTN2BO5r5hBItV; visid_incap_2353962=4MDaBcgHQsina0kaYcnAZ0KZwmUAAAAAQUIPAAAAAABVVIyUt+xvoAqCAEzBYQOs; visid_incap_2516540=hLXDMOiJSumzuCmNmIla8mSZwmUAAAAAQUIPAAAAAADXWd3Q/jsgijCBxYdY5HtJ; mySafaricomWorldProd=tf1vMwpwxaYrtjIrhcjmVoFH5ld0isr%2Fj6O6CUl1XDFdC5W25gHpyncwYLo9OSv%2BEcPy2zifAirvKFeKi5GTvkeSK79rt4DAmTqmETB4gLUf3%2BfQ%2Bas8jNrYFBhK7Rw7d1dLzsSQwhVtz4nelv8rQSq8mE9H4mLe9J%2F8gDZzx%2B3CYl9uaJuLdXV2WqCyNwYZDkiOQoVOBlmnCoj3SQ4M7eGqDh1%2BElm5Zyk%2Bs2FEc%2BI4Io9KGK0NFjRiw5eEwSTTUFlacXAZGt73VPFo3Z2XC%2FWFa9D3KrOUWbRvawXjf7PkJCvRtkS37ank8DqXCUJ55l5GW2rMHDSJbx%2F%2FtiDSlmhLp9B9t3GjOpTAzctD%2FPWOBPFvOK2Ns8r%2B6DsfnmfTu%2BQOi2zwIeeT3nzhaazOX1tiX3pmiFeD7duLPYAE1uoZ8Is9mSk8FM%2Bsriz3Ds6ERJrTiibSwhamPetbkT6khx%2BQ05FKNEmq5X2bxzc5d09fN8aOWoLfeVfv53BHHu4Yo6%2FBFReTQFieNvwHaWPa8EEGPbHuRz%2FigO55qAoGL6kAHJXSb7pD%2FCNKP5m5zsPmUi8dQ7opIC5FqqyUUq7Ok%2Flu3lUi%2BsBidNABnkd1urUfZnfBBHnW7uUEw2FKuA3pK%2FpZTa0KFvwI4n36qFjrDYaqRaqlgZK%2BDYxZ2d4FykNazLNODJ1QQhHEaYXT7LyJzT9L6L0g0TbhjNYYEOSscNOEHKT6rfw6tz3XEJ5XqipoOpYX8rUO%2Bp5vy8S6WbUKr33U%2BBokrwoQT6%2Biuud66PVyqwcFEtA19ZBwVwE3u0m98cJJs00x8orbfvWth%2FIu5mwr3g6Rqkbs8q0VhEP%2Bx8%2BtN5jI3BpiGdlYTySYq76RQIQefr6Mrtucj1YoofPAg2Xpy1DA%2FKY8MX7zj0vrjqvz1c7W5io8gSL3puZH3Dbg80D%2F3Ug04p9F5vHsfCSfZ0Y2%2FvU5TdlefE1FYw%2BZt9T%2FS9i9RrM0P8IeRlXdGJ7Rcp0hBvWp%2FCaXF9z87n%2FkqFnlDQqr35ohOfi6Ns2S8mwo7crHviJc1DbESC127JrvZKKgujv5wavqx7k9LhC7exHz2ujKTwSdaOot7vvyKIll8aGwAB9t8a79sqgP8pRWZEFgQn6IcROSpaWKNcW0%2FrffJnm4Akr8GTIU1lTHGqsLdQjKCYNIOgmCP8mrcG2aZ%2FZ5%2FDq%2FXiRNn0ngE7hnAH%2BQ%2FJmhPg%2Bxm34m%2Bw0fhNQiuJVINl7jmD5Uwhv%2Bz2K6sIE%2BXIpMrdac8CredNnSZGOGSLSANpgN8mVBpT3vOqDtVKy24Ld6Io9yBfO8T5V%2BjqWcUrFRbJugCp%2FNnBAjUlTotIGh2tUg0pr%2F0amS74HooshKQSq5nHvh1HQSnNxkNU65hNvsAQHB3p4vTRDPxk%2BglGmmiBFdmfHsqhUKlPZZ%3BvAgkESwbNJ3dRsmhf4Hk0bKLL63gxp%2Bz'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    tempFile('delete', $cookieFile);
    return $response;
    //*/
}

function queryMyNumbers($token)
{
    $cookieFile = "./temp_jhsrfbh57tt/no6tempCookies_" . generateRandomString(10) . ".txt"; // Path to a file where cookies will be stored
    tempFile('create', $cookieFile);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.safaricom.com/graphql',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_COOKIEJAR => realpath($cookieFile),
        CURLOPT_COOKIEFILE => realpath($cookieFile),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"operationName":"QueryMyNumbers","variables":{},"query":"query QueryMyNumbers {\\n  queryMyNumbers {\\n    clear\\n    masked\\n    status\\n    __typename\\n  }\\n}"}',
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Not A(Brand";v="99", "Google Chrome";v="121", "Chromium";v="121"',
            'hetoken: ' . $token,
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
            'x-dtpc: 15$343283100_726h21vERLJGPFCPHCCFFRJNQSWHKMSDKVFOCHU-0e0',
            'content-type: application/json',
            'accept: */*',
            'apollo-require-preflight: true',
            'caidtoken: ',
            'x-apollo-operation-name: true',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: www.safaricom.com',
            //'Cookie: dtCookie=v_4_srv_10_sn_A6B51903A4943D0D53901829EDC528AB_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0; incap_ses_1018_2353962=dvt5QNASUniwX5dyFKsgDlE8zWUAAAAAVfbkW5hWbrqBEcMuDVtVGg==; incap_ses_1319_2353962=XCsGJfLcyhqmpnuEhQhOEls3zWUAAAAAZ2xTyrTaPNr+CAM1hOd+Fg==; nlbi_2353962=umG9AfLkmDM3t7o7q+f5rwAAAAC7sSwRaLz7UHKbhJbfPFTn; visid_incap_2353962=4MDaBcgHQsina0kaYcnAZ0KZwmUAAAAAQUIPAAAAAABVVIyUt+xvoAqCAEzBYQOs; visid_incap_2516540=hLXDMOiJSumzuCmNmIla8mSZwmUAAAAAQUIPAAAAAADXWd3Q/jsgijCBxYdY5HtJ; mySafaricomWorldProd=MGjZDQNc6ahrkiYDHFG7XniSBAaL2AhHjmD8gO1S0CiiKE2%2BfD4qx567gILMxm4Ybm8INQxvmff8nB6O3cx7dylFVTl8p2iT%2Bb0UqaEd9u72pZazFkcLPzesax0x%2BufIaQyawJKExI1SjNzgmMG9NzgQyd3PwK7zzMP9PZ3PxodNqcDRkp6TcoC6SIq1BX1RlrBHg8cyEBOO9l8cHgbQpGYP4cdsWEjXM%2BMkN9uuUjFuL1vmp8DHPFuQ11iqW6Bd1IHsy9W6yIRCIuyx28RfoWxYvDzhRdbjF5nzk6FOck8MeFX5yhFa%2FkdVdq7P7nZoxuWj79O1uIrG9OBZ4MiE86qT82Zy5h4f0P4m%2F2NZTR%2BwkwxNUzs6Ek2TYvRCnJhymeJpvwDw8cxDLSQd7GcAfeYN%2F7YBiyj%2BqZGq8vXELLkb9VsV7mjFF23KW2ivB05ra0z5M5%2FBVZJgoIuqgycK2b7S%2BzKXeQ1JqhA8H5doR3NSDJRIlIbO5LB0jRdJ8e2K%2FFq5uss28ophcFXhp%2B5XUPDnx4uGrEk5Xaaxr7cDnH0bo0J%2FKNldogvB0EL72O%2F24xBeRAL9gZCfagVONNYVGKacihWBJiolW5FzOKu845xl9%2FirLQfjIGclm6SZ2pWjN2%2BclRr3X5hfvFn%2FQLiI07j9zD1fEtmkBXcSXZZq%2BqzFSNFyJt5%2BhcbaegMZw5Q6TX%2FFa8TDaa0kaNgYB6eG3D8Q3xYRthjLXjBhr7vDA2BPVmKXa6JbnN%2BH3N9BhQISc4hNKscFHGmP6xWDA68dPo3jpSJClnzPN86hq5FUdWDvevXKVlUr9fhhugI0lVrfJdchCnDrS46OfBifdUExTNxVfJfSiHvoKfaIuJOWX199YTGYZiF38Nd4ORxY0xNDoPUJNbc2p37BW%2FuhXgGhEe3WC8dssJcxmjftuxCb5L81J2%2BBjjKaR1wz3JoJNuA2M9MZAWcDRNJxj11rqpxMacM5iqY9S4Yv2VOHAUwzZRNkXounWgwWSLzvDkey%2BSaf%2FuDqH484eISSoGnONEAZeTRwEA4cEC73OkVJkiYK%2BxCbztzcUww2AvzybyigrWZKAH2fE0LkytFNcZE%2B%2Be4I4pecSjpQcgYfQQ66yzZUR7HcH3OCZyTpC6Lw1FYBij%2BpfWvUBlcuYIL9K7CFKSz2w5aIOPsd9xes6VANPXVMYo%2BAr87ZMea%2B2mBC83d22OXOS7%2FrgFE7hhcM%2B%2B8FrKCjWhIrGNXdx%2BgORpqoMq1ZLA2R%2Bw2scE70lloHgkpvNS0m6Dr2TUsztZ7UniAryPnVz4OV0tupnXyTvnsjdCuGQ8NN87nk9VwGktpir%2FETF0o%3D%3B5UvlRwwBKB1vFZP%2FikZ%2F23JYlx5Hehau'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.safaricom.com/graphql',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_COOKIEFILE => realpath($cookieFile),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"operationName":"QueryMyNumbers","variables":{},"query":"query QueryMyNumbers {\\n  queryMyNumbers {\\n    clear\\n    masked\\n    status\\n    __typename\\n  }\\n}"}',
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Not A(Brand";v="99", "Google Chrome";v="121", "Chromium";v="121"',
            'hetoken: ' . $token,
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
            'x-dtpc: 15$343283100_726h21vERLJGPFCPHCCFFRJNQSWHKMSDKVFOCHU-0e0',
            'content-type: application/json',
            'accept: */*',
            'apollo-require-preflight: true',
            'caidtoken: ',
            'x-apollo-operation-name: true',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: www.safaricom.com',
            //'Cookie: dtCookie=v_4_srv_10_sn_A6B51903A4943D0D53901829EDC528AB_perc_100000_ol_0_mul_1_app-3Aef3130cdf2794d94_0; incap_ses_1018_2353962=dvt5QNASUniwX5dyFKsgDlE8zWUAAAAAVfbkW5hWbrqBEcMuDVtVGg==; incap_ses_1319_2353962=XCsGJfLcyhqmpnuEhQhOEls3zWUAAAAAZ2xTyrTaPNr+CAM1hOd+Fg==; nlbi_2353962=umG9AfLkmDM3t7o7q+f5rwAAAAC7sSwRaLz7UHKbhJbfPFTn; visid_incap_2353962=4MDaBcgHQsina0kaYcnAZ0KZwmUAAAAAQUIPAAAAAABVVIyUt+xvoAqCAEzBYQOs; visid_incap_2516540=hLXDMOiJSumzuCmNmIla8mSZwmUAAAAAQUIPAAAAAADXWd3Q/jsgijCBxYdY5HtJ; mySafaricomWorldProd=MGjZDQNc6ahrkiYDHFG7XniSBAaL2AhHjmD8gO1S0CiiKE2%2BfD4qx567gILMxm4Ybm8INQxvmff8nB6O3cx7dylFVTl8p2iT%2Bb0UqaEd9u72pZazFkcLPzesax0x%2BufIaQyawJKExI1SjNzgmMG9NzgQyd3PwK7zzMP9PZ3PxodNqcDRkp6TcoC6SIq1BX1RlrBHg8cyEBOO9l8cHgbQpGYP4cdsWEjXM%2BMkN9uuUjFuL1vmp8DHPFuQ11iqW6Bd1IHsy9W6yIRCIuyx28RfoWxYvDzhRdbjF5nzk6FOck8MeFX5yhFa%2FkdVdq7P7nZoxuWj79O1uIrG9OBZ4MiE86qT82Zy5h4f0P4m%2F2NZTR%2BwkwxNUzs6Ek2TYvRCnJhymeJpvwDw8cxDLSQd7GcAfeYN%2F7YBiyj%2BqZGq8vXELLkb9VsV7mjFF23KW2ivB05ra0z5M5%2FBVZJgoIuqgycK2b7S%2BzKXeQ1JqhA8H5doR3NSDJRIlIbO5LB0jRdJ8e2K%2FFq5uss28ophcFXhp%2B5XUPDnx4uGrEk5Xaaxr7cDnH0bo0J%2FKNldogvB0EL72O%2F24xBeRAL9gZCfagVONNYVGKacihWBJiolW5FzOKu845xl9%2FirLQfjIGclm6SZ2pWjN2%2BclRr3X5hfvFn%2FQLiI07j9zD1fEtmkBXcSXZZq%2BqzFSNFyJt5%2BhcbaegMZw5Q6TX%2FFa8TDaa0kaNgYB6eG3D8Q3xYRthjLXjBhr7vDA2BPVmKXa6JbnN%2BH3N9BhQISc4hNKscFHGmP6xWDA68dPo3jpSJClnzPN86hq5FUdWDvevXKVlUr9fhhugI0lVrfJdchCnDrS46OfBifdUExTNxVfJfSiHvoKfaIuJOWX199YTGYZiF38Nd4ORxY0xNDoPUJNbc2p37BW%2FuhXgGhEe3WC8dssJcxmjftuxCb5L81J2%2BBjjKaR1wz3JoJNuA2M9MZAWcDRNJxj11rqpxMacM5iqY9S4Yv2VOHAUwzZRNkXounWgwWSLzvDkey%2BSaf%2FuDqH484eISSoGnONEAZeTRwEA4cEC73OkVJkiYK%2BxCbztzcUww2AvzybyigrWZKAH2fE0LkytFNcZE%2B%2Be4I4pecSjpQcgYfQQ66yzZUR7HcH3OCZyTpC6Lw1FYBij%2BpfWvUBlcuYIL9K7CFKSz2w5aIOPsd9xes6VANPXVMYo%2BAr87ZMea%2B2mBC83d22OXOS7%2FrgFE7hhcM%2B%2B8FrKCjWhIrGNXdx%2BgORpqoMq1ZLA2R%2Bw2scE70lloHgkpvNS0m6Dr2TUsztZ7UniAryPnVz4OV0tupnXyTvnsjdCuGQ8NN87nk9VwGktpir%2FETF0o%3D%3B5UvlRwwBKB1vFZP%2FikZ%2F23JYlx5Hehau'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    tempFile('delete', $cookieFile);
    return $response;
}
