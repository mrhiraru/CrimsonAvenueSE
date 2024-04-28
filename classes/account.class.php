<?php
require_once("../classes/database.php");

class Account
{
    public $account_id;
    public $email;
    public $password;
    public $affiliation;
    public $firstname;
    public $middlename;
    public $lastname;
    public $gender;
    public $college_id;
    public $college_name;
    public $department_id;
    public $department_name;
    public $contact;
    public $profile_image;
    public $restriction_status;
    public $address;
    public $user_role;
    public $verification_status;

    public $college_assigned;
    public $cart_id;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function sign_in_account()
    {
        $sql = "SELECT a.*, c.college_name, d.department_name, m.college_id AS college_assigned, ct.cart_id FROM account a LEFT JOIN college c ON a.college_id = c.college_id LEFT JOIN department d ON a.department_id = d.department_id LEFT JOIN moderator m ON a.account_id = m.account_id AND m.is_deleted !=1 INNER JOIN cart ct ON a.account_id = ct.account_id WHERE email = :email LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);

        if ($query->execute()) {
            $accountData = $query->fetch(PDO::FETCH_ASSOC);

            if ($accountData && password_verify($this->password, $accountData['password'])) {
                $this->account_id = $accountData['account_id'];
                $this->user_role = $accountData['user_role'];
                $this->firstname = $accountData['firstname'];
                $this->middlename = $accountData['middlename'];
                $this->lastname = $accountData['lastname'];
                $this->email = $accountData['email'];
                $this->affiliation = $accountData['affiliation'];
                $this->verification_status = $accountData['verification_status'];
                $this->gender = $accountData['gender'];
                $this->contact = $accountData['contact'];
                $this->address = $accountData['address'];
                $this->college_name = $accountData['college_name'];
                $this->department_name = $accountData['department_name'];
                $this->college_assigned = $accountData['college_assigned'];
                $this->cart_id = $accountData['cart_id'];

                return true;
            }
        }
    }

    function refresh_sessions($email)
    {
        $sql = "SELECT a.*, c.college_name, d.department_name, m.college_id AS college_assigned, ct.cart_id FROM account a LEFT JOIN college c ON a.college_id = c.college_id LEFT JOIN department d ON a.department_id = d.department_id LEFT JOIN moderator m ON a.account_id = m.account_id AND m.is_deleted !=1 INNER JOIN cart ct ON a.account_id = ct.account_id WHERE email = :email LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $email);

        if ($query->execute()) {
            $accountData = $query->fetch(PDO::FETCH_ASSOC);
            $this->account_id = $accountData['account_id'];
            $this->user_role = $accountData['user_role'];
            $this->firstname = $accountData['firstname'];
            $this->middlename = $accountData['middlename'];
            $this->lastname = $accountData['lastname'];
            $this->email = $accountData['email'];
            $this->affiliation = $accountData['affiliation'];
            $this->verification_status = $accountData['verification_status'];
            $this->gender = $accountData['gender'];
            $this->contact = $accountData['contact'];
            $this->address = $accountData['address'];
            $this->college_name = $accountData['college_name'];
            $this->department_name = $accountData['department_name'];
            $this->college_assigned = $accountData['college_assigned'];
            $this->cart_id = $accountData['cart_id'];

            return true;
        }
    }


    function add()
    {
        $connect = $this->db->connect();
        $connect->beginTransaction();

        $sql = "INSERT INTO account (email, password, affiliation, firstname, middlename, lastname, gender, college_id, contact, user_role) VALUES (:email, :password, :affiliation, :firstname, :middlename, :lastname, :gender, :college_id, :contact, :user_role)";

        $query = $connect->prepare($sql);
        $query->bindParam(':email', $this->email);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam('affiliation', $this->affiliation);
        $query->bindParam('firstname', $this->firstname);
        $query->bindParam('middlename', $this->middlename);
        $query->bindParam('lastname', $this->lastname);
        $query->bindParam('gender', $this->gender);
        $query->bindParam('college_id', $this->college_id);
        $query->bindParam('contact', $this->contact);
        $query->bindParam('user_role', $this->user_role);

        if ($query->execute()) {
            $last_product_id = $connect->lastInsertId();

            $sec_sql = "INSERT INTO cart (account_id) VALUES (:account_id)";

            $sec_query = $connect->prepare($sec_sql);
            $sec_query->bindParam(':account_id', $last_product_id);

            if ($sec_query->execute()) {
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

    function add_admin()
    {
        $connect = $this->db->connect();
        $connect->beginTransaction();

        $sql = "INSERT INTO account (email, password, affiliation, firstname, middlename, lastname, gender, contact, user_role) VALUES (:email, :password, :affiliation, :firstname, :middlename, :lastname, :gender, :contact, :user_role)";

        $query = $connect->prepare($sql);
        $query->bindParam(':email', $this->email);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam('affiliation', $this->affiliation);
        $query->bindParam('firstname', $this->firstname);
        $query->bindParam('middlename', $this->middlename);
        $query->bindParam('lastname', $this->lastname);
        $query->bindParam('gender', $this->gender);
        $query->bindParam('contact', $this->contact);
        $query->bindParam('user_role', $this->user_role);

        if ($query->execute()) {
            $last_product_id = $connect->lastInsertId();

            $sec_sql = "INSERT INTO cart (account_id) VALUES (:account_id)";

            $sec_query = $connect->prepare($sec_sql);
            $sec_query->bindParam(':account_id', $last_product_id);

            if ($sec_query->execute()) {
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

    function verify()
    {
        $sql = "UPDATE account SET verification_status = :verification_status WHERE account_id = :account_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':verification_status', $this->verification_status);
        $query->bindParam(':account_id', $this->account_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function is_email_exist()
    {
        $sql = "SELECT * FROM account WHERE email = :email;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        if ($query->execute()) {
            if ($query->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }

    function check_for_admin($user_role)
    {
        $sql = "SELECT * FROM account WHERE user_role = :user_role;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':user_role', $user_role);
        if ($query->execute()) {
            if ($query->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }

    function show()
    {
        $sql = "SELECT * FROM account 
        WHERE is_deleted != 1 AND is_created < (SELECT end_date FROM semester WHERE view_status = 'Active')
        ORDER BY account_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_mod($college_id)
    {
        $sql = "SELECT * FROM account 
        WHERE is_deleted != 1 AND college_id = :college_id AND is_created < (SELECT end_date FROM semester WHERE view_status = 'Active')
        ORDER BY account_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $college_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show_moderator($college_assigned)
    {
        $sql = "SELECT * FROM account WHERE is_deleted != 1 AND college_id = :college_assigned ORDER BY account_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_assigned', $college_assigned);

        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($account_id)
    {
        $sql = "SELECT a.*, c.college_name, d.department_name FROM account a LEFT JOIN college c ON a.college_id = c.college_id LEFT JOIN department d ON a.department_id = d.department_id WHERE account_id = :account_id LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $account_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function update_role()
    {
        $sql = "UPDATE account SET user_role = :user_role WHERE account_id = :account_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':user_role', $this->user_role);
        $query->bindParam(':account_id', $this->account_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function update_restriction()
    {
        $sql = "UPDATE account SET restriction_status = :restriction_status WHERE account_id = :account_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':restriction_status', $this->restriction_status);
        $query->bindParam(':account_id', $this->account_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function count()
    {

        $sql = "SELECT COUNT(account_id) AS account_count FROM account WHERE is_deleted != 1 AND is_created <= (SELECT end_date FROM semester WHERE view_status = 'Active')";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }


    function count_mod($college_id)
    {

        $sql = "SELECT COUNT(account_id) AS account_count FROM account WHERE is_deleted != 1 AND college_id = :college_id AND is_created <= (SELECT end_date FROM semester WHERE view_status = 'Active')";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $college_id);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function edit()
    {
        $sql = "UPDATE account SET firstname=:firstname, 
                                   lastname=:lastname, 
                                   middlename=:middlename
                WHERE account_id = :account_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':middlename', $this->middlename);

        $query->bindParam(':account_id', $this->account_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function update($account_id, $data)
    {

        $sql = "UPDATE account SET 
                    firstname = :firstname,
                    middlename = :middlename,
                    lastname = :lastname,
                    gender = :gender,
                    college_id = :college_id,
                    department_id = :department_id,
                    contact = :contact,
                    address = :address
                WHERE account_id = :account_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':account_id', $account_id, PDO::PARAM_INT);
        $query->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
        $query->bindParam(':middlename', $data['middlename'], PDO::PARAM_STR);
        $query->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
        $query->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
        $query->bindParam(':college_id', $data['college_id'], PDO::PARAM_INT);
        $query->bindParam(':department_id', $data['department_id'], PDO::PARAM_INT);
        $query->bindParam(':contact', $data['contact'], PDO::PARAM_STR);
        $query->bindParam(':address', $data['address'], PDO::PARAM_STR);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
