<?php 
require_once('../database/Database.php');
if(session_status() == PHP_SESSION_NONE)
{
	session_start();//start session if session not start
}
$db = new Database();

if(isset($_POST['acc']) && isset($_POST['tp'])){
	$_SESSION['accomodation'] = $_POST['acc'];
	$_SESSION['totalPass'] = $_POST['tp'];

	$acc_id = $_POST['acc'];
	$tp = $_POST['tp'];
	$dp_date = $_SESSION['departure_date'];
	$type=$_SESSION['accomodation'];

	$return['valid'] = true;
	$return['url'] = "passenger.php";
 $conn=mysqli_connect('localhost','root','','medallion');
$q= "SELECT acc_slot FROM accomodation WHERE acc_id='$type'";
$res=mysqli_query($conn,$q);
if(mysqli_num_rows($res)>0)
{
$r=mysqli_fetch_array($res);
$r2=$r['acc_slot'];
}

	$sql = "SELECT COUNT(*) as totalBooked
			FROM booked 
			WHERE acc_id = ?
			AND book_departure = ?
	";
	$result = $db->getRow($sql, [$acc_id, $dp_date]);
	// echo $result['totalBooked'];
	$slot = $r2 - $result['totalBooked'];	
	$slot = $slot - $tp;
	$wtf['slot'] = $slot;
	echo json_encode($wtf);
}//end isset