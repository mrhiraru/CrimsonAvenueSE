<?php
require_once("../classes/database.php");

class Product
{
    public $product_id;
    public $store_id;
    public $category_id;
    public $product_name;
    public $exclusivity;
    public $sale_status;
    public $restriction_status;
    public $order_quantity_limit;
    public $estimated_order_time;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $connect = $this->db->connect();
        $connect->beginTransaction();

        $sql = "INSERT INTO product (store_id, category_id, product_name, exclusivity, sale_status) VALUES (:store_id, :category_id, :product_name, :exclusivity, :sale_status)";

        $query = $connect->prepare($sql);
        $query->bindParam(':store_id', $this->store_id);
        $query->bindParam(':product_name', $this->product_name);
        $query->bindParam(':category_id', $this->category_id);
        $query->bindParam(':exclusivity', $this->exclusivity);
        $query->bindParam(':sale_status', $this->sale_status);

        if ($query->execute()) {
            $last_product_id = $connect->lastInsertId();

            $sec_sql = "INSERT INTO variation (product_id, variation_name) VALUES (:product_id, :variation_name)";

            $sec_query = $connect->prepare($sec_sql);
            $sec_query->bindParam(':product_id', $last_product_id);
            $sec_query->bindValue(':variation_name', 'Default');

            $thi_sql = "INSERT INTO measurement (product_id, measurement_name) VALUES (:product_id, :measurement_name)";

            $thi_query = $connect->prepare($thi_sql);
            $thi_query->bindParam(':product_id', $last_product_id);
            $thi_query->bindValue(':measurement_name', 'Default');

            if ($sec_query->execute() && $thi_query->execute()) {
                $connect->commit();
                return true;
            } else {
                $connect->rollBack();
                return false;
            }
        } else {
            $connect->rollBack();
            return false;
        }
    }

    function show($store_id)
    {
        $sql = "SELECT p.*, c.category_name FROM product p INNER JOIN category c ON p.category_id = c.category_id AND c.is_deleted != 1 WHERE p.store_id = :store_id AND p.is_deleted != 1 ORDER BY p.product_id ASC";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
