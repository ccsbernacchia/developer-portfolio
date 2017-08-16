<?php

/**
 * Share counter
 * Upon clicking a 'share' button
 * this script will create a new share count if user email is not there or update the existing one
 *
 * @package:	
 * @author:		Simone Bernacchia <simonebernacchia@gmail.com>
 * @date:
 * @version: 
 *
 */

 

$ok = 0;

 //include function toolbox
include('includes/function_toolbox.php');


include(/*mysql connection file*/); 
include(/*config file*/);  //the config file contains the $databaseShares and the $contest_id variable


$email = sanitize($_REQUEST['mail'],1);

$sql = "SELECT email_address,share_count FROM `$databaseShares` WHERE email_address = '".$email."' AND contest_id = '$contest_id' ORDER BY id ASC LIMIT 1";

//print 'query: '.$sql.'<br/>';

$res = mysql_query($sql) or die('sql query problem! Query: "'.$sql.'" - error:'.mysql_error() );

$numrows = mysql_num_rows($res);

//print 'rows found:'.$numrows.'<br/>';
//parse results
if($numrows >0 ){

	$row0 = mysql_fetch_array($res);
	$shareCount 	=	$row0['share_count'];
	$shareCount++;

	$sql00 = "UPDATE $databaseShares SET share_count = $shareCount WHERE email_address = '".$email."' AND contest_id = '".$contest_id."' ";


	$res00 = mysql_query($sql00) or die('sql query problem! Query: "'.$sql.'" - error:'.mysql_error() );

	$num00 = mysql_affected_rows();
	
	if($num00 > 0){
		$ok=1;
	} //end if

} else {

		$sql00 = "INSERT INTO $databaseShares (	id,
													contest_id,
													email_address,
													share_count)
												VALUES
												(	NULL,
													'$contest_id',
													'$email',
													1) ";


	$res00 = mysql_query($sql00) or die('sql query problem! Query: "'.$sql.'" - error:'.mysql_error() );

	$num00 = mysql_affected_rows();
	
	if($num00 > 0){
		$ok=1;
	} //end if


} //end if

if($ok == 1){
	print 'ok';

} else {

	print 'error';
} //end if


?>