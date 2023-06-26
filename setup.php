<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cryptocurrency MLM" name="description">
    <meta content="JCWORLD SOFTWARE" name="author">
    <!-- App favicon and theme color -->
    
	<meta name="theme-color" content="#1d69fb" />
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#1d69fb" />
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="black" />
	<link href="/img/icon_a.png" rel="icon" sizes="32x32" />
	<link href="/img/icon_a.png" rel="icon" sizes="192x192" />
	<link href="/img/icon_a.png" rel="apple-touch-icon" />
	<meta name="msapplication-TileImage" content="https://coinagebolt.com/img/icon_a.png" />
	
    <link href="css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
    <!-- Main Css-->
    <link href="css/main.css" id="main-style" rel="stylesheet" type="text/css">

</head>
<button class="btn btn-primary" id="btn">
    Go now
</button>

<?php
require __DIR__ . '/vendor/autoload.php';

$baseUrl = 'https://api.bitfinex.com';
$client = new GuzzleHttp\Client([
  'base_uri' => $baseUrl,
  'timeout' => 3.0,
]);

$apiKey = 'dLDW26D4eEiudINBbBqLPk9xxzMwHeaBV0Op9HNg0Ov';
$apiSecret = 'yJ9FxmqIiEY3s9eorfVqIyop2yXS5PEh0dPqIpiTJ7w';

$apiPath = 'v2/auth/r/ext/deposit/new';

$nonce = (string) (time() * 1000 * 1000); // epoch in ms * 1000
$body = [
//   'type' => 'LIMIT',
//   'symbol' => 'tBTCUSD',
//   'price' => '15',
//   'amount' => '0.1',
];
$bodyJson = json_encode($body, JSON_UNESCAPED_SLASHES);

$sigPayload = "/api/{$apiPath}{$nonce}{$bodyJson}";
$sig = hash_hmac('sha384', $sigPayload, $apiSecret);

$headers = [
  'Content-Type' => 'application/json',
  'Accept' => 'application/json',
  'bfx-nonce' => $nonce,
  'bfx-apikey' => $apiKey,
  'bfx-signature' => $sig,
];

try {
  $r = $client->post($apiPath, [
    'headers' => $headers,
    'body' => '{"amount":"2.5","currency":"USD","payCurrencies":["BTC","ETH"],"duration":900,"webhook":"https://example.com/api/v3/order/order123","redirectUrl":"ttps://example.com/checkout/order123","customerInfo":{"nationality":"GB","residCountry":"DE"}}',
  ]);
  $response = $r->getBody()->getContents();
  print_r(json_decode($response));
} catch (\Throwable $ex) {
  print_r($ex->getMessage());
}
?>


<!-- JAVASCRIPT -->
<script src="/js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/simplebar.min.js"></script>
<script src="js/waves.min.js"></script>
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>

<script src="/js/bootstrap-toasts.init.js"></script>
<script src="/js/sweetalert2.min.js"></script>

<!-- apexcharts -->
<script src="js/apexcharts.min.js"></script>

<script src="js/dashboard.init.js"></script>

<!-- App js -->
<script src="js/app.js"></script>