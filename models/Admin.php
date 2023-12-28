<?php 
	class Admin {

		/**** Data Members and their getters and setters. ****/

		 // data members
		 private $adminID;
		 private $adminFName;
		 private $adminMName;
		 private $adminLName;
		 private $adminAddress;
		 private $adminPhone;
		 private $adminPhoto;
		 private $conn;

		function __construct(){
			// database connectivity
			require_once "service/Config.php";
			$this->conn = Config::getConnection();
		}

		 // public getters and setters for private data members
		 public function setAdminID($adminID) {
		 	$this->adminID = $adminID;
		 }

		 public function getAdminID() {
		 	return $this->adminID;
		 }

		 public function setAdminFName($adminFName) {
		 	$this->adminFName = $adminFName;
		 }

		 public function getAdminFName() {
		 	return $this->adminFName;
		 }

		 public function setAdminMName($adminMName) {
		 	$this->adminMName = $adminMName;
		 }

		 public function getAdminMName($adminMName) {
		 	return $this->$adminMName;
		 }

		 public function setAdminLName($adminLName) {
		 	$this->adminLName = $adminLName;
		 }

		 public function getAdminLName() {
		 	return $this->adminLName;
		 }

		 public function getFullName() {
		 	return $this->adminFName.$this->adminMName.$this->adminLName;
		 }

		 public function setAdminAdress($adminAddress) {
		 	$this->adminAddress = $adminAddress;
		 }

		 public function getAdminAddress() {
		 	return $this->adminAddress;
		 }

		 public function setAdminPhone($adminPhone) {
		 	$this->adminPhone = $adminPhone;
		 }

		 public function getAdminPhone() {
		 	return $this->adminPhone;
		 }

		 public function setAdminPhoto($adminPhoto) {
		 	$this->adminPhoto = $adminPhoto;
		 }

		 public function getAdminPhoto() {
		 	return $this->adminPhoto;
		 }

		 function getAdminName() {
		 	$sql = "SELECT afname, amname, alname FROM admin WHERE aid = '$this->adminID'";
		 	$res = $this->conn->query($sql);

		 	$row = $res->fetch_assoc();

		 	return $row['afname']." ".$row['amname']." ".$row['alname'];
		 }
	}

?>