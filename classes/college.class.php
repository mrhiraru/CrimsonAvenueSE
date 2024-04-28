<?php
require_once("../classes/database.php");

class College
{
    public $college_id;
    public $college_name;
    public $is_deleted;

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

    function fetch($college_id)
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
        // Note: Update query to count stores per college!
        $sql = "SELECT c.*, COALESCE(d.dept_count, 0) as dept_count, COALESCE(s.store_count, 0) as store_count
        FROM college c 
        LEFT JOIN (SELECT college_id, COUNT(*) as dept_count FROM department WHERE is_deleted != 1 GROUP BY college_id) d ON c.college_id = d.college_id 
        LEFT JOIN (SELECT college_id, COUNT(*) as store_count FROM store WHERE is_deleted != 1 GROUP BY college_id) s ON c.college_id = s.college_id 
        WHERE c.is_deleted != 1 AND c.is_created < (SELECT end_date FROM semester WHERE view_status = 'Active')  ORDER BY c.college_id ASC;";

        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_mod($college_id)
    {
        // Note: Update query to count stores per college!
        $sql = "SELECT c.*, COALESCE(d.dept_count, 0) as dept_count, COALESCE(s.store_count, 0) as store_count
        FROM college c 
        LEFT JOIN (SELECT college_id, COUNT(*) as dept_count FROM department WHERE is_deleted != 1 GROUP BY college_id) d ON c.college_id = d.college_id 
        LEFT JOIN (SELECT college_id, COUNT(*) as store_count FROM store WHERE is_deleted != 1 GROUP BY college_id) s ON c.college_id = s.college_id 
        WHERE c.is_deleted != 1 AND c.college_id = :college_id AND c.is_created < (SELECT end_date FROM semester WHERE view_status = 'Active')  ORDER BY c.college_id ASC;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $college_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function count()
    {
        // Note: Update query to count stores per college!
        $sql = "SELECT COUNT(college_id) AS college_count FROM college WHERE is_deleted != 1  AND is_created <= (SELECT end_date FROM semester WHERE view_status = 'Active')";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }


    function delete()
    {
        $sql = "UPDATE college SET is_deleted=:is_deleted WHERE college_id = :college_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':college_id', $this->college_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function count_department($college_id)
    {
        $sql = "SELECT c.*, COUNT(d.college_id) as dept_count FROM college c LEFT JOIN department d ON c.college_id = d.college_id AND d.is_deleted != 1 WHERE c.college_id = :college_id AND c.is_deleted != 1";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $college_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }
}
