<?php
require_once("../classes/database.php");

class Semester
{
    public $semester_id;
    public $semester_number;
    public $start_date;
    public $end_date;
    public $status;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO semester (semester_number, start_date, end_date, status) VALUES (:semester_number, :start_date, :end_date, :status)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':semester_number', $this->semester_number);
        $query->bindParam(':start_date', $this->start_date);
        $query->bindParam(':end_date', $this->end_date);
        $query->bindParam(':status', $this->status);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show()
    {
        $sql = "SELECT * FROM semester";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function edit()
    {
        $sql = "UPDATE semester SET semester_number=:semester_number, start_date=:start_date, end_date=:end_date WHERE semester_id = :semester_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':semester_number', $this->semester_number);
        $query->bindParam(':start_date', $this->start_date);
        $query->bindParam(':end_date', $this->end_date);
        $query->bindParam(':semester_id', $this->semester_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function fetch()
    {
        $sql = "SELECT * FROM semester WHERE status = 'Current' LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function semester_ended($semester_id)
    {
        $sql = "UPDATE semester SET status = 'Ended', view_status = 'Inactive' WHERE semester_id = :semester_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':semester_id', $semester_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
