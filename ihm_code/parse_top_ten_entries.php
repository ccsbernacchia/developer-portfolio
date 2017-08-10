<?php

/**
 * Top-Ten votes list for the Votes engine - 
 * interrogate the voter table then shows ten most voted authors
 *
 * @package:
 * @subpackage: 
 * @author: Simone Bernacchia <simonebernacchia@gmail.com>
 * @date:
 *
 */

include(/*mysql connection file*/); 
include(/*config file*/);  //the config file contains the $song_voter_campaign_table and the $voteCampaignId variables 
 
$topChart = '';

$topChart.='<ol type="1" class="listenerPicks">'; 
 
$topTenChart = array(); 
 
 
$sql12 = "SELECT campaign_songlist FROM $song_voter_campaign_table WHERE id = $voteCampaignId LIMIT 1"; 

$res12 = mysql_query($sql12) or die('sql12 query error:  '.mysql_error().' - debug: query: '.$sql12.' - please notify development');

$row12 = mysql_fetch_assoc($res12);

$campaignSongsArray = explode('|',$row12['campaign_songlist']);

foreach($campaignSongsArray as $s=>$value){

	$sql1 = "SELECT COUNT(song) AS totnum, id,song, campaign_id FROM $song_voter_votes_table WHERE campaign_id = $voteCampaignId AND song = $s AND banned = 0 ORDER BY totnum DESC";

	$res1 = mysql_query($sql1) or die('sql1 query error:  '.mysql_error().' - debug: query: '.$sql1.' - please notify development');









		$chartName = $campaignSongsArray[$s];



		while($row1 = mysql_fetch_assoc($res1)){

			array_push($topTenChart, array(	'song'	=>	$chartName,
												'votes'	=>	$row1['totnum'],
			
												));	
			
			
		} // end while








} //end foreach




		$topTenChart2 =	array();
		
		
	
foreach ($topTenChart as $key => $row)
{
    $topTenChart2[$key] = $row['votes'];
    $topTenChart3[$key] = $row['song'];
}
array_multisort($topTenChart2, SORT_DESC, $topTenChart, SORT_DESC);
		
//print_r($topTenChart2); //debug

			
foreach($topTenChart2 as $t=>$value){
			$topChart .='<li title ="'.$topTenChart3[$t].' - '.$topTenChart2[$t].' votes">'.$topTenChart3[$t].'</li>'.chr(13);

}
			
			
			
$topChart.='</ul>'.chr(13);

print $topChart;


?>