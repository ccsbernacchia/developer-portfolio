<?php

/**
 * responder for an AJAX function
 * will check that the email address is valid and that the user did not participate in $deltaInDays days.
 *
 * @package:
 * @subpackage: 
 * @author: Simone Bernacchia <simonebernacchia@gmail.com>
 * @date:
 *
 */


include('includes/function_toolbox.php');

$valid = 1;

include(/*mysql connection file*/); 
include(/*config file*/);  //the config file contains the $databaseCompareTable, the $deltaInDays and the $instantPrizeCampaignId variables 


$rightNow = date('Y-m-d h:m:s');



$mailToCheck = sanitize($_REQUEST['mailAddress'],1);

//check the email address using the isValidEmail function contained in function_toolbox.php

if($mailToCheck === '' || $mailToCheck === null || !isValidEmail($mailToCheck)){
	$valid = 0;
	$rsql = '['.$mailToCheck.']- not a valid email';
} //end if



if($valid == 1){


	$sql01 = "SELECT email_address, date FROM $databaseCompareTable WHERE email_address = '$mailToCheck' AND TIMESTAMPDIFF(DAY, date, '$rightNow' ) < $deltaInDays AND campaign_id = $instantPrizeCampaignId";
	
	$res01 = mysql_query($sql01) or die('sql01 query error:  '.mysql_error().' - debug: query: '.$sql01.' - please notify development');
	
	$num01 = mysql_num_rows($res01);
	
	
	switch($num01){
		case 0:
			$result = 0;
		break;
		
		case -1:
			$result = -1;
		break;
		
		case 1:
		default:
			
			$result = 1;		
		break;
	
	} //end if

	$rsql = $sql01;
	
} else {

	$result = -1;
} //end if




print $result;



?>