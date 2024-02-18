<?php
require_once("../classes/database.php");

class Store
{
    public $store_id;
    public $college_id;
    public $account_id;
    public $store_name;
    public $store_email;
    public $store_contact;
    public $store_location;
    public $store_bio;
    public $business_time;
    public $certificate;
    public $verification_status;
    public $restriction_status;
    public $is_created;
    public $is_deleted;
    public $staff_role;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function old_add()
    {
        $sql = "INSERT INTO store (store_name, college_id, account_id ,certificate, verification_status) VALUES (:store_name, :college_id, :account_id, :certificate, :verification_status);";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_name', $this->store_name);
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':account_id', $this->account_id);
        $query->bindParam(':certificate', $this->certificate);
        $query->bindParam(':verification_status', $this->verification_status);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function add()
    {
        $connect = $this->db->connect();
        $connect->beginTransaction();

        $sql = "INSERT INTO store (store_name, college_id ,certificate, verification_status) VALUES (:store_name, :college_id, :certificate, :verification_status);";

        $query = $connect->prepare($sql);
        $query->bindParam(':store_name', $this->store_name);
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':certificate', $this->certificate);
        $query->bindParam(':verification_status', $this->verification_status);

        if ($query->execute()) {
            $last_store_id = $connect->lastInsertId();

            $sub_sql = "INSERT INTO store_staff (account_id, store_id, staff_role) VALUES (:account_id, :store_id, :staff_role);";

            $sub_query = $connect->prepare($sub_sql);
            $sub_query->bindParam(':account_id', $this->account_id);
            $sub_query->bindParam(':store_id', $last_store_id);
            $sub_query->bindParam(':staff_role', $this->staff_role);

            if($sub_query->execute()) {
                $connect->commit();
                return true;
            } else {
                $connect->rollBack();
                return false;
            }
        } else {
            $connect->rollBack();
            return false;
        }
    }

    function show()
    {
        $sql = "SELECT s.*, a.firstname, a.middlename, a.lastname, c.college_name FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND staff_role = 0 LEFT JOIN account a ON ss.account_id = a.account_id AND a.is_deleted != 1 LEFT JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 WHERE s.is_deleted != 1 ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_mystores($account_id) {
        $sql = "SELECT s.*, ss.staff_role FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND ss.is_deleted != 1 WHERE ss.account_id = :account_id AND s.is_deleted != 1 ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $account_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($store_id)
    {
        $sql = "SELECT s.*, c.college_name, a.firstname, a.middlename, a.lastname FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND staff_role = 0 LEFT JOIN college c ON s.college_id = c.college_id LEFT JOIN account a ON ss.account_id = a.account_id WHERE ss.store_id = :store_id LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function update_restriction()
    {
        $sql = "UPDATE store SET restriction_status = :restriction_status WHERE store_id = :store_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':restriction_status', $this->restriction_status);
        $query->bindParam(':store_id', $this->store_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function update_verification()
    {
        $sql = "UPDATE store SET verification_status = :verification_status WHERE store_id = :store_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':verification_status', $this->verification_status);
        $query->bindParam(':store_id', $this->store_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show_stores($start, $limit)
    {
        $sql = "SELECT s.*, a.firstname, a.middlename, a.lastname, c.college_name FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND staff_role = 0 LEFT JOIN account a ON ss.account_id = a.account_id AND a.is_deleted != 1 LEFT JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 WHERE s.is_deleted != 1 ORDER BY s.store_id ASC LIMIT $start, $limit";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function count_stores()
    {
        $sql = "SELECT count(store_id) AS store_id FROM store WHERE is_deleted != 1;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
