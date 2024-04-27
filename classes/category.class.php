<?php
require_once("../classes/database.php");

class Category
{
    public $category_id;
    public $category_name;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO category (category_name) VALUES (:category_name)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':category_name', $this->category_name);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE category SET category_name=:category_name WHERE category_id = :category_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':category_name', $this->category_name);
        $query->bindParam(':category_id', $this->category_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show()
    {
        $sql = "SELECT * FROM category WHERE is_deleted != 1 AND is_created < (SELECT end_date FROM semester WHERE view_status = 'Active') ORDER BY category_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($category_id)
    {
        $sql = "SELECT * FROM category WHERE category_id = :category_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':category_id', $category_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE category SET is_deleted=:is_deleted WHERE category_id = :category_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':category_id', $this->category_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function count()
    {
        // Note: Update query to count stores per college!
        $sql = "SELECT COUNT(category_id) AS category_count FROM category WHERE is_deleted != 1 AND is_created <= (SELECT end_date FROM semester WHERE view_status = 'Active')";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    
}
