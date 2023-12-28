<?php  
	class ParcelHistory {
		private $phno;
		private $phremarks;
		private $phstatus;
		private $phdate;
		private $pid;

		public function setPHNo($phno) {
			$this->phno = $phno;
		}

		public function getPHNo() {
			return $this->phno;
		}

		public function setPHRemarks($phremarks) {
			$this->phremarks = $phremarks;
		}

		public function getPHRemarks() {
			return $this->phremarks;
		}

		public function setPHStatus($phstatus) {
			$this->phstatus = $phstatus;
		}

		public function getPHStatus() {
			return $this->phstatus;
		}

		public function setPHDate($phdate) {
			$this->phdate = $phdate;
		}

		public function getPHDate() {
			return $this->phdate;
		}

		public function setPID($pid) {
			$this->pid = $pid;
		}

		public function getPID() {
			return $this->pid;
		}
	}
?>