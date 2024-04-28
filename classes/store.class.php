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
    public $registration_status;
    public $restriction_status;
    public $is_created;
    public $is_deleted;
    public $staff_role;
    public $delivery_charge;
    public $store_profile;
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

        $sql = "INSERT INTO store (store_name, college_id ,certificate, verification_status, registration_status) VALUES (:store_name, :college_id, :certificate, :verification_status, :registration_status);";

        $query = $connect->prepare($sql);
        $query->bindParam(':store_name', $this->store_name);
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':certificate', $this->certificate);
        $query->bindParam(':verification_status', $this->verification_status);
        $query->bindParam(':registration_status', $this->registration_status);

        if ($query->execute()) {
            $last_store_id = $connect->lastInsertId();

            $sub_sql = "INSERT INTO store_staff (account_id, store_id, staff_role) VALUES (:account_id, :store_id, :staff_role);";

            $sub_query = $connect->prepare($sub_sql);
            $sub_query->bindParam(':account_id', $this->account_id);
            $sub_query->bindParam(':store_id', $last_store_id);
            $sub_query->bindParam(':staff_role', $this->staff_role);

            if ($sub_query->execute()) {
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

    function fetch_this($store_id)
    {
        $sql = "SELECT * FROM store WHERE store_id = :store_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function edit()
    {
        $sql = "UPDATE store SET store_profile = :store_profile, store_name = :store_name, college_id = :college_id, store_bio = :store_bio, store_email = :store_email, store_contact = :store_contact, store_location = :store_location, business_time = :business_time WHERE store_id = :store_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_profile', $this->store_profile);
        $query->bindParam(':store_name', $this->store_name);
        $query->bindParam(':college_id', $this->college_id);
        $query->bindParam(':store_bio', $this->store_bio);
        $query->bindParam(':store_email', $this->store_email);
        $query->bindParam(':store_contact', $this->store_contact);
        $query->bindParam(':store_location', $this->store_location);
        $query->bindParam(':business_time', $this->business_time);
        $query->bindParam(':store_id', $this->store_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function update_certificate()
    {
        $sql = "UPDATE store SET certificate = :certificate WHERE store_id = :store_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':certificate', $this->certificate);
        $query->bindParam(':store_id', $this->store_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show()
    {
        $sql = "SELECT s.*, a.firstname, a.middlename, a.lastname, c.college_name 
        FROM store s 
        INNER JOIN store_staff ss ON s.store_id = ss.store_id AND staff_role = 0 
        LEFT JOIN account a ON ss.account_id = a.account_id AND a.is_deleted != 1 
        LEFT JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 
        WHERE s.registration_status = 'Registered' AND s.is_deleted != 1 AND s.is_created < (SELECT end_date FROM semester WHERE view_status = 'Active')
        ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function show_moderator($college_assigned)
    {
        $sql = "SELECT s.*, a.firstname, a.middlename, a.lastname, c.college_name FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND staff_role = 0 LEFT JOIN account a ON ss.account_id = a.account_id AND a.is_deleted != 1 LEFT JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 WHERE s.registration_status = 'Registered' AND s.is_deleted != 1 AND s.college_id = :college_assigned ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_assigned', $college_assigned);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    // fix store page only show registered store!

    function show_registration()
    {
        $sql = "SELECT s.*, a.firstname, a.middlename, a.lastname, c.college_name FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND staff_role = 0 LEFT JOIN account a ON ss.account_id = a.account_id AND a.is_deleted != 1 LEFT JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 WHERE s.registration_status = 'Not Registered' AND s.is_deleted != 1 ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    function show_registration_moderator($college_assigned)
    {
        $sql = "SELECT s.*, a.firstname, a.middlename, a.lastname, c.college_name FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND staff_role = 0 LEFT JOIN account a ON ss.account_id = a.account_id AND a.is_deleted != 1 LEFT JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 WHERE s.registration_status = 'Not Registered' AND s.is_deleted != 1 AND s.college_id = :college_assigned  ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_assigned', $college_assigned);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_mystores($account_id)
    {
        $sql = "SELECT s.*, ss.staff_role FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND ss.is_deleted != 1 WHERE ss.account_id = :account_id AND s.is_deleted != 1 ORDER BY s.store_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $account_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch_info($store_id, $account_id)
    {
        $sql = "SELECT s.*, ss.*, c.college_id, c.college_name FROM store s INNER JOIN store_staff ss ON s.store_id = ss.store_id AND ss.is_deleted != 1 LEFT JOIN college c ON s.college_id = c.college_id AND c.is_deleted != 1 WHERE s.store_id = :store_id AND s.is_deleted != 1 AND ss.account_id = :account_id AND ss.is_deleted != 1 LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $query->bindParam(':account_id', $account_id);
        if ($query->execute()) {
            $data = $query->fetch();
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


    function update_registration()
    {
        $sql = "UPDATE store SET registration_status = :registration_status, verification_status = :verification_status WHERE store_id = :store_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':registration_status', $this->registration_status);
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

    function update_delivery()
    {
        $sql = "UPDATE store SET delivery_charge = :delivery_charge WHERE store_id = :store_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':delivery_charge', $this->delivery_charge);
        $query->bindParam(':store_id', $this->store_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function count()
    {
        $sql = "SELECT COUNT(store_id) AS store_count   FROM store WHERE is_deleted != 1 AND is_created <= (SELECT end_date FROM semester WHERE view_status = 'Active')";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
    
    function show_verification($store_id) {
        $sql = "SELECT verification_status FROM store WHERE store_id = :store_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":store_id", $store_id);
        $data = null;
        
        if ($query->execute()) {
            $data = $query->fetch(PDO::FETCH_ASSOC);
        }
        
        return $data['verification_status'];
    }
    function count_products_store($store_id) {
        $sql = "SELECT COUNT(*) AS num_products FROM product WHERE store_id = :store_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":store_id", $store_id);
        
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['num_products'];
        } else {
            
            return false;
        }
    }
    function show_profile($store_id) {
        try {

            $sql = "SELECT * FROM store WHERE store_id = :store_id";
            
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(":store_id", $store_id, PDO::PARAM_INT);
            $query->execute();
            
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            return $result;
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return false;
        }
    }

    
    function store_rank() {
        $sql= "SELECT
                    s.store_name,
                    c.college_name,
                    COUNT(DISTINCT p.product_id) AS products,
                    SUM(oi.quantity) AS solds,
                    SUM(oi.selling_price + oi.commission) AS sales
                FROM
                    store s
                    LEFT JOIN college c ON s.college_id = c.college_id
                    LEFT JOIN product p ON s.store_id = p.store_id
                    LEFT JOIN order_item oi ON p.product_id = oi.product_id
                    LEFT JOIN orders o ON oi.order_id = o.order_id
                WHERE 
                    o.order_status = 'Completed' 
                GROUP BY
                    s.store_id,
                    c.college_id";
    
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return false;
        }
    }
    
    
function store_rank_filtered($start_date, $end_date) {
    $sql = "SELECT
                s.store_name,
                c.college_name,
                COUNT(DISTINCT p.product_id) AS products,
                SUM(oi.quantity) AS solds,
                SUM(oi.selling_price + oi.commission) AS sales
            FROM
                store s
                LEFT JOIN college c ON s.college_id = c.college_id
                LEFT JOIN product p ON s.store_id = p.store_id
                LEFT JOIN order_item oi ON p.product_id = oi.product_id
                LEFT JOIN orders o ON oi.order_id = o.order_id
            WHERE
                o.order_status = 'completed' AND
                DATE(o.is_updated) BETWEEN :start_date AND :end_date
            GROUP BY
                s.store_id,
                c.college_id
            HAVING
                solds = (
                    SELECT MAX(solds)
                    FROM (
                        SELECT 
                            s.store_id,
                            SUM(oi.quantity) AS solds
                        FROM 
                            store s
                            LEFT JOIN product p ON s.store_id = p.store_id
                            LEFT JOIN order_item oi ON p.product_id = oi.product_id
                            LEFT JOIN orders o ON oi.order_id = o.order_id
                        WHERE
                            o.order_status = 'Completed' AND
                            DATE(o.is_updated) BETWEEN :start_date AND :end_date
                        GROUP BY
                            s.store_id
                    ) AS max_sold
                )";

    $query = $this->db->connect()->prepare($sql);
    $query->execute(array(':start_date' => $start_date, ':end_date' => $end_date));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function countStoresToVerify() 
{
    $sql = "SELECT COUNT(*) AS store_count
            FROM store
            WHERE verification_status = 'Not Verified'";
    $query = $this->db->connect()->prepare($sql);
    if ($query->execute()) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['store_count'];
        } else {
            return 0;
        }
    } else {
        return false;
    }
}

function calculateTotalSalesByStore($store_id) {
    $sql = "SELECT SUM(oi.selling_price) AS total_sales
    FROM orders o
    INNER JOIN order_item oi ON o.order_id = oi.order_id
    INNER JOIN product p ON oi.product_id = p.product_id
    WHERE o.order_status = 'Completed' AND p.store_id = :store_id";

    $query = $this->db->connect()->prepare($sql);
    $query->bindParam(':store_id', $store_id, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total_sales'];
        } else {
            return 0;
        }
    } else {
        return false;
    }
}
function calculateTotalPaidCommissionByStore($store_id) {
    $sql = "SELECT SUM(commission_total) AS total_paid_commission
            FROM orders
            WHERE commission_status = 'Paid' AND store_id = :store_id";

    $query = $this->db->connect()->prepare($sql);
    $query->bindParam(':store_id', $store_id, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['total_paid_commission'];
        } else {
            return 0;
        }
    } else {
        return false;
    }
}
    function calculateTotalUnpaidCommissionByStore($store_id) {
        $sql = "SELECT SUM(commission_total) AS total_unpaid_commission
                FROM orders
                WHERE store_id = :store_id AND commission_status = 'Unpaid'";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id, PDO::PARAM_INT);
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['total_unpaid_commission'];
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

}
