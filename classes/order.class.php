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

    function show_order_ready_pickup($store_id)
    {
        $sql = "SELECT o.*, o.is_created AS order_date, s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.store_id = :store_id AND o.order_status = 'Ready' AND o.fulfillment_method = 'Pickup' ORDER BY order_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function show_order_ready_deliver($store_id)
    {
        $sql = "SELECT o.*, o.is_created AS order_date, s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.store_id = :store_id AND o.order_status = 'Ready' AND o.fulfillment_method = 'Delivery' ORDER BY order_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function show_order_completed_pickedup($store_id)
    {
        $sql = "SELECT o.*, o.is_created AS order_date, s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.store_id = :store_id AND o.order_status = 'Completed' AND o.fulfillment_method = 'Pickup' ORDER BY order_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function show_order_completed_delivered($store_id)
    {
        $sql = "SELECT o.*, o.is_created AS order_date, s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.store_id = :store_id AND o.order_status = 'Completed' AND o.fulfillment_method = 'Delivery' ORDER BY order_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function show_order_pending($store_id)
    {
        $sql = "SELECT o.*, o.is_created AS order_date, s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.store_id = :store_id AND o.order_status = 'Pending' ORDER BY order_id ASC;
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function show_order_processing($store_id)
    {
        $sql = "SELECT o.*, o.is_created AS order_date,  s.store_name, a.*
        FROM orders o
        INNER JOIN store s ON o.store_id = s.store_id
        INNER JOIN account a ON o.account_id = a.account_id
        WHERE o.store_id = :store_id AND o.order_status = 'Processing' ORDER BY order_id ASC;
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
    function count($store_id)
    {
        $sql = "SELECT COUNT(order_id) AS order_count FROM orders WHERE store_id = :store_id AND order_status != 'Completed'";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchColumn();
        }
        return $data;
    }
    function count_solds($store_id)
    {
        $sql = "SELECT COUNT(order_id) AS order_count FROM orders WHERE store_id = :store_id AND order_status = 'Completed'";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchColumn();
        }
        return $data;
    }

    function show_order_stat($store_id)
    {
        $sql = "SELECT * FROM orders WHERE store_id = :store_id AND (order_status = 'Completed' OR order_status = 'Pending') ORDER BY FIELD(commission_status, 'unpaid', 'paid')";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $query->execute();
        return $query->fetchAll();
    }


    function updateCommissionStatus($order_id, $commission_status)
    {
        $sql = "UPDATE orders SET commission_status = :commission_status WHERE order_id = :order_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':commission_status', $commission_status);
        $query->bindParam(':order_id', $order_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function get_order_by_id($order_id)
    {
        $sql = "SELECT * FROM orders WHERE order_id = :order_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':order_id', $order_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetch(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    function updateCommissionStatusForCompletedOrders()
    {
        $sql = "UPDATE orders SET commission_status = 'Paid' WHERE order_status = 'Completed'";

        $query = $this->db->connect()->prepare($sql);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function countPendingOrdersForStore($store_id)
    {
        $sql = "SELECT COUNT(*) AS pending_count 
                FROM orders 
                WHERE order_status = 'Pending' 
                AND store_id = :store_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return isset($result['pending_count']) ? $result['pending_count'] : 0;
    }

    function store_sales_days($store_id)
    {
        $sql = "SELECT o.is_created AS sales_date, SUM(oi.selling_price) AS revenue, SUM(oi.commission) AS commission
        FROM orders o
        INNER JOIN (SELECT * FROM order_item) oi ON o.order_id = oi.order_id
        INNER JOIN product p ON oi.product_id = p.product_id 
        WHERE o.store_id = :store_id GROUP BY DATE(o.is_created) DESC";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function store_sales_month($store_id)
    {
        $sql = "SELECT o.is_created AS sales_date, SUM(oi.selling_price) AS revenue, SUM(oi.commission) AS commission
        FROM orders o
        INNER JOIN (SELECT * FROM order_item) oi ON o.order_id = oi.order_id
        INNER JOIN product p ON oi.product_id = p.product_id 
        WHERE o.store_id = :store_id GROUP BY YEAR(o.is_created) DESC, MONTH(o.is_created) DESC";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function store_sales_year($store_id)
    {
        $sql = "SELECT o.is_created AS sales_date, SUM(oi.selling_price) AS revenue, SUM(oi.commission) AS commission
        FROM orders o
        INNER JOIN (SELECT * FROM order_item) oi ON o.order_id = oi.order_id
        INNER JOIN product p ON oi.product_id = p.product_id 
        WHERE o.store_id = :store_id GROUP BY YEAR(o.is_created) DESC";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function calculateTotalCommission()
    {
        $sql = "SELECT SUM(commission_total) AS total_commission
                FROM orders
                WHERE commission_status = 'Paid'";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result !== false && isset($result['total_commission'])) {
            return $result['total_commission'];
        } else {
            return false;
        }
    }

    function calculateTotalCommission_mod($college_id)
    {
        $sql = "SELECT SUM(commission_total) AS total_commission
                FROM orders o
                INNER JOIN store s ON o.store_id = s.store_id
                WHERE commission_status = 'Paid' AND s.college_id = :college_id";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(':college_id', $college_id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result !== false && isset($result['total_commission'])) {
            return $result['total_commission'];
        } else {
            return false;
        }
    }
    function calculateTotalSales()
    {
        $sql = "SELECT SUM(oi.selling_price + oi.commission) AS total_sales
                FROM orders o
                INNER JOIN order_item oi ON o.order_id = oi.order_id
                WHERE o.order_status = 'Completed'";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {

            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['total_sales'];
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }


    function calculateTotalSales_mod($college_id)
    {
        $sql = "SELECT SUM(oi.selling_price + oi.commission) AS total_sales
                FROM orders o
                INNER JOIN order_item oi ON o.order_id = oi.order_id
                INNER JOIN store s ON o.store_id = s.store_id
                WHERE o.order_status = 'Completed' AND s.college_id = :college_id";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(':college_id', $college_id);
        if ($query->execute()) {

            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['total_sales'];
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

    function calculateTotalUnpaid()
    {
        $sql = "SELECT SUM(oi.commission) AS total_unpaid_commission
                FROM orders o
                INNER JOIN order_item oi ON o.order_id = oi.order_id
                WHERE o.commission_status = 'Unpaid'";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['total_unpaid_commission'];
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

    function calculateTotalUnpaid_mod($college_id)
    {
        $sql = "SELECT SUM(oi.commission) AS total_unpaid_commission
                FROM orders o
                INNER JOIN order_item oi ON o.order_id = oi.order_id
            
                INNER JOIN store s ON o.store_id = s.store_id
                WHERE o.commission_status = 'Unpaid' AND s.college_id = :college_id";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(':college_id', $college_id);
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['total_unpaid_commission'];
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

    function fetch_status($order_id)
    {
        $sql = "SELECT o.order_status, o.payment_method, o.fulfillment_method, s.store_name, s.delivery_charge FROM orders o
        INNER JOIN store s ON s.store_id = o.store_id
        WHERE order_id = :order_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':order_id', $order_id);

        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }
    function checkOrderStatusUpdateByAccount($account_id) {
        $sql = "SELECT order_status FROM orders WHERE account_id = :account_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $account_id, PDO::PARAM_INT);

        if ($query->execute()) {
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                foreach ($results as $result) {
                    if ($result['order_status'] !== 'Pending') {
                        return true;
                    }
                }
                return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function getOrdersByAccount($account_id) {
        $sql = "SELECT oi.product_id, p.product_name, s.store_name, o.order_status,  o.is_updated
                FROM orders o
                INNER JOIN store s ON o.store_id = s.store_id
                INNER JOIN order_item oi ON o.order_id = oi.order_id
                INNER JOIN product p ON oi.product_id = p.product_id
                WHERE o.account_id = :account_id
                ORDER BY o.is_updated DESC";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $account_id, PDO::PARAM_INT);

        if ($query->execute()) {
            $orders = $query->fetchAll(PDO::FETCH_ASSOC);
            return $orders;
        } else {
            return false;
        }
    }
  

}

