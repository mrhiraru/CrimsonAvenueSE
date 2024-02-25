<?php
require_once("../classes/database.php");

class Measurement
{
    public $measurement_id;
    public $product_id;
    public $measurement_name;
    public $value_unit;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO measurement (product_id, measurement_name, value_unit) VALUES (:product_id, :measurement_name, :value_unit)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':measurement_name', $this->measurement_name);
        $query->bindParam(':value_unit', $this->value_unit);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE measurement SET measurement_name=:measurement_name, value_unit=:value_unit measurement_id = :measurement_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':measurement_id', $this->measurement_id);
        $query->bindParam(':measurement_name', $this->measurement_name);
        $query->bindParam(':value_unit', $this->value_unit);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($product_id)
    {
        $sql = "SELECT * FROM measurement WHERE product_id = :product_id AND is_deleted != 1 ORDER BY measurement_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($measurement_id)
    {
        $sql = "SELECT * FROM measurement WHERE measurement_id = :measurement_id LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':measurement_id', $measurement_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE measurement SET is_deleted=:is_deleted WHERE measurement_id = :measurement_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':measurement_id', $this->measurement_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
