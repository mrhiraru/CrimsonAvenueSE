<?php
require_once("../classes/database.php");

class Department
{
    public $department_id;
    public $college_id;
    public $department_name;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO department (college_id, department_name) VALUES (:college_id, :department_name)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':department_name', $this->department_name);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE department SET college_id=:college_id, department_name=:department_name WHERE department_id = :department_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':department_name', $this->department_name);
        $query->bindParam(':department_id', $this->department_id);
        $query->bindParam(':college_id', $this->college_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show()
    {
        $sql = "SELECT d.*, c.college_name FROM department d JOIN college c ON d.college_id = c.college_id WHERE d.is_deleted != 1 AND c.is_deleted != 1 ORDER BY d.department_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($department_id)
    {
        $sql = "SELECT d.*, c.college_name FROM department d JOIN college c ON d.college_id = c.college_id WHERE department_id = :department_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':department_id', $department_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE department SET is_deleted=:is_deleted WHERE department_id = :department_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':department_id', $this->department_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
