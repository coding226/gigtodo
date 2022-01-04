<?php

session_start();
require_once("includes/db.php");
if (!isset($_SESSION['seller_user_name'])) {
	echo "<script>window.open('login','_self');</script>";
}

$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers", array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;

$proposal_id = $_SESSION['c_proposal_id'];
$proposal_qty = $_SESSION['c_proposal_qty'];
$amount = $_SESSION["c_sub_total"];
$update_buyer_balance = $db->query("update seller_accounts set used_purchases=used_purchases+:plus,current_balance=current_balance-:minus where seller_id='$login_seller_id'", array("plus" => $amount, "minus" => $amount));
if ($update_buyer_balance) {
	$_SESSION['checkout_seller_id'] = $login_seller_id;
	$_SESSION['proposal_id'] = $proposal_id;
	$_SESSION['proposal_qty'] = $proposal_qty;
	$_SESSION['proposal_price'] = $amount;
	$_SESSION['proposal_delivery'] = $_SESSION['c_proposal_delivery'];
	$_SESSION['proposal_revisions'] = $_SESSION['c_proposal_revisions'];
	if (isset($_SESSION['c_proposal_extras'])) {
		$_SESSION['proposal_extras'] = $_SESSION['c_proposal_extras'];
	}
	if (isset($_SESSION['c_proposal_minutes'])) {
		$_SESSION['proposal_minutes'] = $_SESSION['c_proposal_minutes'];
	}
	$_SESSION['method'] = "token";
	echo "<script>window.open('order','_self');</script>";
}
?>