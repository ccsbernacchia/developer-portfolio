<?php

/**
 * Adds the song vote list to the form - parse database and shows dropdown list
 * 
 *
 * @package:
 * @subpackage: 
 * @author: Simone Bernacchia <simonebernacchia@gmail.com>
 * @date:
 *
 */


include(/*mysql connection file*/); 
include(/*config file*/);  //the config file contains the $song_voter_campaign_table and the $voteCampaignId variables 

$voteSongList = '';
	
$voteSongList	.='<select id="custom-select-menu" class="dropdown scrollable">'.chr(13);


$voteSongList	.='<option value="" class="label">SELECT YOUR FAVORITE SONG</option>'.chr(13);


$sql000 = "SELECT id, date_creation, date_start, date_end, campaign_active, cc_contest_id, campaign_description, campaign_title, campaign_songlist FROM $song_voter_campaign_table WHERE id = $voteCampaignId LIMIT 1";

$res000 = mysql_query($sql000) or die('sql000 query error:  '.mysql_error().' - debug: query: '.$sql000.' - please notify development');
$num000 = mysql_num_rows($res000);

if($num000 >0){

	$row000 = mysql_fetch_assoc($res000);

	$voteSongListArr 			= 		explode('|',$row000['campaign_songlist']);
	$beg_date 					= 		$row000['date_start'];
	$end_date					=		$row000['date_end'];
	$voteContest				=		$row000['campaign_active'];
	$form_status				=		$row000['campaign_active'];
	$campaign_description		=		$row000['campaign_description'];
	$campaign_title				=		$row000['campaign_title'];


	//populate song list dropdown
	foreach($voteSongListArr as $i=>$value){
	
	$voteSongList.='<option value="'.$i.'">'.$voteSongListArr[$i].'</option>'.chr(13);
	
	} //end foreach
	
	
} else {

die('Please check Config Parameters');

} //end if num

$voteSongList.='</select>'.chr(13);
?>