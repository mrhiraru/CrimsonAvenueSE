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
    public $is_created;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO store () VALUES ();";

        $query = $this->db->connect()->prepare($sql);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
