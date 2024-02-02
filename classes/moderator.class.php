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

    function edit()
    {
        $sql = "UPDATE moderator SET account_id=:account_id, college_id=:college_id WHERE moderator_id = :moderator_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $this->account_id);
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':moderator_id', $this->moderator_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function fetch($moderator_id)
    {
        $sql = "SELECT m.*, a.firstname, a.middlename, a.lastname, c.college_name FROM moderator m JOIN college c ON m.college_id = c.college_id JOIN account a ON m.account_id = a.account_id WHERE moderator_id = :moderator_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':moderator_id', $moderator_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function show_assigned()
    {
        $sql = "SELECT m.*, a.firstname, a.middlename, a.lastname, c.college_name FROM moderator m INNER JOIN account a ON m.account_id = a.account_id AND a.is_deleted != 1 INNER JOIN college c ON m.college_id = c.college_id AND c.is_deleted != 1 WHERE m.is_deleted != 1 ORDER BY m.moderator_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_unassigned()
    {
        $sql = "SELECT * FROM account WHERE is_deleted != 1 AND user_role = 1 AND NOT EXISTS ( SELECT 1 FROM moderator WHERE moderator.account_id = account.account_id ) ORDER BY account_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete($moderator_id){
        $sql = "DELETE FROM moderator WHERE moderator_id = :moderator_id ;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':moderator_id', $moderator_id);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
