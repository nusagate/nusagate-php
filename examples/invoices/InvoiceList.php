<?php
use Nusagate\Nusagate;
require 'vendor/autoload.php';

// params : is_production, api_key, secret_key
$nusagate = new Nusagate(true, 'YOUR_API_KEY','YOUR_SECRET_KEY');

$query = array(
      'page' => 1,
      'per_page' => 2,
      'status' => '',
      'from_date' => '',
      'to_date' => ''
    );
$invoice_list = $nusagate->getInvoices($query);