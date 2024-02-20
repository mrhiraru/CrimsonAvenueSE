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
        $sql = "INSERT INTO product (store_id, category_id, product_name, exclusivity, sale_status) VALUES (:store_id, :category_id, :product_name, :exclusivity, :sale_status,)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $this->store_id);
        $query->bindParam(':product_name', $this->product_name);
        $query->bindParam(':category_id', $this->category_id);
        $query->bindParam(':exclusivity', $this->exclusivity);
        $query->bindParam(':sale_status', $this->sale_status);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
