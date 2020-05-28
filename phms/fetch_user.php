<?php

//fetch_user.php

include('database_connection.php');
// doc_status 1 means the user should see only the doctors in the Chat. And the doctors should not see the different doctors present online.
// doc_status 0 means the particular user is a simple user/patient and is not a doctor. At the patient side the code will slighlty differ.
session_start();
$doc_status = 1;
$query = "
SELECT * FROM login
WHERE user_id != '".$_SESSION['user_id']."'
and doc_status='$doc_status'";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="70%">Doctors</td>
		<th width="20%">Status</td>
		<th width="10%">Action</td>
	</tr>
';

foreach($result as $row)
{
	$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
// 	echo $user_last_activity;
// 	echo "<br>".$current_timestamp;
	if($user_last_activity > $current_timestamp)
	{
		$status = '<span class="label label-success">Online</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .= '
	<tr>
		<td>Dr. '.$row['name'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
		<td>'.$status.'</td>
		<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['name'].'">Start Chat</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>
