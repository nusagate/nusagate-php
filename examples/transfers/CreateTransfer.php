<?php
use Nusagate\Nusagate;
require 'vendor/autoload.php';

// params : is_production, api_key, secret_key
$nusagate = new Nusagate(true, 'YOUR_API_KEY','YOUR_SECRET_KEY');

$payload_transfer = array(
      'external_id' => "TF-ACIKIWIR-000002",
      'address' => 'TAUsbjxk...',
      'amount' => 50,
      'currency_code' => 'TRX',
    );

$create_transfer = $nusagate->createTransfer($payload_transfer);