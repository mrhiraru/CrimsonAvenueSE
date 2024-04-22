<?php
require_once("../classes/database.php");

class Order
{
    public $order_id;
    public $order_item_id;
    public $account_id;
    public $store_id;
    public $product_id;
    public $variation_id;
    public $measurement_id;
    public $selling_price;
    public $commission;
    public $product_total;
    public $commission_total;
    public $delivery_charge;
    public $is_deleted;
    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO orders (account_id, store_id, product_id, variation_id, measurement_id, product_total, commission_total, delivery_charge) VALUES (:account_id, :store_id, :product_id, :variation_id, :measurement_id, :product_total, :commission_total, :delivery_charge)";
        
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $this->account_id);
        $query->bindParam(':store_id', $this->store_id);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':product_total', $this->product_total);
        $query->bindParam(':commission_total', $this->commission_total);
        $query->bindParam(':delivery_charge', $this->delivery_charge);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
