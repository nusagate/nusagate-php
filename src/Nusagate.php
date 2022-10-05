<?php

namespace App;
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class Nusagate {
  public function __construct(bool $is_production, string $api_key, string $secret_key)
  {
    $this->is_production = $is_production;
    $this->api_key = $api_key;
    $this->secret_key = $secret_key;
  }

  private function getBaseUrl() 
  {
    if ($this->is_production) {
      return "https://api.nusagate.com";
    }
    return "https://api.sandbox.nusagate.com";
  }

  function createInvoice($data) 
  {
    $client = new Client();
    $req_body = [
      'externalId' => $data['external_id'],
      'description' => array_key_exists('description', $data) ? $data['description'] : '',
      'price' => $data['price'],
      'dueDate' => $data['due_date'],
      'email' => $data['email'],
      'phoneNumber' => $data['phone_number'],
    ];
    $headers = ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)];
    $response = $client->request('POST', $this->getBaseUrl() . '/v1/invoices/', [
      'headers' => $headers,
      'form_params' => $req_body
    ]);

    return $response->getBody()->getContents();
  }

  function getInvoices($query = [])
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );

    $page = $query['page'] ?? '';
    $perPage = $query['perPage'] ?? '';
    $status = $query['status'] ?? '';
    $fromDate = $query['fromDate'] ?? '';
    $toDate = $query['toDate'] ?? '';
    $orderBy = $query['orderBy'] ?? '';
    $sortBy = $query['sortBy'] ?? '';
    $search = $query['search'] ?? '';
    
    $response = $client->request('GET', $this->getBaseUrl() . '/v1/invoices' . '?page=' . $page . '&perPage=' . $perPage . '&status=' . $status . '&orderBy=' . $orderBy . '&sortBy=' . $sortBy . '&search=' . $search );

    return $response->getBody()->getContents();
  }

  function getInvoiceById() 
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );
    $response = $client->request('GET', $this->getBaseUrl() . '/v1/invoices/' . $id);

    return $response->getBody()->getContents();
  }

  function voidInvoice($id) 
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );
    $response = $client->request('POST', $this->getBaseUrl() . '/v1/invoices/' . $id . '/void');

    return $response->getBody()->getContents();
  }

  function availableCurrency() 
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );
    $response = $client->request('GET', $this->getBaseUrl() . '/v1/invoices/available-currency');

    return $response->getBody()->getContents();
  }

   function estimateAmount() 
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );
    $req_body = [
      'price' => $data['price'],
    ];
    $response = $client->request('POST', $this->getBaseUrl() . '/v1/invoices/estimate-amount', [
      'form_params' => $req_body
    ]);

    return $response->getBody()->getContents();
  }

  function createTransfer($data) 
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );

    $req_body = [
        'externalId' => $data['externalId'],
        'address' => $data['address'],
        'amount' => $data['amount'],
        'currencyCode' => $data['currencyCode'],
      ];
    
    $response = $client->request('POST', $this->getBaseUrl() . '/v1/merchant-transfers/', [
      'form_params' => $req_body
    ]);

    return $response->getBody()->getContents();
  }

  function calculateTransfer($data)
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );

    $req_body = [
      'address' => $data['address'],
      'amount' => floatval($data['amount']), 
      'currencyCode' => $data['currency_code'],
    ];
    var_dump($req_body);
    $response = $client->request('POST', $this->getBaseUrl() . '/v1/merchant-transfers/calculate', [
      'form_params' => $req_body
    ]);

    return $response->getBody()->getContents();
  }

  function getTransfers($query = []) 
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );

    $page = $query['page'] ?? '';
    $perPage = $query['perPage'] ?? '';
    $status = $query['status'] ?? '';
    $fromDate = $query['fromDate'] ?? '';
    $toDate = $query['toDate'] ?? '';
    
    $response = $client->request('GET', $this->getBaseUrl() . '/v1/merchant-transfers' . '?page=' . $page . '&perPage=' . $perPage . '&status=' . $status);

    return $response->getBody()->getContents();
  }

  function getTransferById()
  {
    $client = new Client(
      ['headers' => ['Authorization' => 'Basic ' . base64_encode($this->api_key . ':' . $this->secret_key)]]
    );
    $response = $client->request('GET', $this->getBaseUrl() . '/v1/merchant-transfers/' . $id);

    return $response->getBody()->getContents();
  }
}