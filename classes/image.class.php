<?php
require_once("../classes/database.php");

class Image
{
    public $image_id;
    public $product_id;
    public $image_file;
    public $is_deleted;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add()
    {
        $sql = "INSERT INTO product_images (product_id, image_file) VALUES (:product_id, :image_file)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $this->product_id);
        $query->bindParam(':image_file', $this->image_file);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit()
    {
        $sql = "UPDATE product_images SET image_file=:image_file WHERE image_id = :image_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':image_id', $this->image_id);
        $query->bindParam(':image_file', $this->image_file);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function show($product_id)
    {
        $sql = "SELECT * FROM product_images WHERE product_id = :product_id AND is_deleted != 1 ORDER BY image_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':product_id', $product_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($image_id)
    {
        $sql = "SELECT * FROM product_images WHERE image_id = :image_id LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':image_id', $image_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function delete()
    {
        $sql = "UPDATE product_images SET is_deleted=:is_deleted WHERE image_id = :image_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':is_deleted', $this->is_deleted);
        $query->bindParam(':image_id', $this->image_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
