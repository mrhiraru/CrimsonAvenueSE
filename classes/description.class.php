<?php
require_once("../classes/database.php");

class Description
{
    public $desc_id;
    public $product_id;
    public $desc_label;
    public $desc_value;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO product_desc (product_id, desc_label, desc_value) VALUES (:product_id, :desc_label, :desc_value)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':desc_label', $this->desc_label);
        $query->bindParam(':desc_value', $this->desc_value);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE product_desc SET desc_label=:desc_label, desc_value=:desc_value WHERE desc_id = :desc_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':desc_id', $this->desc_id);
        $query->bindParam(':desc_label', $this->desc_label);
        $query->bindParam(':desc_value', $this->desc_value);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($product_id)
    {
        $sql = "SELECT * FROM product_desc WHERE product_id = :product_id ORDER BY desc_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($desc_id)
    {
        $sql = "SELECT * FROM product_desc WHERE desc_id = :desc_id  LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':desc_id', $desc_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function delete()
    {
        $sql = "DELETE FROM product_desc WHERE desc_id = :desc_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':desc_id', $this->desc_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
