<?php
    session_start();
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    
    $email = $_GET['email'];
    
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://plisio.net/api/v1/invoices/new?source_currency=USD&source_amount=10&email=".$email."&order_number=".rand()."&currency=USDT&order_name=level_one&callback_url=https://user.coinagebolt.com/level_one&api_key=MJ-K-5qagP4Vp07rf_ljiH-zLa_2HwyTRkl-fDtuI2thfqN6fb4oOjnv499gOW4C",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "accept: application/json"
      ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo json_encode([
            "status" => 'fail',
            "message" => $err
        ]);
    } else {
        echo json_encode($response);
    }

?>