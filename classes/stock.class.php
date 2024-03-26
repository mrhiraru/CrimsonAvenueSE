<?php
require_once("../classes/database.php");

class Stock
{
    public $stock_id;
    public $product_id;
    public $variation_id;
    public $measurement_id;
    public $stock_quantity;
    public $stock_sold;
    public $purchase_price;
    public $selling_price;
    public $is_created;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO stock (product_id, variation_id, measurement_id, stock_quantity, purchase_price, selling_price) VALUES (:product_id, :variation_id, :measurement_id, :stock_quantity, :purchase_price, :selling_price)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':stock_quantity', $this->stock_quantity);
        $query->bindParam(':purchase_price', $this->purchase_price);
        $query->bindParam(':selling_price', $this->selling_price);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE stock SET stock_quantity=:stock_quantity, purchase_price=:purchase_price, selling_price=:selling_price WHERE stock_id = :stock_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':stock_id', $this->stock_id);
        $query->bindParam(':stock_quantity', $this->stock_quantity);
        $query->bindParam(':purchase_price', $this->purchase_price);
        $query->bindParam(':selling_price', $this->selling_price);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($product_id, $variation_id, $measurement_id)
    {
        $sql = "SELECT * FROM stock WHERE product_id = :product_id AND variation_id = :variation_id AND measurement_id = :measurement_id AND is_deleted != 1 ORDER BY stock_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        $query->bindParam(':variation_id', $variation_id);
        $query->bindParam(':measurement_id', $measurement_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($stock_id)
    {
        $sql = "SELECT * FROM stock WHERE stock_id = :stock_id LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':stock_id', $stock_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE stock SET is_deleted=:is_deleted WHERE stock_id = :stock_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':stock_id', $this->stock_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show_stock($product_id, $variation_id, $measurement_id){
        $sql = "SELECT * FROM stock WHERE stock_id = :stock_id LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        $query->bindParam(':variation_id', $variation_id);
        $query->bindParam(':measurement_id', $measurement_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }
}
