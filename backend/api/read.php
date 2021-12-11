<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');

    include_once '../config/database.php';

    include_once '../class/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Product($db);

    $stmt = $items->getProduct();
    $itemCount = $stmt->rowCount();

    // echo json_encode($itemCount);

    if ($itemCount > 0) {
        $employeeArr = [];
        $employeeArr['body'] = [];
        $employeeArr['itemCount'] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $e = [
                'id_product' => $id_product,
                'sku' => $sku,
                'name' => $name,
                'price' => $price,
                'type' => $type,
                'value' => $value,
            ];

            array_push($employeeArr['body'], $e);
        }
        echo json_encode($employeeArr);
    } else {
        http_response_code(404);
        echo json_encode(
            ['message' => 'No record found.']
        );
    }
