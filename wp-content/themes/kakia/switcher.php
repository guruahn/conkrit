<?php
session_start();
//$pp_url = 'http://themes.themegoods.com/poseidon_wp/';
$pp_url = 'http://localhost';

if(isset($_GET['pp_skin']))
{
	$_SESSION['pp_skin'] = $_GET['pp_skin'];
}

if(isset($_GET['pp_theme_layout']))
{
	$_SESSION['pp_theme_layout'] = $_GET['pp_theme_layout'];
}

if(isset($_GET['pp_skin']))
{
	$_SESSION['pp_skin'] = $_GET['pp_skin'];
}

if(isset($_GET['pp_home_style']))
{
	$_SESSION['pp_home_style'] = $_GET['pp_home_style'];
	header( 'Location: '.$pp_url ) ;
	exit;
}

if(isset($_GET['reset']))
{
	session_destroy();
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>