<?php
use Nusagate\Nusagate;
require 'vendor/autoload.php';

// params : is_production, api_key, secret_key
$nusagate = new Nusagate(true, 'YOUR_API_KEY','YOUR_SECRET_KEY');

$void_invoice = $nusagate->voidInvoice("2b12b24d-4b7f-4d1f-b297-a4303a51edf8");