<?php  
	class CommonValidation {
		// reusable method for basic form validation
		
		function validateName($name) {
			if(!preg_match ('/^[a-z]*$/i', $name)) {
				return false;
			}
			return true;
		}

		function validateNumber($pweight, $plength, $pbreadth, $pheight, $pprice) {
			$ref = new ReflectionMethod($this,__FUNCTION__);
			foreach($ref->getParameters() as $parameter) {
				$name = $parameter->getName();
				if((!is_numeric(${$name})) || ${$name} < 0)
					return $name."Error";
			}
			return true;
		}

		function validateReferenceNumber($refnum) {
			if(!preg_match("/^[A-Za-z0-9-]+$/", $refnum)) {
				return false;
			}
			return true;
		}


		function validateData($add, $email, $contact, $name = null, $country = null) {

			// check valid name which allows space and character only
			if(!($name === null)) {
				if (ctype_alpha(str_replace(' ', '', $name)) === false) { 
				return 'invalidbname';
				}
			}

			// check for valid address 
			if(!preg_match("/[A-Za-z0-9\-\\,.]+/", $add)) {
				return 'invalidbadd';
			}

			// check for valid email 
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return 'invalidemail';
			}

			// check for valid phone number
			if(!preg_match("/^[6-9][0-9]{9}$/", $contact)) {
				 return 'invalidcontact';
			}

			// check country is selected
			if(!($country === null)) {
				if($country === '' || $country === 'Choose...') {
					return 'selectcountry';
				}
			}

			return true;
		}

		function validateStatusChange($refnum, $remarks, $cstatus) {

			$status = array('pickup','in-transit','shipped','outfordelivery','arrived', 'delivered');

			if(!preg_match("/^[A-Za-z0-9-]+$/", $refnum)) {
				return "invalidRef";
			}

			if(!in_array($cstatus, $status)) {
				return "invalidStat";
			}

			if(preg_match("/^[\.a-zA-Z0-9,! ]*$/", $remarks)) {
				if(!(strlen($remarks) <= 200)) {
					return "lengthError";
				}
			} else {
				return "invalidChar";
			}

			return true;
		}
	}
?>