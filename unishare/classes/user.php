<?php
include('password.php');


class User extends Password{
    private $_db;
    function __construct($db){
    	parent::__construct();
    	$this->_db = $db;
    }
	private function get_user_hash($email){
		try {
			$stmt = $this->_db->prepare('SELECT password, email, memberID FROM members WHERE email = :email AND active="Yes" ');
			$stmt->execute(array('email' => $email));
			return $stmt->fetch();
		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
    
    //check if username is valid
	public function isValidUsername($username){
		if (strlen($username) < 3) return false;
		if (strlen($username) > 30) return false;
		if (!ctype_alnum($username)) return false;
		return true;
	}
    
    // handle User logging in 
	public function login($email,$password){
        
		
		if (strlen($password) < 3) 
            return false;
        
		$row = $this->get_user_hash($email);
        
		if($this->password_verify($password,$row['password']) == 1){
		    $_SESSION['loggedin'] = true;
		    $_SESSION['email'] = $row['email'];
		    $_SESSION['memberID'] = $row['memberID'];
		    return true;
		}
	}
    
	public function logout(){
		session_destroy();
	}
	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}
}
?>