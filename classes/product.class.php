<?php
require_once("../classes/database.php");

class Product
{
    public $product_id;
    public $store_id;
    public $category_id;
    public $product_name;
    public $exclusivity;
    public $sale_status;
    public $purchase_price;
    public $selling_price;
    public $restriction_status;
    public $order_quantity_limit;
    public $estimated_order_time;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $connect = $this->db->connect();
        $connect->beginTransaction();

        $sql = "INSERT INTO product (store_id, category_id, product_name, exclusivity, sale_status, selling_price, purchase_price) VALUES (:store_id, :category_id, :product_name, :exclusivity, :sale_status, :selling_price, :purchase_price)";

        $query = $connect->prepare($sql);
        $query->bindParam(':store_id', $this->store_id);
        $query->bindParam(':product_name', $this->product_name);
        $query->bindParam(':category_id', $this->category_id);
        $query->bindParam(':exclusivity', $this->exclusivity);
        $query->bindParam(':sale_status', $this->sale_status);
        $query->bindParam(':selling_price', $this->selling_price);
        $query->bindParam(':purchase_price', $this->selling_price);

        if ($query->execute()) {
            $last_product_id = $connect->lastInsertId();

            $sec_sql = "INSERT INTO variation (product_id, variation_name) VALUES (:product_id, :variation_name)";

            $sec_query = $connect->prepare($sec_sql);
            $sec_query->bindParam(':product_id', $last_product_id);
            $sec_query->bindValue(':variation_name', 'Default');

            $thi_sql = "INSERT INTO measurement (product_id, measurement_name) VALUES (:product_id, :measurement_name)";

            $thi_query = $connect->prepare($thi_sql);
            $thi_query->bindParam(':product_id', $last_product_id);
            $thi_query->bindValue(':measurement_name', 'Default');

            if ($sec_query->execute() && $thi_query->execute()) {
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

    function edit()
    {
        $sql = "UPDATE product SET product_name=:product_name, category_id=:category_id, exclusivity=:exclusivity, sale_status=:sale_status, selling_price=:selling_price, purchase_price=:purchase_price, estimated_order_time=:estimated_order_time, order_quantity_limit=:order_quantity_limit WHERE product_id = :product_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_name', $this->product_name);
        $query->bindParam(':category_id', $this->category_id);
        $query->bindParam(':exclusivity', $this->exclusivity);
        $query->bindParam(':sale_status', $this->sale_status);
        $query->bindParam(':purchase_price', $this->purchase_price);
        $query->bindParam(':selling_price', $this->selling_price);
        $query->bindParam(':estimated_order_time', $this->estimated_order_time);
        $query->bindParam(':order_quantity_limit', $this->order_quantity_limit);
        $query->bindParam(':product_id', $this->product_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($store_id)
    {
        $sql = "SELECT p.*, c.category_name, i.image_file FROM product p INNER JOIN category c ON p.category_id = c.category_id AND c.is_deleted != 1 LEFT JOIN ( SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id  WHERE p.store_id = :store_id AND p.is_deleted != 1 ORDER BY p.product_id ASC";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);

        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_admin()
    {
        $sql = "SELECT p.*, s.store_name, c.category_name, i.image_file FROM product p INNER JOIN store s ON p.store_id = s.store_id AND s.is_deleted != 1 INNER JOIN category c ON p.category_id = c.category_id AND c.is_deleted != 1 LEFT JOIN ( SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id  WHERE p.is_deleted != 1 ORDER BY p.product_id ASC";
        $query = $this->db->connect()->prepare($sql);

        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch_info($product_id, $store_id)
    {
        $sql = "SELECT p.*, s.store_id, c.category_name, COALESCE(v.var_count, 0) AS var_count, COALESCE(m.mea_count, 0) AS mea_count FROM product p INNER JOIN store s ON p.store_id = s.store_id INNER JOIN category c ON p.category_id = c.category_id INNER JOIN (SELECT product_id, COUNT(*) AS var_count FROM variation WHERE is_deleted != 1 GROUP BY product_id) v ON p.product_id = v.product_id INNER JOIN (SELECT product_id, COUNT(*) AS mea_count FROM measurement WHERE is_deleted != 1 GROUP BY product_id) m ON p.product_id = m.product_id WHERE p.store_id = :store_id AND p.product_id = :product_id AND p.is_deleted != 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':store_id', $store_id);
        $query->bindParam(':product_id', $product_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function fetch($product_id)
    {
        $sql = "SELECT p.*, s.store_id, c.category_name, COALESCE(v.var_count, 0) AS var_count, COALESCE(m.mea_count, 0) AS mea_count FROM product p INNER JOIN store s ON p.store_id = s.store_id INNER JOIN category c ON p.category_id = c.category_id INNER JOIN (SELECT product_id, COUNT(*) AS var_count FROM variation WHERE is_deleted != 1 GROUP BY product_id) v ON p.product_id = v.product_id INNER JOIN (SELECT product_id, COUNT(*) AS mea_count FROM measurement WHERE is_deleted != 1 GROUP BY product_id) m ON p.product_id = m.product_id WHERE p.product_id = :product_id AND p.is_deleted != 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function update_restriction()
    {
        $sql = "UPDATE product SET restriction_status = :restriction_status WHERE product_id = :product_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':restriction_status', $this->restriction_status);
        $query->bindParam(':product_id', $this->product_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function count_products()
    {
        $sql = "SELECT count(product_id) AS product_id FROM product WHERE is_deleted != 1;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function count_products_filter($search, $category, $sort, $exclusivity)
    {
        if (isset($search) && $search != '') {
            $search = trim(htmlentities($search));
            $searches = explode(" ", $search);
        }

        if (isset($category) && $category != "All") {
            $category = trim(htmlentities($category));
        }

        if (isset($exclusivity) && $exclusivity != 'All') {
            $exclusivity = trim(htmlentities($exclusivity));
        }

        if (isset($sort)) {
            $sort = trim(htmlentities($sort));
            if ($sort == "Newest") {
                $sort = "p.is_created DESC";
            } else if ($sort == "Oldest") {
                $sort = "p.is_created ASC";
            } else if ($sort == "Lowest") {
                $sort = "p.selling_price ASC";
            } else if ($sort == "Highest") {
                $sort = "p.selling_price DESC";
            } else {
                $sort = "p.is_updated DESC";
            }
        }

        $sql = "SELECT COUNT(p.product_id) as selected_count
        FROM product p 
        LEFT JOIN category c ON p.category_id = c.category_id 
        LEFT JOIN (SELECT product_id, desc_value FROM product_desc WHERE is_deleted != 1 GROUP BY product_id) pd ON p.product_id = pd.product_id
        WHERE p.is_deleted != 1";

        if (isset($search) && $search != '') {
            $first_counter = 0;
            foreach ($searches as $key => $word) {
                if ($first_counter == 0) {
                    $sql .= " AND ((p.product_name LIKE :search_$key";
                } else {
                    $sql .= " OR p.product_name LIKE :search_$key";
                }
                $first_counter++;
            }
            $sql .= ")";
            $second_counter = 0;
            foreach ($searches as $key => $word) {
                if ($second_counter == 0) {
                    $sql .= " OR (pd.desc_value LIKE :search_$key";
                } else {
                    $sql .= " OR pd.desc_value LIKE :search_$key";
                }
                $second_counter++;
            }
            $sql .= "))";
        }


        if (isset($category) && $category != "All") {
            $sql .= " AND c.category_name = :category";
        }

        if (isset($exclusivity) && $exclusivity != 'All') {
            $sql .= " AND p.exclusivity = :exclusivity";
        }

       // $sql .= " GROUP BY p.product_id;";


        $query = $this->db->connect()->prepare($sql);

        if (isset($search) && $search != '') {
            foreach ($searches as $key => $word) {
                $query->bindValue(":search_$key", "%$word%");
            }
        }

        if (isset($category) && $category != "All") {
            $query->bindValue(":category", $category);
        }

        if (isset($exclusivity) && $exclusivity != 'All') {
            $query->bindValue(":exclusivity", $exclusivity);
        }

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_products($start, $limit)
    {
        $sql = "SELECT p.*, s.store_name, i.image_file FROM product p LEFT JOIN store s ON p.store_id = s.store_id LEFT JOIN ( SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id WHERE p.is_deleted != 1 ORDER BY p.product_id LIMIT $start, $limit";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_products_filter($start, $limit, $search, $category, $sort, $exclusivity)
    {
        if (isset($search) && $search != '') {
            $search = trim(htmlentities($search));
            $searches = explode(" ", $search);
        }

        if (isset($category) && $category != "All") {
            $category = trim(htmlentities($category));
        }

        if (isset($exclusivity) && $exclusivity != 'All') {
            $exclusivity = trim(htmlentities($exclusivity));
        }

        if (isset($sort)) {
            $sort = trim(htmlentities($sort));
            if ($sort == "Newest") {
                $sort = "p.is_created DESC";
            } else if ($sort == "Oldest") {
                $sort = "p.is_created ASC";
            } else if ($sort == "Lowest") {
                $sort = "p.selling_price ASC";
            } else if ($sort == "Highest") {
                $sort = "p.selling_price DESC";
            } else {
                $sort = "p.is_updated DESC";
            }
        }

        $sql = "SELECT p.*, s.store_name, i.image_file, pd.desc_value, c.category_name
        FROM product p 
        LEFT JOIN store s ON p.store_id = s.store_id 
        LEFT JOIN category c ON p.category_id = c.category_id 
        LEFT JOIN (SELECT product_id, desc_value FROM product_desc WHERE is_deleted != 1) pd ON p.product_id = pd.product_id
        LEFT JOIN (SELECT product_id, image_file FROM product_images WHERE is_deleted != 1 GROUP BY product_id) i ON p.product_id = i.product_id 
        WHERE p.is_deleted != 1";

        if (isset($search) && $search != '') {
            $first_counter = 0;
            foreach ($searches as $key => $word) {
                if ($first_counter == 0) {
                    $sql .= " AND ((p.product_name LIKE :search_$key";
                } else {
                    $sql .= " OR p.product_name LIKE :search_$key";
                }
                $first_counter++;
            }
            $sql .= ")";
            $second_counter = 0;
            foreach ($searches as $key => $word) {
                if ($second_counter == 0) {
                    $sql .= " OR (pd.desc_value LIKE :search_$key";
                } else {
                    $sql .= " OR pd.desc_value LIKE :search_$key";
                }
                $second_counter++;
            }
            $sql .= "))";
        }


        if (isset($category) && $category != "All") {
            $sql .= " AND c.category_name = :category";
        }

        if (isset($exclusivity) && $exclusivity != 'All') {
            $sql .= " AND p.exclusivity = :exclusivity";
        }

        $sql .= " GROUP BY p.product_id ORDER BY $sort
        LIMIT $start, $limit";

        $query = $this->db->connect()->prepare($sql);

        if (isset($search) && $search != '') {
            foreach ($searches as $key => $word) {
                $query->bindValue(":search_$key", "%$word%");
            }
        }

        if (isset($category) && $category != "All") {
            $query->bindValue(":category", $category);
        }

        if (isset($exclusivity) && $exclusivity != 'All') {
            $query->bindValue(":exclusivity", $exclusivity);
        }

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }
}
