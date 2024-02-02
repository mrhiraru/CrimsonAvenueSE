<?php
require_once("../classes/database.php");

class Moderator
{
    public $moderator_id;
    public $account_id;
    public $college_id;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO moderator (college_id, account_id) VALUES (:college_id, :account_id)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':account_id', $this->account_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function fetch($moderator_id)
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
        $sql = "SELECT  FROM college c LEFT JOIN department d ON c.college_id = d.college_id AND d.is_deleted != 1 WHERE c.is_deleted != 1 GROUP BY c.college_id ORDER BY c.college_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_mod()
    {
        $sql = "SELECT * FROM account WHERE is_deleted != 1 AND user_role = 1 ORDER BY account_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
