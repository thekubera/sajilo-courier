<?php  
	require_once "models/CommonValidation.php";

	class ParcelController extends CommonValidation {
		private $parcel;
		private $sender;
		private $receiver;
		private $branch;
		private $bcontroller;

		function __construct(){
  	   		require_once "models/Parcel.php";
  	   		require_once "models/Branch.php";
  	   		require_once "SenderController.php";
  	   		require_once "ReceiverController.php";
  	   		require_once "BranchController.php";
          	
          	$this->parcel = new Parcel();
          	$this->branch = new Branch();
          	$this->sender = new SenderController();
          	$this->receiver = new ReceiverController();
          	$this->bcontroller = new BranchController();
  	   	}

		// For total courier view
		function details() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {

				// get the requested status
				$type = $_GET['type'];

				// status to matched with status got from client
				$status = array("totalPickup","totalShipped","totalIn-transit","totalArrived","totaloutForDelivery","totalDelivered");

				// fetch parcel and customer details based on status
				if(in_array($type, $status)) {
					$type =  substr($type, strpos($type, "l") + 1);
					$result = $this->parcel->fetchParcel($type);
				} else {
					echo "Page not found";
					die;
				}

				require_once './views/parcel/details.php';	
			} else {
				header("Location: ../User/login");
				die;
			}	
		}

		// courier detail section
		function courierDetail() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				// accept parcel reference number
				// don't forgot to validate 

				if( isset($_GET['ref-num']) && isset($_GET['date'])) {
					$ref = htmlspecialchars($_GET['ref-num']);

					if(!($this->validateReferenceNumber($ref))) {
						echo "Somthing went wrong! Please try again!";
						die;
					}

					// 
					$date = htmlspecialchars($_GET['date']);	
				} else {
					echo "Somthing went wrong. Please try again.";
					die;
				}
				

				// now fetch sender's, receiver's and parcel detail
				// based on reference number
				$senderDetail = $this->sender->getSender($ref);
				$receiverDetail = $this->receiver->getReceiver($ref);

				$this->parcel->setRefNum($ref);
				$parcelDetail = $this->parcel->getParcelBasedOnRef();
				
				$parcelHistory = $this->parcel->getHistoryBasedOnRef();


				// ensure each and every data are fetched properly
				$s = ($senderDetail->num_rows > 0)?true:false;
				$r = ($receiverDetail->num_rows > 0)?true:false;
				$p = ($parcelDetail->num_rows > 0)?true:false;
				$h = ($parcelHistory->num_rows > 0)?true:false;

				if($s && $r && $p && $h) {
					require_once './views/parcel/courierDetail.php';
				} else {
					echo "Somthing went wrong! Please try again.";
					die;
				}

			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// user's search parcel method
		function searchParcel() {
			if(empty($_POST['refnum'])) {
				echo "errorEmpty";
				die;
			 } else { 
			 	// take a reference number and validate it
				// fetch courier and send it to view

				$ref = trim($_POST['refnum']);

				if(!($this->validateReferenceNumber($ref))) {
					echo "invalidRef";
					die;
				}

				$this->parcel->setRefNum($ref);
				if(!($this->parcel->checkParcelExistence())) {
					echo "notExist";
					die;
				}

				// now fetch sender's, receiver's and parcel detail
				// based on reference number
				$senderDetail = $this->sender->getSender($ref);
				$receiverDetail = $this->receiver->getReceiver($ref);

				$this->parcel->setRefNum($ref);
				$parcelDetail = $this->parcel->getParcelBasedOnRef();
				
				$parcelHistory = $this->parcel->getHistoryBasedOnRef();
				$date = $this->parcel->getParcelDateBasedOnRef();


				// ensure each and every data are fetched properly
				$s = ($senderDetail->num_rows > 0)?true:false;
				$r = ($receiverDetail->num_rows > 0)?true:false;
				$p = ($parcelDetail->num_rows > 0)?true:false;
				$h = ($parcelHistory->num_rows > 0)?true:false;

				if($s && $r && $p && $h) {
					require_once './views/shared/courierDetail.php';
				} else {
					echo "Somthing went wrong! Please try again.";
					die;
				}
			 }
		}

		

		/*
			Staff related methos starts from here.
		*/
		// staff search panel
		function search() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				require_once './views/parcel/searchCourier.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function searchCourier() {
			session_start();
			if(isset($_SESSION['id'])) {
				if(empty($_POST['refnum'])) {
					echo "errorEmpty";
					die;
				} else {
					// take a reference number and validate it
					// fetch courier and send it to view

					$ref = trim($_POST['refnum']);

					if(!($this->validateReferenceNumber($ref))) {
						echo "invalidRef";
						die;
					}

					$this->parcel->setRefNum($ref);
					if(!($this->parcel->checkParcelExistence())) {
						echo "notExist";
						die;
					}

					// now fetch sender's, receiver's and parcel detail
					// based on reference number
					$senderDetail = $this->sender->getSender($ref);
					$receiverDetail = $this->receiver->getReceiver($ref);

					$this->parcel->setRefNum($ref);
					$parcelDetail = $this->parcel->getParcelBasedOnRef();
					
					$parcelHistory = $this->parcel->getHistoryBasedOnRef();
					$date = $this->parcel->getParcelDateBasedOnRef();


					// ensure each and every data are fetched properly
					$s = ($senderDetail->num_rows > 0)?true:false;
					$r = ($receiverDetail->num_rows > 0)?true:false;
					$p = ($parcelDetail->num_rows > 0)?true:false;
					$h = ($parcelHistory->num_rows > 0)?true:false;

					if($s && $r && $p && $h) {
						require_once './views/shared/courierDetail.php';
					} else {
						echo "Somthing went wrong! Please try again.";
						die;
					}
				}
			}
		}

		// staff add courier section
		function addCourier() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['sid'])) {
				// fetch branch infos
				// don't forgot to check at least one branch exist
				$result = $this->branch->fetchBranch();
				$current = $this->branch->fetchStaffBranch($_SESSION['uid']);
				require_once './views/parcel/addCourier.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function add() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['sid'])) {
				if(empty($_POST['sbranch']) || empty($_POST['rbranch']) || empty($_POST['sname']) || empty($_POST['rname']) || empty($_POST['sadd']) || empty($_POST['radd']) || empty($_POST['sphone']) || empty($_POST['rphone']) || empty($_POST['semail']) || empty($_POST['remail']) || empty($_POST['scountry']) || empty($_POST['rcountry']) || empty($_POST['pweight']) || empty($_POST['len']) || empty($_POST['bre']) || empty($_POST['hei']) || empty($_POST['price'])) {

					echo "errorEmpty";
					die;
				} else {
					// store data and validate it
					// sender's data
					$sbranch = $_POST['sbranch'];
					$sname = $_POST['sname'];
					$sadd = $_POST['sadd'];
					$sphone = $_POST['sphone'];
					$semail = $_POST['semail'];
					$scountry = $_POST['scountry'];

					// receiver's data
					$rbranch = $_POST['rbranch'];
					$rname = $_POST['rname'];
					$radd = $_POST['radd'];
					$rphone = $_POST['rphone'];
					$remail = $_POST['remail'];
					$rcountry = $_POST['rcountry'];

					// parcel details
					$pweight = $_POST['pweight'];
					$plength =  $_POST['len'];
					$pbreadth =  $_POST['bre'];
					$pheight =  $_POST['hei'];
					$pdesc =  $_POST['des'];
					$pprice = $_POST['price'];

					// now validate
					// sender's data
					$v1 = $this->validateData($sadd,$semail,$sphone,$sname,$scountry);
					if(!($v1 === true)) {
						echo 's'.$v1;
						die;
					}

					$v2 = $this->validateData($radd,$remail,$rphone,$rname,$rcountry);

					if(!($v2 === true)) {
						echo 'r'.$v2;
						die;
					}

					$v3 = $this->validateNumber($pweight, $plength, $pbreadth, $pheight, $pprice);

					if(!($v3 === true)) {
						echo $v3;
						die;
					}

					if(!($sbranch === $rbranch)) {

						// validate branch and check exists or not
						$b1 = $this->bcontroller->checkBranchName($sbranch);
						$b2 = $this->bcontroller->checkBranchName($rbranch);
						if(!($b1 && $b2)) {
							echo "berror";
							die;
						}

						$sbranch = $this->bcontroller->selectByID($sbranch);

						$rbranch = $this->bcontroller->selectByID($rbranch);

					} else {
						echo "sbranch";
						die;
					}

					if($semail === $remail) {
						echo "sameEmail";
						die;
					}

					// now set data to model
					$this->parcel->setPWeight($pweight);
					$this->parcel->setPDLength($plength);
					$this->parcel->setPDBreadth($pbreadth);
					$this->parcel->setPDHeight($pheight);
					$this->parcel->setParcelRemarks($pdesc);
					$this->parcel->setParcelPrice($pprice);

					// sender's info
					$this->parcel->setSenderName($sname);
					$this->parcel->setSenderAddress($sadd);
					$this->parcel->setSenderEmail($semail);
					$this->parcel->setSenderPhone($sphone);
					$this->parcel->setSenderBranch($sbranch);
					$this->parcel->setSenderCountry($scountry);

					// receiver's info
					$this->parcel->setReceiverName($rname);
					$this->parcel->setReceiverAddress($radd);
					$this->parcel->setReceiverEmail($remail);
					$this->parcel->setReceiverPhone($rphone);
					$this->parcel->setReceiverBranch($rbranch);
					$this->parcel->setReceiverCountry($rcountry);

					$this->parcel->setStaffID($_SESSION['sid']);

					if($this->parcel->addParcel()) {
						echo "1";
					} else {
						echo "sqlError";
					}
				}
			}
		}

		// change status method
		function changeStatus() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['sid'])) {

				$remarks = $_POST['remarks'];
				$cstatus = $_POST['status'];
				$refnum = $_POST['refnum'];

				$stat = $this->validateStatusChange($refnum, $remarks, $cstatus);

				if(!($stat === true)) {
					echo $stat;
					die;
				}

				// now make sure reference number exists in database and its status is not delivered
				$this->parcel->setRefNum($refnum);
				if(!($this->parcel->checkParcelBasedOnRef())) {
					echo "invalidRef";
					die;
				}

				// do not allow to update same status twice
				$this->parcel->setParcelStatus($cstatus);
				if(!($this->parcel->checkCurrentStatus())) {
					echo "dupStat";
					die;
				}
				
				// if everything is valid now update the status
				$this->parcel->setRefNum($refnum);
				$this->parcel->setParcelStatus($cstatus);
				$this->parcel->setParcelRemarks($remarks);
				$res = $this->parcel->updateStatus(); 

				if($res) {
					echo "1";
				} else {
					echo "sqlError";
					die;
				}
				
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function courierCount() {
			$status = array('pickup','in-transit','shipped','outfordelivery','arrived', 'delivered');
			$count = array();
			foreach($status as $s) {
				$this->parcel->setParcelStatus($s);
				$count[$s] = $this->parcel->countCourierBasedOnStatus();
			}
			return $count;
		}

		function totalCourierCount() {
			return $this->parcel->totalCourierCount();
		}

		// update courier details
		function updateCourier() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				require_once './views/parcel/updateCourierDetails.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}
	}
?>



