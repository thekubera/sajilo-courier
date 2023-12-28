<?php  
	class ReceiverController {
		private $receiver;

		function __construct(){
  	   	  require_once "models/Receiver.php";

  	   	  $this->receiver = new Receiver();
  	   	}

  	   	function getReceiver($refnum) {
  	   		$this->receiver->setRefNum($refnum);

  	   		return $this->receiver->getReceiver();
  	   	}
	}
?>