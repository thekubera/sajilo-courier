<?php  
	class Receiver {
		private $rid;
		private $rbname;
		private $rcountry;
		private $cid;
		private $refnum;
		private $conn;

		function __construct(){
			// database connectivity
			require_once "service/Config.php";
			$this->conn=Config::getConnection();
		}

		public function setRID($rid) {
			$this->rid = $rid;
		}

		public function getRID() {
			return $this->rid;
		}

		public function setRBName($rbname) {
			$this->rbname = $rbname;
		}

		public function getRBName() {
			return $this->rbname;
		}

		public function setRCountry() {
			$this->rcountry = $rcountry;
		}

		public function getRCountry() {
			return $this->rcountry;
		}

		public function setCID($cid) {
			$this->cid = $cid;
		}

		public function getCID() {
			return $this->cid;
		}

		public function setRefNum($refnum) {
			$this->refnum = $refnum;
		}

		public function getRefNum() {
			return $this->refnum;
		}

		function getReceiver() {
			$sql = "SELECT cname,cadd,cphone,rbname,rcountry FROM parcel,receiver,customer WHERE parcel.rid = receiver.rid AND receiver.cid = customer.cid AND parcel.prefnum = '$this->refnum'";

			$result = $this->conn->query($sql);
        	return $result;
		}

	}
?>