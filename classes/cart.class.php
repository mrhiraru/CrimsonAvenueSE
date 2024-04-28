<?php
require_once("../classes/database.php");

class Cart
{
    public $cart_id;
    public $cart_item_id;
    public $account_id;
    public $product_id;
    public $variation_id;
    public $measurement_id;
    public $stock_id;
    public $quantity;
    public $is_deleted;
    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO cart_item (cart_id, product_id, variation_id, measurement_id, stock_id, quantity) VALUES (:cart_id, :product_id, :variation_id, :measurement_id, :stock_id, :quantity)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':cart_id', $this->cart_id);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':stock_id', $this->stock_id);
        $query->bindParam(':quantity', $this->quantity);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($cart_id)
    {
        $sql = "SELECT ci.*, p.product_name, p.sale_status, s.store_name, s.store_id, v.variation_name, m.measurement_name, i.image_file, p.selling_price AS product_selling_price, p.commission AS product_commission, st.selling_price AS stock_selling_price, st.commission AS stock_commission, pr.*, pr.selling_price AS prices_selling_price, pr.commission AS prices_commission
        FROM cart_item ci 
        INNER JOIN product p ON p.product_id = ci.product_id AND p.is_deleted != 1 
        INNER JOIN store s ON s.store_id = p.store_id AND s.is_deleted != 1
        INNER JOIN variation v ON v.variation_id = ci.variation_id AND v.is_deleted != 1
        INNER JOIN measurement m ON m.measurement_id = ci.measurement_id AND m.is_deleted != 1
        LEFT JOIN (SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id 
        LEFT JOIN (SELECT * FROM stock WHERE is_deleted != 1 ORDER BY stock_id ASC) st ON ci.stock_id = st.stock_id
        LEFT JOIN (SELECT * FROM prices WHERE is_deleted != 1) pr ON ci.product_id = pr.product_id AND ci.variation_id = pr.variation_id AND ci.measurement_id = pr.measurement_id
        WHERE ci.cart_id = :cart_id AND ci.is_deleted != 1 ORDER BY s.store_id ASC, p.product_id ASC";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':cart_id', $cart_id);

        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE cart_item SET is_deleted = :is_deleted WHERE cart_item_id = :cart_item_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':cart_item_id', $this->cart_item_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function fetch_checkout($cart_item_ids)
    {
        $ids = explode(",", $cart_item_ids);

        $ids = array_map('intval', $ids);

        $sql = "SELECT ci.*, ci.product_id AS cart_product_id, ci.variation_id AS cart_variation_id, ci.measurement_id AS cart_measurement_id, s.delivery_charge, s.store_id, p.product_name, p.sale_status, p.discount_amount, p.discount_type, v.variation_name, m.measurement_name, i.image_file, p.selling_price AS product_selling_price, p.commission AS product_commission, st.selling_price AS stock_selling_price, st.commission AS stock_commission, pr.*, pr.selling_price AS prices_selling_price, pr.commission AS prices_commission
        FROM cart_item ci
        INNER JOIN product p ON ci.product_id = p.product_id AND p.is_deleted  != 1
        INNER JOIN variation v ON ci.variation_id = v.variation_id AND v.is_deleted != 1
        INNER JOIN measurement m ON ci.measurement_id = m.measurement_id AND m.is_deleted != 1
        INNER JOIN store s ON p.store_id = s.store_id AND m.is_deleted != 1
        LEFT JOIN (SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id
        LEFT JOIN (SELECT * FROM stock WHERE is_deleted != 1 ORDER BY stock_id ASC) st ON ci.stock_id = st.stock_id
        LEFT JOIN (SELECT * FROM prices WHERE is_deleted != 1) pr ON p.product_id = pr.product_id AND pr.product_id = p.product_id AND pr.variation_id = v.variation_id AND pr.measurement_id = m.measurement_id
        WHERE cart_item_id IN (" . implode(',', $ids) . ") AND ci.is_deleted != 1";

        $query = $this->db->connect()->prepare($sql);

        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
