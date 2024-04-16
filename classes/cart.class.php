<?php
require_once("../classes/database.php");

class Cart
{
    public $cart_id;
    public $account_id;
    public $product_id;
    public $variation_id;
    public $measurement_id;
    public $quantity;
    public $selling_price;
    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO cart_item (cart_id, product_id, variation_id, measurement_id, quantity, selling_price) VALUES (:cart_id, :product_id, :variation_id, :measurement_id, :quantity, :selling_price)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':cart_id', $this->cart_id);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':quantity', $this->quantity);
        $query->bindParam(':selling_price', $this->selling_price);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($cart_id)
    {
        $sql = "SELECT ci.*, p.product_name, s.store_name, s.store_id, v.variation_name, m.measurement_name, i.image_file
        FROM cart_item ci 
        INNER JOIN product p ON p.product_id = ci.product_id AND p.is_deleted != 1 
        INNER JOIN store s ON s.store_id = p.store_id AND s.is_deleted != 1
        INNER JOIN variation v ON v.variation_id = ci.variation_id AND v.is_deleted != 1
        INNER JOIN measurement m ON m.measurement_id = ci.measurement_id AND m.is_deleted != 1
        LEFT JOIN (SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id 
        WHERE ci.cart_id = :cart_id AND ci.is_deleted != 1 ORDER BY s.store_id ASC, p.product_id ASC";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':cart_id', $cart_id);

        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
