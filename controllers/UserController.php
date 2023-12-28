<?php  
	//session_start();

	class UserController {
		public $user;
		public $staff;
		private $admin;
  	   	function __construct(){
  	   	  require_once "models/User.php";
  	   	  require_once "models/Staff.php";
  	   	  require_once "models/Admin.php";

          $this->user = new User();
          $this->staff = new Staff();
          $this->admin = new Admin();
  	   	}

  	   	// for login form of user
  	   	function login() {
  	   		require_once('views/user/login.php');
  	   	}

  	   	function forgotPassword() {
  	   		require_once 'views/user/forgot-password.php';
  	   	}

		// login check function to check login credentials of admin
		function loginCheck() {
			// flags for error related stuff
			$errorEmpty = $invalidEmail = $emailEmpty = $passwordEmpty = false;

			// check for empty
			if(empty($_POST['email']) && empty($_POST['password'])) {
				//echo "Email or password can not be empty.";
				$errorEmpty = true;
				echo "errorEmpty";
				die;
			} else if(empty($_POST['email'])) {
				$emailEmpty = true;
				echo "emailEmpty";
				die;
			} else if(empty($_POST['password'])) {
				$passwordEmpty = true;
				echo "passwordEmpty";
				die;
			} else {
				// Accept the input from the form
				$email = $_POST['email'];
				$password = $_POST['password'];

				// check email is valid or not
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    			 	//invalid email!
    			 	$invalidEmail = true;
    			 	echo "invalidEmail";
    			 	die;
				} 
			}

			// if credentials are valid now verify from database
			if($errorEmpty === false && $emailEmpty === false && $passwordEmpty === false  && $invalidEmail === false) {

					// now set the values for the model 
					$this->user->setEmail($email);
					$this->user->setPassword($password);


					// call the method to verify user from db
					$result = $this->user->checkUser();

					if(mysqli_num_rows($result) === 1) {
						// if user credentials are matched start the session
						// first fetch the details of user
						$row = $result->fetch_assoc();

						session_start();
						$_SESSION['id'] = uniqid();
						$_SESSION['uid'] = $row['uid'];

						/*
							Finally echo the flag.
							Flag 1 denotes admin
							and flag 2 denotes staff
						*/
						$utype = ($row['utype'] === "admin")?"1":"2";

						if($utype === "1") {
							$result = $this->user->getAdminID($row['uid']);

							$_SESSION['aid'] = $result;
							$this->admin->setAdminID($_SESSION['aid']);
							$_SESSION['name'] = $this->admin->getAdminName();
						}

						if($utype === "2") {
							$result = $this->staff->getSIDBasedOnUID($row['uid']);

							$_SESSION['sid'] = $result;
							$this->staff->setStaffID($result);
							$_SESSION['name'] = $this->staff->getStaffName();
						}

						echo $utype;

					} else {
						// if incorrect credentials send 0 as response
						echo "0";
					}
			}
 		}

 		function resetPassword() {
 			if(empty($_POST['uemail'])) {
 				echo "errorEmpty";
 				die;
 			} else {
 				$email = $_POST['uemail'];

 				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    			 	echo "invalidEmail";
    			 	die;
				} else {
					// check the email is registerd with system
					$this->user->setEmail($email);

					// it will valid only if it returns 0
					
					$res = $this->user->checkEmail();
					if($res === 0) {
						// valid mail registered with system
						// generate the random password reusing
						// random password method of staff
						//send the mail from here and update the database with new password

						$randPassword = $this->staff->randomPassword();

						// send it through mail and update the database
						// set password
						// call the method to send email
						$this->user->setPassword($randPassword);
						if($this->user->sendResetMail()) {
							echo "1";
						} else {
							echo "error";
							die;
						}

					} else {
						echo "notRegistered";
						die;
					}
				} 
 			}
 		}

 		// logout function 
		function logout() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				// destory the session and redirect to login page
				session_destroy();
			}
			header("Location: ../User/login");
			die;
		}

		function deleteBasedOnBranch($bid) {
			return $this->user->deleteBasedOnBranch($bid);
		}

		// to check email exists or not in database
		function checkEmail($email) {
			$this->user->setEmail($email);
			return $this->user->checkEmail();
		}

		// to check matched user info based on staff id
		function checkUserBasedOnSID($sid) {
			$this->user->setSID($sid);
			return $this->user->checkUserBasedOnSID();
		}
	}
?>