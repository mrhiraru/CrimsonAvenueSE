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

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function sign_in_account()
    {
        $sql = "SELECT a.*, c.college_name, d.department_name, m.college_id AS college_assigned FROM account a LEFT JOIN college c ON a.college_id = c.college_id LEFT JOIN department d ON a.department_id = d.department_id LEFT JOIN moderator m ON a.account_id = m.account_id AND m.is_deleted != 1 WHERE email = :email LIMIT 1;";
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

                return true;
            }
        }
    }


    function add()
    {
        $sql = "INSERT INTO account (email, password, affiliation, firstname, middlename, lastname, gender, college_id, contact, user_role) VALUES (:email, :password, :affiliation, :firstname, :middlename, :lastname, :gender, :college_id, :contact, :user_role)";

        $query = $this->db->connect()->prepare($sql);
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
            return true;
        } else {
            return false;
        }
    }

    function add_admin()
    {
        $sql = "INSERT INTO account (email, password, affiliation, firstname, middlename, lastname, gender, contact, user_role) VALUES (:email, :password, :affiliation, :firstname, :middlename, :lastname, :gender, :contact, :user_role)";

        $query = $this->db->connect()->prepare($sql);
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
            return true;
        } else {
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
        $sql = "SELECT * FROM account WHERE is_deleted != 1 ORDER BY account_id ASC;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function fetch($account_id){
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
}
