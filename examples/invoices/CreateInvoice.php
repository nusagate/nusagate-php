<?php
use Nusagate\Nusagate;
require 'vendor/autoload.php';

// params : is_production, api_key, secret_key
$nusagate = new Nusagate(true, 'YOUR_API_KEY','YOUR_SECRET_KEY');

$payload_invoice = array(
      'external_id' => "ACIKIWIR-000002",
      'price' => 120,
      'due_date' => '2022-10-24T19:26:07.255Z',
      'email' => 'customer@email.com',
      'phone_number' => '6281...', // not required
    );

$create_invoice = $nusagate->createInvoice($payload_invoice);