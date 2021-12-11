<?php

class Product
{
    // Columns
    public $id_product;
    public $sku;
    public $name;
    public $price;
    public $type;
    public $value;

    // Connection
    private $conn;

    // Table
    private $db_table = 'product';

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getProduct()
    {
        $sqlQuery = 'SELECT id_product, sku, name, price, type, value FROM '.$this->db_table.'';
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();

        return $stmt;
    }

    // CREATE
    public function createProduct()
    {
        $sqlQuery = 'INSERT INTO
                        '.$this->db_table.'
                    SET
                        sku = :sku, 
                        name = :name, 
                        price = :price, 
                        type = :type,
                        value = :value';

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->value = htmlspecialchars(strip_tags($this->value));

        // bind data
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':value', $this->value);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // UPDATE
    public function getSingleProduct()
    {
        $sqlQuery = 'SELECT
                        id_product, 
                        sku, 
                        name, 
                        price, 
                        type,
                        value
                      FROM
                        '.$this->db_table.'
                    WHERE 
                       id_product = ?
                    LIMIT 0,1';

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id_product);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->sku = $dataRow['sku'];
        $this->name = $dataRow['name'];
        $this->price = $dataRow['price'];
        $this->type = $dataRow['type'];
        $this->value = $dataRow['value'];
    }

    // UPDATE
    public function updateProduct()
    {
        $sqlQuery = 'UPDATE
                        '.$this->db_table.'
                    SET
                        sku = :sku, 
                        name = :name, 
                        price = :price, 
                        type = :type,
                        value = :value
                    WHERE 
                        id_product = :id_product';

        $stmt = $this->conn->prepare($sqlQuery);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->value = htmlspecialchars(strip_tags($this->value));
        $this->id_product = htmlspecialchars(strip_tags($this->id_product));

        // bind data
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':value', $this->value);
        $stmt->bindParam(':id_product', $this->id_product);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // DELETE
    public function deleteProduct()
    {
        $sqlQuery = 'DELETE FROM '.$this->db_table.' WHERE id_product = ?';
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id_product = htmlspecialchars(strip_tags($this->id_product));

        $stmt->bindParam(1, $this->id_product);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deleteMassProduct()
    {
        $this->id_product = $this->id_product;

        $id_list = '('.join(', ', $this->id_product).')';

        $sqlQuery = 'DELETE FROM '.$this->db_table.' WHERE `id_product` IN '.$id_list;
        $stmt = $this->conn->query($sqlQuery);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
