<?php  
	class SenderController {
		private $sender;

		function __construct(){
  	   	  require_once "models/Sender.php";

  	   	  $this->sender = new Sender();
  	   	}
		
		function getSender($refnum) {
			$this->sender->setRefNum($refnum);
			
			return $this->sender->getSender();
		}
	}
?>