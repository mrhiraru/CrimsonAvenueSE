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
}
