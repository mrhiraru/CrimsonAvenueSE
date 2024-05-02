<?php
require_once("../classes/database.php");

class Notification
{
    public $notification_id;
    public $store_id;
    public $message;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO store_notification (store_id, message) VALUES (:store_id, :message)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $this->store_id);
        $query->bindParam(':message', $this->message);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($store_id)
    {
        $sql = "SELECT * FROM store_notification WHERE store_id = :store_id AND is_deleted != 1 ORDER BY notification_id DESC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
