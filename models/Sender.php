<?php  
	class Sender {
		private $sid;
		private $sbname;
		private $scountry;
		private $cid;
		private $refnum;
		private $conn;

		function __construct(){
			// database connectivity
			require_once "service/Config.php";
			$this->conn=Config::getConnection();
		}

		public function setSID($sid) {
			$this->sid = $sid;
		}

		public function getSID() {
			return $this->sid;
		}

		public function setSBName($sbname) {
			$this->sbname = $sbname;
		}

		public function getSBName() {
			return $this->sbname;
		}

		public function setSCountry() {
			$this->scountry = $scountry;
		}

		public function getSCountry() {
			return $this->scountry;
		}

		public function setRefNum($refnum) {
			$this->refnum = $refnum;
		}

		public function getRefNum() {
			return $this->refnum;
		}

		function getSender() {
			$sql = "SELECT prefnum,cname,cadd,cphone,sbname,scountry FROM parcel,sender,customer WHERE parcel.sid = sender.sid AND sender.cid = customer.cid AND parcel.prefnum = '$this->refnum'";

			$result = $this->conn->query($sql);
        	return $result;
		}

	}
?>