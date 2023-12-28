<?php  
	class User {
		/**** Data Members and their getters and setters. ****/

		// data members 
		private $uid;
		private $sid;
		private $email;
		private $password;
		private $created_date;
		private $conn;

		function __construct(){
			// database connectivity
			require_once "service/Config.php";
			$this->conn=Config::getConnection();
		}

		// public getters and setters
		public function setUid($uid) {
			$this->uid = $uid;
		}

		public function getUid() {
			return $this->uid;	
		}

		// for staff id
		public function setSID($sid) {
			$this->sid = $sid;
		}

		public function getSID() {
			return $this->sid;
		}

		public function setEmail($email) {
			$this->email = $email;
		}

		public function getEmail() {
			return $this->email;	
		}

		public function setPassword($password) {
			$this->password = $password;
		}

		public function getPassword() {
			return $this->password;
		}

		public function setCreateDate($created_date) {
			$this->created_date = $created_date;
		}

		public function getCreateDate() {
			return $this->created_date;	
		}

		// some logic and db manipulation
		
		// verify user 
		function checkUser() {
			// SQL query
			$sql = "SELECT uid,email,utype FROM sajilo_user WHERE email='$this->email' AND password='$this->password'";

        	$result = $this->conn->query($sql);
        	return $result;
		}

		// for returning admin id based on user id
		// since admin is subclass of User
		function getAdminID($uid) {
			$sql = "SELECT admin.aid as aid FROM sajilo_user,admin WHERE sajilo_user.uid = admin.uid AND sajilo_user.uid = '$uid'";

			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
        	return $row['aid'];
		}

		function deleteBasedOnBranch($bid) {
			$sql = "DELETE FROM sajilo_user WHERE (SELECT uid FROM staff WHERE sajilo_user.uid = staff.uid AND staff.bid = '$bid')"; 
			$result = $this->conn->query($sql);
        	return $result;
		}

		function checkEmail() {
			$sql = "SELECT uid FROM sajilo_user WHERE email = '$this->email'";

			$result = $this->conn->query($sql);
			return (mysqli_num_rows($result) === 0)?1:0;
		}

		function checkPassword() {
			$sql = "SELECT uid FROM sajilo_user WHERE uid = '$this->uid' AND password = '$this->password'";
			$res = $this->conn->query($sql);
			return (mysqli_num_rows($res) === 1)?true:false;
		}

		function changePassword() {
			// if you want to hash to it here before query 
			$sql = "UPDATE sajilo_user SET password = '$this->password' WHERE uid = '$this->uid'";
			$res = $this->conn->query($sql);
			return $res;
		}

		function changePasswordBasedOnEmail() {
			$sql = "UPDATE sajilo_user SET password = '$this->password' WHERE email = '$this->email'";
			$res = $this->conn->query($sql);
			return ($res)?true:false;	
		}

		function checkUserBasedOnSID() {
			$sql = "SELECT sajilo_user.uid FROM sajilo_user,staff WHERE sajilo_user.uid = staff.uid AND staff.sid = '$this->sid'";
			
			$result = $this->conn->query($sql);

			if(mysqli_num_rows($result) === 1) {
				$row = $result->fetch_assoc();
				return ($row['uid']);
			}
			return false;
		}

		function sendResetMail() {
			$to = $this->email;
			$subject = "Your New Password";
			$from = "yourmail";

			// to send mail with HTML tag
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// creating email headers
			$headers .= 'From: ' .$from."\r\n".
				'Reply-To: '.$from."\r\n".
				'X-Mailer: PHP/'. phpversion();

			// compose a message
			$message = '<html><body>';
			$message .= '<h1>Your new password!</h1><br/>';
			$message .= "<p>Your new password for Sajilo Courier is '$this->password'. Please do not share it with anyone. It is better to change once after successfull login with this password.</p>";

			$message .= '</body></html>';

			if(mail($to, $subject, $message, $headers)) {
				// now update the database with new password
				if($this->changePasswordBasedOnEmail()) {
					return true;
				}
				return false;
			}

			return 0;
		}

	}
?>