<?php
require_once("../classes/database.php");

class Stock
{
    public $stock_id;
    public $product_id;
    public $variation_id;
    public $measurement_id;
    public $stock_quantity;
    public $stock_allocated;
    public $purchase_price;
    public $selling_price;
    public $commission;
    public $is_created;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO stock (product_id, variation_id, measurement_id, stock_quantity, purchase_price, selling_price, commission) VALUES (:product_id, :variation_id, :measurement_id, :stock_quantity, :purchase_price, :selling_price, :commission)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':stock_quantity', $this->stock_quantity);
        $query->bindParam(':purchase_price', $this->purchase_price);
        $query->bindParam(':selling_price', $this->selling_price);
        $query->bindParam(':commission', $this->commission);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE stock SET stock_quantity=:stock_quantity, purchase_price=:purchase_price, selling_price=:selling_price, commission=:commission WHERE stock_id = :stock_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':stock_id', $this->stock_id);
        $query->bindParam(':stock_quantity', $this->stock_quantity);
        $query->bindParam(':purchase_price', $this->purchase_price);
        $query->bindParam(':selling_price', $this->selling_price);
        $query->bindParam(':commission', $this->commission);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($product_id, $variation_id, $measurement_id)
    {
        $sql = "SELECT * FROM stock WHERE product_id = :product_id AND variation_id = :variation_id AND measurement_id = :measurement_id AND is_deleted != 1 ORDER BY CASE WHEN stock_quantity - stock_allocated = 0 THEN 1 ELSE 0 END ASC, stock_id ASC;";
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

    function price_add()
    {
        $sql = "INSERT INTO prices (product_id, variation_id, measurement_id, purchase_price, selling_price, commission) VALUES (:product_id, :variation_id, :measurement_id, :purchase_price, :selling_price, :commission)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':purchase_price', $this->purchase_price);
        $query->bindParam(':selling_price', $this->selling_price);
        $query->bindParam(':commission', $this->commission);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function price_edit($price_id)
    {
        $sql = "UPDATE prices SET purchase_price=:purchase_price, selling_price=:selling_price, commission=:commission WHERE price_id = :price_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':price_id', $price_id);
        $query->bindParam(':purchase_price', $this->purchase_price);
        $query->bindParam(':selling_price', $this->selling_price);
        $query->bindParam(':commission', $this->commission);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function price_fetch($variation_id, $measurement_id, $product_id)
    {
        $sql = "SELECT * FROM prices WHERE variation_id = :variation_id AND measurement_id = :measurement_id AND product_id = :product_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':variation_id', $variation_id);
        $query->bindParam(':measurement_id', $measurement_id);
        $query->bindParam(':product_id', $product_id);
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

    function show_stock($product_id, $variation_id, $measurement_id)
    {
        $sql = "SELECT *, stock_quantity AS total_stock_quantity, stock_allocated AS total_stock_allocated FROM stock WHERE product_id = :product_id AND variation_id = :variation_id AND measurement_id = :measurement_id AND is_deleted != 1 AND stock_allocated < stock_quantity ORDER BY stock_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        $query->bindParam(':variation_id', $variation_id);
        $query->bindParam(':measurement_id', $measurement_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function take_stock()
    {
        $sql = "UPDATE stock SET stock_allocated = (stock_allocated + :stock_allocated) WHERE stock_id = :stock_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':stock_id', $this->stock_id);
        $query->bindParam(':stock_allocated', $this->stock_allocated);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function return_stock()
    {
        $sql = "UPDATE stock SET stock_allocated = (stock_allocated - :stock_allocated) WHERE stock_id = :stock_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':stock_id', $this->stock_id);
        $query->bindParam(':stock_allocated', $this->stock_allocated);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
