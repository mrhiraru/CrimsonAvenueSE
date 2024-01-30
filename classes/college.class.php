<?php
require_once("../classes/database.php");

class College
{
    public $college_id;
    public $college_name;

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


}