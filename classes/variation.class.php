<?php
require_once("../classes/database.php");

class Variation
{
    public $variation_id;
    public $product_id;
    public $variation_name;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO variation (product_id, variation_name) VALUES (:product_id, :variation_name)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':variation_name', $this->variation_name);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE variation SET variation_name=:variation_name WHERE variation_id = :variation_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':variation_id', $this->variation_id);
        $query->bindParam(':variation_name', $this->variation_name);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($product_id)
    {
        $sql = "SELECT * FROM variation WHERE product_id = :product_id AND is_deleted != 1 ORDER BY variation_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($variation_id)
    {
        $sql = "SELECT * FROM variation WHERE variation_id = :variation_id LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':variation_id', $variation_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE variation SET is_deleted=:is_deleted WHERE variation_id = :variation_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':variation_id', $this->variation_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
