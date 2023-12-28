<?php
	require_once "models/CommonValidation.php";

	class BranchController extends CommonValidation {
		private $branch;
		private $user;
		// include the model
  	   	function __construct(){
  	   		require_once "models/Branch.php";
  	   		require_once "UserController.php";
          	$this->branch = new Branch();
          	$this->user = new UserController();
  	   	}

  	   	// for front end outer view of customer
		function index() {
			// reterive the result form modal
			$result = $this->branch->selectAllBranch();
			require_once ('./views/branch/index.php');
		}

		// Branch details for admin
		function branchDetails() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				// reterive the result form modal
				$this->branch->setUID($_SESSION['aid']);
				$result = $this->branch->selectAllRecords();
				
				require_once './views/branch/branch.php';	
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// to fetch branch name
		function fetchBranchInfo() {
			$this->branch->setUID($_SESSION['aid']);
			$result = $this->branch->fetchBranchInfo();

			return $result;
		}

		
		// Branch addition form
		function addBranch() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				require_once './views/branch/branchAddition.php';	
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		/*
			1.Branch insertion process
			2.Accepts data from view
			3.Validate it
			4.Sends it to the model for insertion
		*/
		function insertBranch() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				/*
				Basic validation part.
				*/

				// To ensure all fields are completely filled 
				if(empty($_POST['bname']) || empty($_POST['badd']) || empty($_POST['bemail']) || empty($_POST['bcontact']) || empty($_POST['bcountry'])) {

					echo "errorEmpty";
					die;
				} else {
					// receives all data from view
					$bname = $_POST['bname'];
					$badd = $_POST['badd'];
					$bemail = $_POST['bemail'];
					$bcontact = $_POST['bcontact'];
					$bcountry = $_POST['bcountry'];

					// validate each and every data
					$dec = $this->validateData($badd, $bemail, $bcontact,$bname, $bcountry);

					if($dec === true) {
							
							// now set the values for modal
							$this->branch->setBranchName($bname);
							$this->branch->setBranchAddress($badd);
							$this->branch->setBranchEmail($bemail);
							$this->branch->setBranchPhone($bcontact);
							$this->branch->setBranchCountry($bcountry);
							$this->branch->setUID($_SESSION['aid']);
							$result = $this->branch->insertBranch();

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

		// For update branch page
		function branchUpdate() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				// accept the id from view
				$bid = $_GET['id'];


				//$this->branch->setBranchID($bid);
				$this->branch->setBranchID($bid);
				$result = $this->branch->selectByID();

				require_once './views/branch/branchUpdate.php';	
			} else {
				header("Location: ../User/login");
				die;
			}	

		}

		// for updating the branch details
		function update() {
			// To ensure all fields are completely filled 
			if(empty($_POST['bid']) ||empty($_POST['bname']) || empty($_POST['badd']) || empty($_POST['bemail']) || empty($_POST['bcontact']) || empty($_POST['bcountry'])) {

				echo "errorEmpty";
				die;
			} else {
				// receives all data from view
				$bid = $_POST['bid'];
				$bname = $_POST['bname'];
				$badd = $_POST['badd'];
				$bemail = $_POST['bemail'];
				$bcontact = $_POST['bcontact'];
				$bcountry = $_POST['bcountry'];

				// validate each and every data
				$dec = $this->validateData($badd, $bemail, $bcontact, $bname, $bcountry);

				if($dec === true) {
						
					// now set the values for modal
					$this->branch->setBranchID($bid);
					$this->branch->setBranchName($bname);
					$this->branch->setBranchAddress($badd);
					$this->branch->setBranchEmail($bemail);
					$this->branch->setBranchPhone($bcontact);
					$this->branch->setBranchCountry($bcountry);

					$result = $this->branch->updateBranch();

					if($result == TRUE) {
						echo "updated";
					} else {
						echo "updateError";
					}
				} else {
					echo $dec;
				}
			}
		}

		// for delete branch info
		function delete() {
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['aid'])) {
				if(isset($_POST['bid'])) {
					// pass data to modal
					$bid = $_POST['bid'];
					/*
						Validate uid VVI************************

					*/
					$this->branch->setBranchID($bid);

					$userDeletion = $this->user->deleteBasedOnBranch($bid);
					$result = $this->branch->deleteBranch();

					echo ($result == TRUE && $userDeletion == TRUE)?"1":"sqlError"; 
				} else {
					echo "0";
				}
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// check branch name
		function checkBranchName($bid) {
			$res = $this->branch->checkBranchName($bid);
			
			return (mysqli_num_rows($res) == 1)?1:0;	
		}

		// fetch branch name
		function selectByID($bid) {
			$this->branch->setBranchID($bid);
			$result = $this->branch->selectByID();
			$branch = $result->fetch_assoc();
			return $branch['bname'];
		}
	}
?>