<?php

/**
 * Add vote to the song contest
 *
 * @package:
 * @subpackage: 
 * @author: Simone Bernacchia <simonebernacchia@gmail.com>
 * @date:
 *
 */


$is_Admin = 1;



 //include function toolbox
include(/*config file*/);  //the config file contains the $song_voter_campaign_table, the $song_voter_votes_table and the $voteCampaignId variables 	
include('includes/function_toolbox.php'); //functions for data sanitizing




	// connect to mysql
include(/*mysql connection file*/); 




$voteTo = sanitize($_POST['song'],1);
$voteType = sanitize($_POST['tp'],1);
$today = date('Y-m-d H:i:s');
$campaignId = sanitize($_POST['cid'],1);
$myIp = $_SERVER['REMOTE_ADDR'];



// check votes from same source and ban the user if votes for more than x time in a minute -- TODO



$banned = 0; // will be set by the result of the query


$sql02 = "SELECT banned FROM $song_voter_votes_table WHERE ip_address = '$myIp' AND banned = 1";


$res02 = mysql_query($sql02) or die('sql001 query error:  '.mysql_error().' - debug: query: '.$sql02.' - please notify development');


$row02 = mysql_num_rows($res02);

if($row02 <=0){






// if good record data

$sql0 = "INSERT INTO $song_voter_votes_table (
					id,
					date,
					campaign_id,
					ip_address,
					vote_type,
					email,
					banned,
					song
						
					) VALUES(
					NULL,
					'".$today."',
					$campaignId,
					'$myIp',
					'$voteType',
					NULL,
					$banned,
					$voteTo
					)";
			

$res0 = mysql_query($sql0) or die('sql0 query error:  '.mysql_error().' - debug: query: '.$sql0.' - please notify development');

setcookie("contest", 'voted', time()+3600);  /* expire in 1 hour */


print 'ok';

 } else {
 
setcookie("contest", 'ban');  /* expire in 1 hour */ 
 
print 'ban'; 
 
 } //end if row02


?>