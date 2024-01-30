<?php
require_once("../classes/database.php");

class Department
{
    public $department_id;
    public $college_id;
    public $department_name;

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
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':department_name', $this->department_name);
        $query->bindParam(':department_id', $this->college_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }


}