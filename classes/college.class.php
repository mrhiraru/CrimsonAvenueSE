<?php
require_once("../classes/database.php");

class College
{
    public $college_id;
    public $college_name;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO college (college_name) VALUES (:college_name)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_name', $this->college_name);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE college SET college_name=:college_name WHERE college_id = :college_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_name', $this->college_name);
        $query->bindParam(':college_id', $this->college_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function fetch($college_id)
    {
        $sql = "SELECT * FROM college WHERE college_id = :college_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $college_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function show()
    {
        // Note: Update query to count stores per college!
        $sql = "SELECT c.*, COUNT(d.college_id) as dept_count FROM college c LEFT JOIN department d ON c.college_id = d.college_id AND d.is_deleted != 1 WHERE c.is_deleted != 1 GROUP BY c.college_id ORDER BY c.college_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE college SET is_deleted=:is_deleted WHERE college_id = :college_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':college_id', $this->college_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
