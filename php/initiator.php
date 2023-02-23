<?php 
@session_start();
//sessionChecker
if(!isset($_SESSION['username']))
{
	 header("Location: ./login.php");               
}

if($_SESSION['role']==1)
{
	require_once './php/functionController2.php';
}else{
	include_once 'funct.php';
	$functioner = new funct();
	$reps = $functioner->getAdmReports();
}


