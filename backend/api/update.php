<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once '../config/database.php';

    include_once '../class/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Product($db);

    $data = json_decode(file_get_contents('php://input'));

    $item->id_product = $data->id_product;

    $item->sku = $data->sku;
    $item->name = $data->name;
    $item->price = $data->price;
    $item->type = $data->type;
    $item->value = $data->value;

    if ($item->updateProduct()) {
        echo json_encode('Employee data updated.');
    } else {
        echo json_encode('Data could not be updated');
    }
