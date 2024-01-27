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
    public $college;
    public $department;
    public $contact;

    public $user_role;
    public $verification_status;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function sign_in_account(){
        $sql = "SELECT * FROM account WHERE email = :email LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);

        if ($query->execute()){
            $accountData = $query->fetch(PDO::FETCH_ASSOC);

            if ($accountData && password_verify($this->password, $accountData['password'])) {
                $this->account_id = $accountData['account_id'];
                $this->user_role = $accountData['user_role'];
                $this->firstname = $accountData['firstname'];
                $this->middlename = $accountData['middlename'];
                $this->lastname = $accountData['lastname'];
                $this->email = $accountData['email'];
                $this->verification_status = $accountData['verification_status'];
                return true;
            }
        }
    }


    function add()
    {
        $sql = "INSERT INTO account (email, password, affiliation, firstname, middlename, lastname, gender, college, department, contact, user_role) VALUES (:email, :password, :affiliation, :firstname, :middlename, :lastname, :gender, :college, :department, :contact, :user_role)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam('affiliation', $this->affiliation);
        $query->bindParam('firstname', $this->firstname);
        $query->bindParam('middlename', $this->middlename);
        $query->bindParam('lastname', $this->lastname);
        $query->bindParam('gender', $this->gender);
        $query->bindParam('college', $this->college);
        $query->bindParam('department', $this->department);
        $query->bindParam('contact', $this->contact);
        $query->bindParam('user_role', $this->user_role);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function verify(){
        $sql = "UPDATE account SET verification_status = :verification_status WHERE account_id = :account_id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':verification_status', $this->verification_status);
        $query->bindParam(':account_id', $this->account_id);

        if($query->execute()){
            return true;
        }else{
            return false;
        }
    }

    function is_email_exist(){
        $sql = "SELECT * FROM account WHERE email = :email;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        if($query->execute()){
            if($query->rowCount()>0){
                return true;
            }
        }
        return false;
    }
}