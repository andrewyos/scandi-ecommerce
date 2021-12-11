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

    $item->id = isset($_GET['id']) ? $_GET['id'] : exit();

    $item->getSingleProduct();

    if (null != $item->name) {
        // create array
        $emp_arr = [
            'id_product' => $item->id_product,
            'sku' => $item->sku,
            'name' => $item->name,
            'price' => $item->price,
            'type' => $item->type,
            'value' => $item->value,
        ];

        http_response_code(200);
        echo json_encode($emp_arr);
    } else {
        http_response_code(404);
        echo json_encode('Employee not found.');
    }
