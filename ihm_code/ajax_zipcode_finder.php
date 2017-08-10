<?php

/**
 * Zip Code AJAX retriever from a MySQL table for the form template 
 * to populate via jquery two hidden form fields for city and state
 *
 * @package:	
 * @author:		Simone Bernacchia <simonebernacchia@gmail.com>
 * @date:
 * @version: 
 *
 */

 




 //include function toolbox
include('includes/function_toolbox.php');



	// connect to mysql
	include(/*config file*/);  //the config file contains the $databaseZipCode variables 



//for stand-alone pages only, comment if unused
include(/*mysql connection file*/); 


$zipcode = sanitize($_POST['zip'],1);

$sql = "SELECT zip_code,city,state_prefix FROM `$databaseZipCode` WHERE zip_code = '".$zipcode."' ";

//print 'query: '.$sql.'<br/>';

$res = mysql_query($sql) or die('sql query problem! Query: "'.$sql.'" - error:'.mysql_error() );

$numrows = mysql_num_rows($res);

//print 'rows found:'.$numrows.'<br/>';
//parse results
if($numrows >0 ){

	$finalResult = '';


	while($row0 = mysql_fetch_array($res)){
		$resZip 	=	$row0['zip_code'];
		$resCity 	=	$row0['city'];
		$resState	=	$row0['state_prefix'];
		
	//	$finalResult .=$resZip.'!'.$resCity.'!'.$resState.'|';
		$finalResult .=$resZip.'!'.$resCity.'!'.$resState;

	} //end while
	

} else {

$finalResult = '0';
}

print $finalResult;


?>