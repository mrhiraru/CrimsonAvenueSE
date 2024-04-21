<?php
require_once("../classes/database.php");

class AdminSettings
{
    public $settings_id;
    public $commission;
    public $commission_type;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function update_commission()
    {
        $sql = "INSERT INTO admin_settings (settings_id, commission, commission_type)
            VALUES (1, :commission, :commission_type)
            ON DUPLICATE KEY UPDATE
            commission = VALUES(commission),
            commission_type = VALUES(commission_type)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':commission', $this->commission);
        $query->bindParam(':commission_type', $this->commission_type);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function fetch()
    {
        $sql = "SELECT * FROM admin_settings WHERE settings_id = 1 LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }
}
