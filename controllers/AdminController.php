<?php
	class AdminController {
		private $pcontroller;
		private $admin;
		private $parcel;
		function __construct() {
			require_once 'ParcelController.php';
			require_once 'models/Admin.php';
			require_once 'models/Parcel.php';

			$this->admin = new Admin();
			$this->pcontroller = new ParcelController();
			$this->parcel = new Parcel();

		}
		
		// Admin dashboard
		function dashboard() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['aid'])) {
				$total_courier = $this->pcontroller->totalCourierCount();
				$statusCount = $this->pcontroller->courierCount();
				require_once './views/admin/dashboard.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// change password section
		function changePassword() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				require_once './views/admin/changePassword.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		// change profile picture
		function changeProfilePicture() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				require_once './views/admin/changeProfilePicture.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function viewReport() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				require_once './views/admin/viewReport.php';
			} else {
				header("Location: ../User/login");
				die;
			}
		}

		function searchReport() {
			session_start();
			if(isset($_SESSION['id']) && isset($_SESSION['uid'])) {
				if(empty($_POST['fromdate']) || empty($_POST['todate'])) {
					echo "errorEmpty";
					die;
				} else {
					$fromdate = $_POST['fromdate'];
					$todate = $_POST['todate'];

					if($fromdate > $todate) {
						echo "invalidDate";
						die;
					}

					$fromdate = explode('-', $fromdate);
					

					if(!checkdate($fromdate[1], $fromdate[2], $fromdate[0])) {
						echo "invalidDate";
						die;
					}

					$todate = explode('-', $todate);

					if(!checkdate($todate[1], $todate[2], $todate[0])) {
						echo "invalidDate";
						die;
					}

					$todate = implode('-', $todate);
					$fromdate = implode('-', $fromdate);

					$result = $this->parcel->getReport();

					echo "<table class='table'>
						  <thead>
						    <tr>
						      <th scope='col'>Branch Name</th>
						      <th scope='col'>Total Courier</th>
						      <th scope='col'>Total Price</th>
						    </tr>
						  </thead>
						  <tbody>";
						  while($row3 = $result->fetch_assoc()) { {
						  	echo '<tr>';
						  		echo "<td>".$row3['bname']."</td>";
							  echo "<td>".$row3['total_courier']."</td>";
							  echo "<td>".$row3['total_price']."</td>";
						  	echo '</tr>';
						  }
					echo   "</tbody></table>";
				}
			} 
		} else {
				header("Location: ../User/login");
			}
	}
	}

?>