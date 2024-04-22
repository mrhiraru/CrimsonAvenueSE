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

    function show($account_id)
    {
        $sql = "SELECT o.*, s.store_name
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        WHERE o.account_id = :account_id ORDER BY order_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $account_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_order_store($store_id)
    {
        $sql = "SELECT o.*, s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.store_id = :store_id ORDER BY order_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_items($order_id)
    {
        $sql = "SELECT oi.*, oi.selling_price AS oi_selling_price, oi.commission AS oi_commission, p.*, v.*, m.*, i.*
        FROM order_item oi
        INNER JOIN product p ON oi.product_id = p.product_id
        INNER JOIN variation v ON oi.variation_id = v.variation_id
        INNER JOIN measurement m ON oi.measurement_id = m.measurement_id
        LEFT JOIN (SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id
        WHERE oi.order_id = :order_id AND oi.is_deleted != 1 ORDER BY order_item_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':order_id', $order_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch_order($order_id)
    {
        $sql = "SELECT o.*, s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.order_id = :order_id
        ";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':order_id', $order_id);

        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function update_status()
    {
        $sql = "UPDATE orders SET order_status = :order_status WHERE order_id = :order_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':order_status', $this->order_status);
        $query->bindParam(':order_id', $this->order_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function count($store_id) {
        $sql = "SELECT COUNT(order_id) AS order_count FROM orders WHERE store_id = :store_id AND order_status != 'Completed'";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchColumn();
        }
        return $data;
    }
    function count_solds($store_id) {
        $sql = "SELECT COUNT(order_id) AS order_count FROM orders WHERE store_id = :store_id AND order_status = 'Completed'";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchColumn();
        }
        return $data;
    }
    
}
