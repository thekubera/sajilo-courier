<?php  
	class Customer {
		private $cid;
		private $cname;
		private $cadd;
		private $cemail;
		private $cphone;

		public function setCID($cid) {
			$this->cid = $cid;
		}

		public function getCID() {
			return $this->cid;
		}

		public function setCName($cname) {
			$this->cname = $cname;
		}

		public function getCName() {
			return $this->cname;
		}

		public function setCAddress($cadd) {
			$this->cadd = $cadd;
		}

		public function getCAddress() {
			return $this->cadd;
		}

		public function setCEmail($cemail) {
			$this->cemail = $cemail;
		}

		public function getCEmail() {
			return $this->cemail;
		}

		public function setCPhone($cphone) {
			$this->cphone = $cphone;
		}

		public function getCPhone() {
			return $this->cphone;
		}
	}
?>