<?php 
	class Branch {
		/**** Data Members and their getters and setters. ****/

		 // data members
		private $bid;
		private $branchName;
		private $branchAddress;
		private $branchPhone;
		private $branchEmail;
		private $branchCountry;
		private $uid; // to store user's id for permission 
		private $conn;

		function __construct(){
			// database connectivity
			require_once "service/Config.php";
			$this->conn = Config::getConnection();
		}

		// public getters and setters
		public function setBranchID($bid) {
			$this->bid = $bid;
		} 

		public function getBranchID() {
			return $this->bid;
		}

		public function setBranchName($branchName) {
			$this->branchName = $branchName;
		}

		public function getBranchName() {
			return $this->branchName;
		}

		public function setBranchAddress($branchAddress) {
			$this->branchAddress = $branchAddress;
		}

		public function getBranchAddress() {
			return $this->branchAddress;
		}

		public function setBranchPhone($branchPhone) {
			$this->branchPhone = $branchPhone;
		}

		public function getBranchPhone() {
			return $this->branchPhone;
		}

		public function setBranchEmail($branchEmail) {
			$this->branchEmail = $branchEmail;
		}

		public function getBranchEmail() {
			return $this->branchEmail;
		}

		public function setBranchCountry($branchCountry) {
			$this->branchCountry = $branchCountry;
		}

		public function getBranchCountry() {
			return $this->branchCountry;
		}

		public function setUID($uid) {
			$this->uid = $uid;
		}
		public function getUID() {
			return $this->uid;
		}

		// to fetch all branch details
		function selectAllRecords() {
			$sql= "SELECT branch.bid,bname,baddress,bemail,bphone,bcountry FROM branch, admin,admin_branch WHERE admin.aid = admin_branch.aid AND admin_branch.bid = branch.bid AND admin.aid = '{$this->getUID()}' ORDER BY branch.bid DESC";
			
           	$result = $this->conn->query($sql);
           	return $result;
		}

		function selectAllBranch() {
			$sql = "SELECT bname,baddress,bemail,bphone,bcountry FROM branch ORDER BY bid DESC";
			$result = $this->conn->query($sql);
           	return $result;	
		}

		// check branch name
		function checkBranchName($bid) {
			$sql = "SELECT bname FROM branch WHERE bid = '$bid'";
			$result = $this->conn->query($sql);
			
			return $result;
		}

		// fetch branch details by ID
		function selectByID() {

			$sql = "SELECT * FROM branch WHERE bid ='{$this->getBranchID()}'";

			$result = $this->conn->query($sql);

			return $result;
		}

		// fetch branch id and name based on admin insertion
		// only fetches branch inserted by particular admin
		function fetchBranchInfo() {
			$sql = "SELECT branch.bid, branch.bname FROM branch, admin,admin_branch WHERE admin.aid = admin_branch.aid AND admin_branch.bid = branch.bid AND admin.aid = '{$this->getUID()}'";

			$result = $this->conn->query($sql);
			return $result;
		}

		// fetchBranch info for staff
		// branch where staff works
		function fetchStaffBranch($uid) {
			$sql = "SELECT branch.bid AS bid, branch.bname AS bname FROM branch,staff WHERE branch.bid = staff.bid AND staff.uid = '$uid'";
			$result = $this->conn->query($sql);
			return $result;
		}

		// general method for fetching branch id and name
		// each and every branch name and id will be fetched

		function fetchBranch() {
			$sql = "SELECT bid, bname FROM branch";
			
			$result = $this->conn->query($sql);
			return $result;
		}

		// insert branch method
		function insertBranch() {
			$sql = "INSERT INTO branch (bname, baddress, bemail, bphone, bcountry) VALUES ('$this->branchName', '$this->branchAddress', '$this->branchEmail', '$this->branchPhone', '$this->branchCountry')"; 
			$sql1 = "SET @branch_id = LAST_INSERT_ID()";
			$sql2 = "INSERT INTO admin_branch (aid, bid) VALUES ('{$this->getUID()}', @branch_id)";
			//$result = $this->conn->query($sql);
			if($this->conn->query($sql) && $this->conn->query($sql1) && $this->conn->query($sql2)) {
				//return $result;
				return TRUE;	
			}
			return false;
        	
		}

		// update branch method
		function updateBranch() {
			$sql = "UPDATE branch SET bname = '$this->branchName', baddress = '$this->branchAddress', bemail = '$this->branchEmail', bphone = '$this->branchPhone', bcountry = '$this->branchCountry' WHERE bid = '$this->bid'";
			$result = $this->conn->query($sql);

			return $result;
		}

		// delete branch details
		function deleteBranch() {
			$sql = "DELETE FROM branch where bid = '$this->bid'";
			$result = $this->conn->query($sql);
			return $result;
		}
	}

?>