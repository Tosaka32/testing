<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://example.com/api/stocks');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, 'username:password');
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
if ('stocks' === array_keys($data)[0] && count($data['stocks'])) {
foreach ($data['stocks'] as $stock) {
if ('uuid' === key($stock) && 'quantity' === key($stock)) {
$result = [
'id' => $stock['uuid'],
'quantity' => $stock['quantity'],
]
;if (!array_key_exists($result['id'], $stock_counts)) {
    $stock_counts[$result['id']] = 1;
    } else {
    $stock_counts[$result['id']]++;
    }
    }
    }
    $result['stock_counts'] = $stock_counts;
    } else {
    $total_quantity = isset($data['total_quantity']) ? $data['total_quantity'] : 0;
    $result = ['total_quantity' => $total_quantity];
    }
    echo json_encode($result);
    