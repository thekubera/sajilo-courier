<?php 
	class Staff {
				/**** Data Members and their getters and setters. ****/

		 // data members
		 private $staffID;
		 private $staffUID;
		 private $staffFName;
		 private $staffMName = "";
		 private $staffLName;
		 private $staffName;
		 private $staffAddress;
		 private $staffEmail;
		 private $staffPassword;
		 private $staffPhone;
		 private $staffPhoto;
		 private $bid;
		 private $aid;

			function __construct(){
				// database connectivity
				require_once "service/Config.php";
				$this->conn = Config::getConnection();
			}

		 // public getters and setters for private data members
		 public function setStaffID($staffID) {
		 	$this->staffID = $staffID;
		 }

		 public function getStaffID() {
		 	return $this->staffID;
		 }

		 public function setStaffUID($uid) {
		 	$this->staffUID = $uid;
		 }

		 public function getStaffUID() {
		 	return $this->staffUID;
		 }

		 public function setStaffFName($staffFName) {
		 	$this->staffFName = $staffFName;
		 }

		 public function getStaffFName() {
		 	return $this->staffFName;
		 }

		 public function setStaffMName($staffMName) {
		 	$this->staffMName = $staffMName;
		 }

		 public function getStaffMName($staffMName) {
		 	return $this->$staffMName;
		 }

		 public function setStaffLName($staffLName) {
		 	$this->staffLName = $staffLName;
		 }

		 public function getStaffLName() {
		 	return $this->staffLName;
		 }

		 public function getFullName() {
		 	return $this->staffFName.$this->staffMName.$this->staffLName;
		 }

		 public function setStaffAddress($staffAddress) {
		 	$this->staffAddress = $staffAddress;
		 }

		 public function getStaffAddress() {
		 	return $this->staffAddress;
		 }

		 public function setStaffEmail($staffEmail) {
		 		$this->staffEmail = $staffEmail;
		 }

		 public function getStaffEmail() {
		 	return $this->staffEmail;
		 }

		 public function setStaffPassword($staffPassword) {
		 	$this->staffPassword = $staffPassword;
		 }

		 public function getStaffPassword() {
		 	return $this->staffPassword;
		 }

		 public function setStaffPhone($staffPhone) {
		 	$this->staffPhone = $staffPhone;
		 }

		 public function getStaffPhone() {
		 	return $this->staffPhone;
		 }

		 public function setStaffPhoto($staffPhoto) {
		 	$this->staffPhoto = $staffPhoto;
		 }

		 public function getStaffPhoto() {
		 	return $this->staffPhoto;
		 }

		 public function setBID($bid) {
		 	$this->bid = $bid;
		 }

		 public function getBID() {
		 	return $this->bid;
		 }

		 public function setAdminID($aid) {
		 	$this->aid = $aid;
		 }

		 public function getAdminID() {
		 	return $this->aid;
		 }

		 function getStaffName() {
		 	$sql = "SELECT sfname, smname, slname FROM staff WHERE sid = '$this->staffID'";
		 	$res = $this->conn->query($sql);

		 	$row = $res->fetch_assoc();

		 	return $row['sfname']." ".$row['smname']." ".$row['slname'];
		 }

		 function getSIDBasedOnUID($uid) {
		 	$sql = "SELECT staff.sid as sid FROM sajilo_user,staff WHERE sajilo_user.uid = staff.uid AND sajilo_user.uid = '$uid'";

			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
        	return $row['sid'];
		 }

		 // to fetch all staff details
		function selectAllRecords() {
			$sql= "SELECT staff.sid as sid, sajilo_user.uid as uid,sfname,smname,slname,saddress,sphone,bname,email FROM sajilo_user,branch,staff,admin_staff WHERE sajilo_user.uid = staff.uid  AND staff.bid = branch.bid AND staff.sid = admin_staff.sid and admin_staff.aid = '$this->aid' ORDER BY staff.sid DESC";
           	
           		$result = $this->conn->query($sql);
           	
           	return $result;
		}

		function fetchProfilePath() {
			$sql = "SELECT sphoto FROM staff WHERE sid = '$this->staffID'";
			$result = $this->conn->query($sql);
			if(mysqli_num_rows($result) === 1) {
				$row = $result->fetch_assoc();
				return $row['sphoto'];
			}
			return false;
		}

		// select information of staff based on ID
		function selectByID() {
			$sql = "SELECT sajilo_user.uid as uid, sfname,smname,slname,saddress,email,sphone FROM sajilo_user,staff WHERE sajilo_user.uid = staff.uid AND staff.sid = '$this->staffID'";
			$result = $this->conn->query($sql);
			return $result;
		}

		function getStaffInfo() {
			$sql = "SELECT sid,sfname, smname, slname, sphone FROM staff WHERE sid = '$this->staffID'";
			$result = $this->conn->query($sql);
			return $result;
		}

		// for insertion of staff details
		function insertStaff() {
			// Set ramdom password
			$this->setStaffPassword($this->randomPassword());

			$sql = "INSERT INTO sajilo_user (email,password,utype) VALUES ('$this->staffEmail', '$this->staffPassword','staff')";

			$sql1 = "SET @user_id = LAST_INSERT_ID()";

			$sql2 = "INSERT INTO staff (sfname,smname,slname,saddress,sphone,uid,bid) VALUES ('$this->staffFName', '$this->staffMName', '$this->staffLName', '$this->staffAddress', '$this->staffPhone',@user_id,'$this->bid')";
			
			$sql3 = "SET @staff_id = LAST_INSERT_ID()";

			$sql4 = "INSERT INTO admin_staff (aid,sid) VALUES ('$this->aid', @staff_id)";

			// now execute the queries
			$r1 = $this->conn->query($sql);
			$r2 = $this->conn->query($sql1);
			$r3 = $this->conn->query($sql2);
			$r4 = $this->conn->query($sql3);
			$r5 = $this->conn->query($sql4);

			if($r1 && $r2 && $r3 && $r4 && $r5) {
				return TRUE;
			}
			return false;

		}

		// update staff record
		// we should use two query 
		// since we have credentials stored on two table
		// i.e sajilo_user and Staff
		function upadateStaff() {
			$sql = "UPDATE sajilo_user SET email = '$this->staffEmail' WHERE uid = '$this->staffUID'";

			$sql1 = "UPDATE staff SET sfname='$this->staffFName', smname='$this->staffMName', slname='$this->staffLName', saddress = '$this->staffAddress', sphone = '$this->staffPhone', bid = '$this->bid' WHERE sid = '$this->staffID'";
			$r1 = $this->conn->query($sql);
			$r2 = $this->conn->query($sql1);

			return ($r1 && $r2)?TRUE:FALSE;
		}

		// delete staff record
		// since staff details stored in two tables
		// sajilo_user and staff
		// we can simply delete sajilo_user because
		// we implemented ON DELETE CASCADE for foreign key

		function deleteStaff() {
			$sql = "DELETE FROM sajilo_user WHERE uid = '$this->staffUID'";
			$result = $this->conn->query($sql);
			return $result;
		}

		// to check phone number exists in database or not
		function checkPhone() {
			$sql = "SELECT * FROM staff WHERE sphone='$this->staffPhone'";
			$result = $this->conn->query($sql);
			return (mysqli_num_rows($result) > 0)?0:1;
		}

		function updatePhotoPath() {
			$sql = "UPDATE staff SET sphoto = '$this->staffPhoto' WHERE sid = '$this->staffID'";

			$result = $this->conn->query($sql);
			return $result;
		}

		// random password generator
		function randomPassword() {
		    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@$';
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		    for ($i = 0; $i < 6; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass); //turn the array into a string
		}

	}
?>