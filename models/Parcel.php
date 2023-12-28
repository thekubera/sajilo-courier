<?php  
	class Parcel {
		private $pid;
		private $refNum;
		private $pdlength;
		private $pdbreadth;
		private $pdheight;
		private $pweight;
		private $pPrice;
		private $pstatus;
		private $premarks;
		//private $staffID;
		private $senderID;
		private $receiverID;
		private $conn;

		private $sname;
		private $sadd;
		private $semail;
		private $sphone;
		private $sbranch;
		private $scountry;

		private $rname;
		private $radd;
		private $remail;
		private $rphone;
		private $rbranch;
		private $rcountry;

		private $staffID;


		function __construct(){
			// database connectivity
			require_once "service/Config.php";
			$this->conn=Config::getConnection();
		}

		public function setPID($pid) {
			$this->pid = $pid;
		}

		public function getPID() {
			return $this->pid;
		}

		public function setRefNum($refNum) {
			$this->refNum = $refNum;
		}

		public function getRefNum() {
			return $this->refNum;
		}

		public function setPDLength($pdlength) {
			$this->pdlength = $pdlength;
		}

		public function getPDLength() {
			return $this->pdlength;
		}

		public function setPDBreadth($pdbreadth) {
			$this->pdbreadth = $pdbreadth;
		}

		public function getPDBreadth() {
			return $this->pdbreadth;
		}

		public function setPDHeight($pdheight) {
			$this->pdheight = $pdheight;
		}

		public function getPDHeight() {
			return $this->pdheight;
		}

		public function setPWeight($pweight) {
			$this->pweight = $pweight;
		}

		public function getPWeight() {
			return $this->pweight;
		}

		public function setParcelPrice($pPrice) {
			$this->pPrice = $pPrice;
		}

		public function getParcelPrice() {
			return $this->pPrice;
		}

		public function setParcelStatus($status) {
			$this->pstatus = $status;
		}

		public function getParcelStatus() {
			return $this->pstatus;
		}
 
		public function setParcelRemarks($premarks) {
			$this->premarks = $premarks;
		}

		public function getParcelRemarks() {
			return $this->premarks;
		}

		public function setSenderID($senderID) {
			$this->senderID = $senderID;
		}

		public function getSenderID() {
			return $this->senderID;
		}

		public function setSenderName($sname) {
			$this->sname = $sname;
		}

		public function getSenderName() {
			return $this->sname;
		}

		public function setSenderAddress($sadd) {
			$this->sadd = $sadd;
		}

		public function getSenderAddress() {
			return $this->sadd;
		}

		public function setSenderEmail($semail) {
			$this->semail = $semail;
		}

		public function getSenderEmail() {
			return $this->semail;
		}

		public function setSenderPhone($sphone) {
			$this->sphone = $sphone;
		}

		public function getSenderPhone() {
			return $this->sphone;
		}

		public function setSenderBranch($sbranch) {
			$this->sbranch = $sbranch;
		}

		public function getSenderBranch() {
			return $this->sbranch;
		}

		public function setSenderCountry($scountry) {
			$this->scountry = $scountry;
		}

		public function getSenderCountry() {
			return $this->scountry;
		}

		public function setReceiverID($receiverID) {
			$this->receiverID = $receiverID;
		}

		public function getReceiverId() {
			return $this->receiverID;
		}

		public function setReceiverName($rname) {
			$this->rname = $rname;
		}

		public function getReceiverName() {
			return $this->rname;
		}

		public function setReceiverAddress($radd) {
			$this->radd = $radd;
		}

		public function getReceiverAddress() {
			return $this->radd;
		}

		public function setReceiverEmail($remail) {
			$this->remail = $remail;
		}

		public function getReceiverEmail() {
			return $this->remail;
		}

		public function setReceiverPhone($rphone) {
			$this->rphone = $rphone;
		}

		public function getReceiverPhone() {
			return $this->rphone;
		}

		public function setReceiverBranch($rbranch) {
			$this->rbranch = $rbranch;
		}

		public function getReceiverBranch() {
			return $this->rbranch;
		}

		public function setReceiverCountry($rcountry) {
			$this->rcountry = $rcountry;
		}

		public function getReceiverCountry() {
			return $this->rcountry;
		}

		public function setStaffID($sid) {
			$this->staffID = $sid;
		}

		public function getStaffID() {
			return $this->staffID;
		}

		function fetchParcel($type) {
			$sql = "SELECT DISTINCT p.pid as pid, prefnum, getSender(prefnum) AS sender, getReceiver(prefnum) AS receiver, getCreatedDate(p.pid) AS c_date FROM parcel AS p,history AS h WHERE p.pid = h.pid AND pstatus = '$type' ORDER BY p.pid DESC";

			$result = $this->conn->query($sql);
           	return $result;
		}

		function getParcelBasedOnRef() {
			$sql = "SELECT pdlength,pdbreadth,pdheight,pweight,pprice,pstatus FROM parcel WHERE prefnum = '$this->refNum'";

			$result = $this->conn->query($sql);
           	return $result;
		}

		function getParcelDateBasedOnRef() {
			$sql = "SELECT MIN(phdate) AS phdate FROM history WHERE pid = (SELECT pid FROM parcel WHERE prefnum = '$this->refNum')";

			$result = $this->conn->query($sql);
			$date = $result->fetch_assoc();
			return $date['phdate'];
		}

		function getHistoryBasedOnRef() {
			$sql = "SELECT phdate,phremarks,phstatus FROM parcel,history WHERE parcel.pid = history.pid AND parcel.prefnum = '$this->refNum'";

			$result = $this->conn->query($sql);
           	return $result;
		}

		function addParcel() {
			// it should do following things
			// Call methods to generate random reference number
			// store details to database 
			// send initial email to customer about parcel info 	and tracking

			// generate random reference number
			$this->refNum = $this->generateReferenceNumber();
			

			$sql = "INSERT INTO customer (cname,cadd,cemail,cphone) VALUES ('$this->sname','$this->sadd','$this->semail','$this->sphone');";

			$sql1 = "SET @scustomer_id = LAST_INSERT_ID();";

			$sql2 = "INSERT INTO customer (cname,cadd,cemail,cphone) VALUES ('$this->rname','$this->radd','$this->remail','$this->rphone');";

			$sql3 = "SET @r_id = LAST_INSERT_ID();";

			$sql4 = "INSERT INTO sender(sbname,scountry,cid) VALUES ('$this->sbranch', '$this->scountry',@scustomer_id);";

			$sql5 = "SET @sender_id = LAST_INSERT_ID();";

			$sql6 = "INSERT INTO receiver(rbname,rcountry,cid) VALUES ('$this->rbranch', '$this->rcountry', @r_id);";

			$sql7 = "SET @receiver_id = LAST_INSERT_ID();";

			$sql8 = "INSERT INTO parcel(prefnum,pdlength,pdbreadth,pdheight,pweight,pprice,sid,rid,pstatus,staffID) VALUES ('$this->refNum','$this->pdlength', '$this->pdbreadth', '$this->pdheight', '$this->pweight', '$this->pPrice' ,@sender_id, @receiver_id, 'pickup','$this->staffID');";

			$sql9 = "SET @parcel_id = LAST_INSERT_ID();";


			$sql10 = "INSERT INTO history(phremarks,phstatus,pid) VALUES ('$this->premarks', 'pickup', @parcel_id);";

			// now execute the queries
			$this->conn->query("START TRANSACTION;");

			$r1 =  $this->conn->query($sql);
			$r2 =  $this->conn->query($sql1);
			$r3 =  $this->conn->query($sql2);
			$r4 =  $this->conn->query($sql3);
			$r5 =  $this->conn->query($sql4);
			$r6 =  $this->conn->query($sql5);
			$r7 =  $this->conn->query($sql6);
			$r8 =  $this->conn->query($sql7);
			$r9 =  $this->conn->query($sql8);
			$r10 = $this->conn->query($sql9);
			$r11 = $this->conn->query($sql10);

			// if all quaries are executed then commit
			// otherwise rollback to previous stage
			if($r1 && $r2 && $r3 && $r4 && $r5 && $r6 && $r7 && $r8 && $r9 && $r10 && $r11) {
				// now send the mail and commit it
				//$this->sendParcelMail();
				$this->conn->query("COMMIT;");
				return true;
			} else {
				$this->conn->query("ROLLBACK;");
				return false;
			}

		}

		function countCourierBasedOnStatus() {
			$sql = "SELECT COUNT(pid) as total_courier FROM parcel GROUP BY pstatus HAVING pstatus = '$this->pstatus'";
			$res = $this->conn->query($sql);
			if(mysqli_num_rows($res) === 1) {
				$row = $res->fetch_assoc();
				return $row['total_courier'];
			}
			return 0;
		}

		function totalCourierCount() {
			$sql = "SELECT COUNT(pid) as total_courier from parcel";
			$res = $this->conn->query($sql);
			if(mysqli_num_rows($res) === 1) {
				$row = $res->fetch_assoc();
				return $row['total_courier'];
			}
			return 0;
		}

		function checkParcelBasedOnRef() {
			$sql = "SELECT pid FROM parcel WHERE prefnum='$this->refNum' AND pstatus <> 'delivered'";
			$res = $this->conn->query($sql);
			return (mysqli_num_rows($res) === 1)?1:0;
		}

		function checkParcelExistence() {
			$sql = "SELECT pid from parcel where prefnum = '$this->refNum'";
			$res = $this->conn->query($sql);
			return (mysqli_num_rows($res) === 1)?1:0;
		}

		function checkCurrentStatus() {
			$sql = "SELECT p.pid FROM parcel AS p, history AS h WHERE p.pid = h.pid AND p.prefnum = '$this->refNum' AND h.phstatus = '$this->pstatus'";

			$res = $this->conn->query($sql);
			return (mysqli_num_rows($res) > 0)?0:1;
		}

		function getParcelIdBasedOnRef($prefnum) {
			$sql = "SELECT pid FROM parcel WHERE prefnum = '$prefnum'";
			$res = $this->conn->query($sql);
			$pid = $res->fetch_assoc();
			return $pid['pid'];
		}

		function updateStatus() {
			$pid = $this->getParcelIdBasedOnRef($this->refNum);

			$sql = "UPDATE parcel SET pstatus='$this->pstatus' WHERE prefnum = '$this->refNum'";

			$sql1 = "INSERT INTO history (pid,phremarks,phstatus) VALUES('$pid', '$this->premarks', '$this->pstatus')";

			$this->conn->query("START TRANSACTION;");

			$r1 = $this->conn->query($sql);
			$r2 = $this->conn->query($sql1);

			if($r1 && $r2) {
				$this->conn->query("COMMIT;");
				return true;
			} else {
				$this->conn->query("ROLLBACK;");
				return false;
			}
		}

		function getReport() {
			$sql = "SELECT bname, COUNT(DISTINCT parcel.pid) AS total_courier, SUM(pprice) AS total_price FROM branch, staff, parcel, history WHERE branch.bid = staff.bid AND staff.sid = parcel.staffID GROUP BY branch.bid";
			$result = $this->conn->query($sql);
			return $result;
		}


		function generateReferenceNumber() {
		    return sprintf( '%04X-%04X-%04X-%04X',
		     	mt_rand(0,time()),
		        mt_rand( 0, 0x0C2f) | 0x3000,
		        mt_rand( 0, 0x3fff)  | 0x800,
		        mt_rand(0, 0x7fff) | 0x900
		    );
		}

		// mail for customer when courier is added
		// invoke it automatically when parcel is added
		function sendParcelMail() {
			$to = $this->remail;
			$subject = "Your Courier is picked up.";
			$from = "yourmailAddress";

			// to send mail with HTML tag
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// creating email headers
			$headers .= 'From: ' .$from."\r\n".
				'Reply-To: '.$from."\r\n".
				'X-Mailer: PHP/'. phpversion();

			// compose a message
			$message = '<html><body>';
			$message .= "<p>Hi '$this->rname'!, </h1><br/>";
			$message .= "<p>Your courier is picked up at '$this->sbranch'. You can track your product with reference number: '$this->refNum' from our website www.sajilocourier.com.</p><br/>";
			$message .= "Thank You! for choosing Sajilo Courier.";

			$message .= '</body></html>';

			// you can check whether mail is sent or not
			// with if condition and you can deny to adding parcel before committing it
			mail($to, $subject, $message, $headers);
		}

	}
?>