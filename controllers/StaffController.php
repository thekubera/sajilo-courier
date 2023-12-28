<?php
	require_once "models/CommonValidation.php";

	class StaffController extends CommonValidation {
		private $staff;
		private $user;
		private $bcontroller;
		private $userController;
		private $pcontroller;

		// to flag various valid data

		// include the model
  	   	function __construct(){
  	   		require_once "models/Staff.php";
  	   		require_once "models/User.php";
  	   		require_once "BranchController.php";
  	   		require_once "UserController.php";
  	   		require_once 'ParcelController.php';


          	$this->staff = new Staff();
          	$this->user = new User();
          	$this->bcontroller = new BranchController();
          	$this->userController = new UserController();
          	$this->pcontroller = new ParcelController();

  	   	}
	
		// Staff Dashboard
		function dashboard() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['sid'])) {

				$this->staff->setStaffID($_SESSION['sid']);
				$profilePath = $this->staff->fetchProfilePath();
				$total_courier = $this->pcontroller->totalCourierCount();
				$statusCount = $this->pcontroller->courierCount();
				require_once './views/staff/dashboard.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function changePassword() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				require_once './views/staff/changePassword.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function changeProfilePicture() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				$this->staff->setStaffID($_SESSION['sid']);
				$profilePath = $this->staff->fetchProfilePath();
				require_once './views/staff/changeProfilePicture.php';
			} else {
				header("Location: ../User/login");
			}
		}

		function passwordChange() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				if(empty($_POST['oldpass']) || empty($_POST['newpass']) || empty($_POST['newpass1']) || empty($_POST['uid'])) {
					echo "errorEmpty";
					die;
				} else {
					$oldPass = $_POST['oldpass'];
					$newpass = $_POST['newpass'];
					$confirmPass = $_POST['newpass1'];
					$uid = $_POST['uid'];

					if(!($newpass === $confirmPass)) {
						echo "notMatch";
						die;
					}
					// check the existance of old password
					if(!(is_numeric($uid))) {
						echo "sqlError";
						die;
					}
					$this->user->setUid($uid);
					$this->user->setPassword($oldPass);
					if($this->user->checkPassword()) {
						if($oldPass === $newpass) {
							echo "dupPass";
							die;
						}

						if(strlen($newpass) >= 6) {
							// now update model to change password
							$this->user->setUid($uid);
							$this->user->setPassword($newpass);
							$des = $this->user->changePassword();

							if($des === true) {
								echo "1";
							} else {
								echo "sqlError";
								die;
							}
						} else {
							echo "lenError";
							die;
						}
					} else {
						echo "incorrectPass";
						die;
					}
				}
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function profilePicture() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				if($_FILES['sphoto']['size'] > 0 && $_FILES['sphoto']['error'] === 0) {
				

					$fileName = $_FILES['sphoto']['name'];
					$fileTmpName = $_FILES['sphoto']['tmp_name'];
					$fileSize = $_FILES['sphoto']['size'];
					$fileError = $_FILES['sphoto']['error'];
					$fileType = $_FILES['sphoto']['type'];

					$fileExtension = $fileExt = explode('.',$fileName);
					$fileActualExt = strtolower(end($fileExt));

					$allow = array('jpg','jpeg', 'png', 'gif');

					if(in_array($fileActualExt, $allow)) {
						if($fileError === 0) {
							if($fileSize < 5000000) {
								$fileNameNew = uniqid('',true).".".$fileActualExt;
								$fileDest = 'img/users/'.$fileNameNew;
								move_uploaded_file($fileTmpName, $fileDest);

								// now save the file path in db
								$this->staff->setStaffID($_SESSION['sid']);
								$this->staff->setStaffPhoto($fileNameNew);
								$res = $this->staff->updatePhotoPath();

								if($res === true) {
									echo "1";
								} else {
									// remove file from uploaded area
									echo "error";
									die;
								}
							} else {
								echo "sizeErr";
								die;
							}
						} else {
							echo "uploadErr";
							die;
						}
					} else {
						echo "invalidExt";
						die;
					}
					
				} else {
					echo "errorEmpty";
					die;
				}
			} else {
				header("Location: ../User/login");
				die;
			}
		}
		/*
			Methods for admin
		*/

		// Staff details for admin
		function staffDetails() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				
				// reterive the result form model
				$this->staff->setAdminID($_SESSION['aid']);
				$result = $this->staff->selectAllRecords();

				require_once "./views/staff/staff.php";	
			} else {
				header("Location: ../User/login");
				die;
			}	
		}

		// For adding staff
		function addStaff() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				// fetch branch id and name
				$result = $this->getBranchInfo();

				require_once './views/staff/staffAddition.php';	
			} else {
				header("Location: ../User/login");
				die;
			}	
		}

		// to get branch id and name
		function getBranchInfo() {
			
			return $this->bcontroller->fetchBranchInfo();		
		}

		// for adding staff
		function add() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['aid'])) {
				if(empty($_POST['bid']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['sadd']) || empty($_POST['semail']) || empty($_POST['scontact'])) {

					echo "errorEmpty";
					die;
				} else {
					// receive data from view
					$bid = $_POST['bid'];
					$fname = $_POST['fname'];
					$mname = $_POST['mname'];
					$lname = $_POST['lname'];
					$sadd = $_POST['sadd'];
					$semail = $_POST['semail'];
					$scontact = $_POST['scontact'];

					// check branch name is exists or not
					$verifiedBName = $this->bcontroller->checkBranchName($bid);

					if(!$verifiedBName) {
						echo "bnameError";
						die;
					}

					
					// validate first, middle and last name
					if(!($this->validateName($fname))) {
						echo "invalidFName";
						die;
					}

					if($mname != "" || $mname !== null) {
						if(!($this->validateName($mname))) {
							echo "invalidMName";
							die;
						}
						$this->staff->setStaffMName($mname);
					}

					if(!($this->validateName($lname))) {
						echo "invalidLName";
						die;
					}

					// data validation
					$dec = $this->validateData($sadd, $semail, $scontact);

					if($dec === true) {
						// check whether email or phone number already exists or not
						$res = $this->userController->checkEmail($semail);
						if($res === 0) {
							echo "dupEmail";
							die;
						}
						$this->staff->setStaffPhone($scontact);
						$res = $this->staff->checkPhone();
						if($res === 0) {
							echo "dupPhone";
							die;
						} 

						// NOW set the value for model
						$this->staff->setBID($bid);
						$this->staff->setAdminID($_SESSION['aid']);
						$this->staff->setStaffFName($fname);
						$this->staff->setStaffLName($lname);
						$this->staff->setStaffAddress($sadd);
						$this->staff->setStaffEmail($semail);
						$this->staff->setStaffPhone($scontact);

						$result = $this->staff->insertStaff();

						if($result == TRUE) {
							echo "1";
						} else {
							echo "sqlError";
						}

					} else {
						echo $dec;
					}	
				}
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// updtae staff details
		function update() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['aid'])) {

				if( empty($_POST['uid'])&& empty($_POST['bid']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['sadd']) || empty($_POST['semail']) || empty($_POST['scontact'])) {

					echo "errorEmpty";
					die;
				} else {
					// receive data from view
					$bid = $_POST['bid'];
					$uid = $_POST['uid'];
					$sid = $_POST['sid'];
					$fname = $_POST['fname'];
					$mname = $_POST['mname'];
					$lname = $_POST['lname'];
					$sadd = $_POST['sadd'];
					$semail = $_POST['semail'];
					$scontact = $_POST['scontact'];

					// check branch name is exists or not
					$verifiedBName = $this->bcontroller->checkBranchName($bid);

					if(!$verifiedBName) {
						echo "bnameError";
						die;
					}

					// verify user credentials matched with 
					// staff id since any data can be passed
					// from front end by advance user
					$verifiedUser = $this->userController->checkUserBasedOnSID($sid);

					if(!($verifiedUser === $uid)) {
						echo "sqlError";
						die;
					}
					
					// validate first, middle and last name
					if(!($this->validateName($fname))) {
						echo "invalidFName";
						die;
					}

					if($mname != "" || $mname !== null) {
						if(!($this->validateName($mname))) {
							echo "invalidMName";
							die;
						}
						$this->staff->setStaffMName($mname);
					}

					if(!($this->validateName($lname))) {
						echo "invalidLName";
						die;
					}

					// data validation
					$dec = $this->validateData($sadd, $semail, $scontact);

					if($dec === true) {
						
						// NOW set the value for model
						$this->staff->setStaffID($sid);
						$this->staff->setStaffUID($uid);
						$this->staff->setBID($bid);
						$this->staff->setStaffFName($fname);
						$this->staff->setStaffLName($lname);
						$this->staff->setStaffAddress($sadd);
						$this->staff->setStaffEmail($semail);
						$this->staff->setStaffPhone($scontact);

						$result = $this->staff->upadateStaff();

						if($result === TRUE) {
							echo "updated";
						} else {
							echo "sqlError";
						}

					} else {
						echo $dec;
					}	
				}
				
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// For updating staff (Front End Form)
		function staffUpdate() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				$result = $this->getBranchInfo();

				/*Validate it*/
				$this->staff->setStaffID($_GET['id']);


				$staffInfo = $this->staff->selectByID();
				require_once './views/staff/staffUpdate.php';	
			} else {
				header("Location: ../User/login");
				die;
			}	
		}

		/*Admin related methods ends here*/


		// for delete branch info
		function delete() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['aid'])) {
				if(isset($_POST['uid'])) {
					// pass data to modal
					$uid = $_POST['uid'];
					/*
						Validate uid VVI************************

					*/
					$this->staff->setStaffUID($uid);

					$result = $this->staff->deleteStaff();

					echo ($result)?"1":"sqlError"; 
				} else {
					echo "0";
				}
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function checkEmail() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['aid'])) {
				if(!empty($_POST['email'])) {
					$email = $_POST['email'];
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo "invalidEmail";
						die;
					} else {
						$res = $this->userController->checkEmail($email);
						echo $res;
					}	
					
				}

			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// check phone number
		function checkPhone() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['aid'])) {
				if(!empty($_POST['phone'])) {
					$phone = $_POST['phone'];
					if(!preg_match("/^[6-9][0-9]{9}$/", $phone)) {
						echo "invalidPhone";
						die;
					} else {
						$this->staff->setStaffPhone($phone);
						$res = $this->staff->checkPhone();
						if($res === 1) {
							echo "1";
						} else {
							echo "0";
							die;
						}
					}	
					
				}

			} else {
				header("Location: ../User/login");
				die;
			}
		}

	}
?>