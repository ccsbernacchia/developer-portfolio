<?php

/**
 * Extract and assign a price
 * According to criterias in the DB a price will be extracted and assigned
 *
 * @package:
 * @subpackage: 
 * @author: Simone Bernacchia <simonebernacchia@gmail.com>
 * @date:
 *
 */


include('includes/function_toolbox.php');


$is_Admin = 1;

$valid = 1;

include(/*mysql connection file*/); 
include(/*config file*/);  //the config file contains the $databasePrizesTable, the $databaseCriteriaTable and the $instantPrizeCampaignId variables 

$emailAddress = sanitize($_REQUEST['mailAddress'],1);


$basePrizesArray = array();
$baseCriteriaArray = array();

$selectionArray = array();

$rightNow = date('Y-m-d h:m:s');

$sql00 = "SELECT	id,
					campaign_id,
					prize_display_description,
					prize_pic_url,
					prize_code,
					prize_type,
					prize_claimed,
					date_available,
					prize_available
					FROM $databasePrizesTable
					WHERE campaign_id = $instantPrizeCampaignId 
					AND date_available <= '$rightNow' 
					AND prize_available = 1
					AND prize_claimed = 0";

					
	$res00 = mysql_query($sql00) or die('sql00 query error:  '.mysql_error().' - debug: query: '.$sql00.' - please notify development');	

	
	
	while($row00 = mysql_fetch_assoc($res00) ){
		array_push($basePrizesArray, array(	'id'				=>	$row00['id'],
												'campaign_id'		=>	$row00['campaign_id'],
												'desc'				=>	$row00['prize_display_description'],
												'url'				=>	$row00['prize_pic_url'],
												'type'				=>	$row00['prize_type'],
												'code'				=>	$row00['prize_code'],
												'claimed'			=>	$row00['prize_claimed'],
												'date_available'	=>	$row00['date_available'],
												'prize_available'	=>	$row00['prize_available'],
											));
	
	
	} //end while
	

// extract criteria from DB

$sql01 = "SELECT	id,
					campaign_id,
					criteria_name,
					criteria_value
					FROM $databaseCriteriaTable
					WHERE campaign_id = $instantPrizeCampaignId";

$res01 = mysql_query($sql01) or die('sql01 query error:  '.mysql_error().' - debug: query: '.$sql01.' - please notify development');			
		while($row01 = mysql_fetch_assoc($res01) ){
		array_push($baseCriteriaArray , array(	'id'				=>	$row01['id'],
													'campaign_id'		=>	$row01['campaign_id'],
													'name'				=>	$row01['criteria_name'],
													'value'				=>	$row01['criteria_value'],

											));
	} //end while		



foreach($baseCriteriaArray as $i=>$value){
	foreach($basePrizesArray as $j=>$value){
		if($baseCriteriaArray[$i]['name'] == $basePrizesArray[$j]['id']){

			if($debug ==1){
				print'<p>we have a match: criteria:'.$baseCriteriaArray[$i]['name'].' - prize: '.$basePrizesArray[$j]['id'].'</p><br/>';
				print'<p>Criteria for id:'.$baseCriteriaArray[$i]['name'].' - value: '.$baseCriteriaArray[$i]['value'].'</p><br/>';
			} //end if
		
		
			$cnt = 0;
		
			while($cnt < $baseCriteriaArray[$i]['value']){
		//		for($k = 0; $k < ($baseCriteriaArray[$i]['value'])-1; $k++){
				
					if($basePrizesArray[$j]['type'] == 1){
					
					if($debug ==1){
						print'<p>prize type is 1</p><br/>';
					} //end if
					
						array_push($selectionArray,array(	'id'	=>	$basePrizesArray[$i]['id'],
																'type'	=>	$basePrizesArray[$i]['type'],		
																'desc'	=>	$basePrizesArray[$i]['desc'],
																'url'	=>	$basePrizesArray[$i]['url'],

						));
								
					
					
					} //end if 
					
						if($basePrizesArray[$j]['type'] == 2){
						
							if($debug ==1){
								print'<p>prize type is 2</p><br/>';
							} //end if
						
							if( $basePrizesArray[$j]['prize_available'] == 1 &&  strtotime($basePrizesArray[$j]['date_available']) <= $today && $basePrizesArray[$j]['claimed'] == 0 ){
						
							if($debug ==1){
								print'<p>prize type is 2, prize is available, time is elapsed and is not claimed</p><br/>';
							} //end if

									array_push($selectionArray,array(	'id'	=>	$basePrizesArray[$i]['id'],
																			'type'	=>	$basePrizesArray[$i]['type'],		
																			'desc'	=>	$basePrizesArray[$i]['desc'],
																			'url'	=>	$basePrizesArray[$i]['url'],

									));
							
					//	} else {
						
							} //end if basePrizesArray_type
						} //end if basePrizesArray_prize_available
					
						$cnt++;
					
			} //end while cnt

		} //end if
			
			

	} //end foreach basePrizesArray
} //end foreach baseCriteriaArray

if($debug == 1){
print'<h3>selection Array:</h3><br/>';
	print_r($selectionArray);
}


//extraction of the index to get the prize

$theCandidatesAre = count($selectionArray);
$theWinnerIs = rand(0,$theCandidatesAre);


//if is a prize cash claim it

/*
*/

if($selectionArray[$theWinnerIs]['type'] == 2){
	$sql02 = "UPDATE $databasePrizesTable SET prize_available = 0 WHERE id = ".$selectionArray[$theWinnerIs]['id']." AND campaign_id = $instantPrizeCampaignId";
	
		$res02 = mysql_query($sql02) or die('sql02 query error:  '.mysql_error().' - debug: query: '.$sql02.' - please notify development');

} //end if

$returnString = $selectionArray[$theWinnerIs]['id'].'|'.$selectionArray[$theWinnerIs]['type'].'|'.$selectionArray[$theWinnerIs]['desc'].'|'.$selectionArray[$theWinnerIs]['url'];


print $returnString;
	
	
	
	
	
?>