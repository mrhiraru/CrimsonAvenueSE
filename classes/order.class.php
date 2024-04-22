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
    public $payment_method;
    public $fulfillment_method;
    public $quantity;
    public $order_status;
    public $is_deleted;
    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO orders (order_id, account_id, store_id, product_total, commission_total, delivery_charge, order_status, fulfillment_method, payment_method ) VALUES (:order_id, :account_id, :store_id, :product_total, :commission_total, :delivery_charge, :order_status, :fulfillment_method, :payment_method)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':order_id', $this->order_id);
        $query->bindParam(':account_id', $this->account_id);
        $query->bindParam(':store_id', $this->store_id);
        $query->bindParam(':product_total', $this->product_total);
        $query->bindParam(':commission_total', $this->commission_total);
        $query->bindParam(':delivery_charge', $this->delivery_charge);
        $query->bindParam(':order_status', $this->order_status);
        $query->bindParam(':fulfillment_method', $this->fulfillment_method);
        $query->bindParam(':payment_method', $this->payment_method);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function add_items()
    {
        $sql = "INSERT INTO order_item (order_id, product_id, variation_id, measurement_id, selling_price, commission, quantity) VALUES (:order_id, :product_id, :variation_id, :measurement_id, :selling_price, :commission, :quantity)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':order_id', $this->order_id);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':selling_price', $this->selling_price);
        $query->bindParam(':commission', $this->commission);
        $query->bindParam(':quantity', $this->quantity);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
