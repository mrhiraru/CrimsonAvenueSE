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

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
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

    function show()
    {
        $sql = "SELECT s.*, a.firstname, a.middlename, a.lastname, c.college_name FROM store s INNER JOIN account a ON s.account_id = a.account_id AND a.is_deleted != 1 INNER JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 WHERE s.is_deleted != 1 ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
