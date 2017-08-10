<?php 

/**
 * Function Toolbox
 * 
 * Basic input sanitizing functions
 *
 * @author: Simone Bernacchia <simonebernacchia@gmail.com>
 * 
 */
 
//from http://stackoverflow.com/questions/2745058/php-input-sanitizer

/**
 * sanitize function, called from sanitize_input
 * 
 * @param	var ->
 * @param	santype ->
 * @returns -> 
 *
 */
 
function sanitize($var, $santype = 1){
     if ($santype == 1) {return strip_tags($var);}
     if ($santype == 2) {return htmlentities(strip_tags($var),ENT_QUOTES,'UTF-8');}
     if ($santype == 3) {
      if (!get_magic_quotes_gpc()) {
		return addslashes(htmlentities(strip_tags($var),ENT_QUOTES,'UTF-8'));
    
		} else {

		return htmlentities(strip_tags($var),ENT_QUOTES,'UTF-8');
      } //end if
     } //end if
    } //end function


/**
 * sanitize_input function
 * 
 * @param	input ->
 * @param	escape_mysql ->
 * @param	sanitize_html ->
 * @param	sanitize_special_chars ->
 * @param	allowable_tags ->
 * @returns -> 
 *
 */	

function sanitize_input($input,$escape_mysql=false,$sanitize_html=true,
						$sanitize_special_chars=true,$allowable_tags='<br><b><strong><p>') {
 
      unset($input['submit']); //we use 'submit' variable for all of our form

      $input_array = $input;

      //array is not referenced when passed into foreach
      //this is why we create another exact array
      foreach ($input as $key=>$value) {
       if(!empty($value)) {
			$input_array[$key]=strtolower($input_array[$key]);
			//stripslashes added by magic quotes
			if(get_magic_quotes_gpc()){$input_array[$key]=sanitize($input_array[$key]);} 

			if($sanitize_html){$input_array[$key] = strip_tags($input_array[$key],$allowable_tags);}

			if($sanitize_special_chars){$input_array[$key] = htmlspecialchars($input_array[$key]);}    

			if($escape_mysql){$input_array[$key] = mysql_real_escape_string($input_array[$key]);}
       } //end if
      } //end foreach

      return $input_array;

    } //end function



/**
 * Takes a unix timestamp and returns a relative time string such as "3 minutes ago",
 *   "2 months from now", "1 year ago", etc
 * The detailLevel parameter indicates the amount of detail. The examples above are
 * with detail level 1. With detail level 2, the output might be like "3 minutes 20
 *   seconds ago", "2 years 1 month from now", etc.
 * With detail level 3, the output might be like "5 hours 3 minutes 20 seconds ago",
 *   "2 years 1 month 2 weeks from now", etc.
 *
 * original: http://www.ankur.com/blog/100/php/relative-time-php-flexible-detail-level/
 *
 */
function nicetime($timestamp, $detailLevel = 1) {

	$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

	$now = time();

	// check validity of date
	if(empty($timestamp)) {
		return "Unknown time";
	}

	// is it future date or past date
	if($now > $timestamp) {
		$difference = $now - $timestamp;
		$tense = "ago";

	} else {
		$difference = $timestamp - $now;
		$tense = "from now";
	}

	if ($difference == 0) {
		return "1 second ago";
	}

	$remainders = array();

	for($j = 0; $j < count($lengths); $j++) {
		$remainders[$j] = floor(fmod($difference, $lengths[$j]));
		$difference = floor($difference / $lengths[$j]);
	}

	$difference = round($difference);

	$remainders[] = $difference;

	$string = "";

	for ($i = count($remainders) - 1; $i >= 0; $i--) {
		if ($remainders[$i]) {
			$string .= $remainders[$i] . " " . $periods[$i];

			if($remainders[$i] != 1) {
				$string .= "s";
			}

			$string .= " ";

			$detailLevel--;

			if ($detailLevel <= 0) {
				break;
			}
		}
	}

	return $string . $tense;

} //end function



/**
 * file_get_contents override for php 4
 *
 */


function get_file_contents($filename) {
/* Returns the contents of file name passed
*/
if (!function_exists('file_get_contents')) {
	$fhandle = fopen($filename, "r");
	$fcontents = fread($fhandle, filesize($filename));
	fclose($fhandle);
} else {
	$fcontents = file_get_contents($filename);
} //end if
	return $fcontents;
} //end function


/**
 * file_put_contents override for php 4
 *
 */

if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
} //end if


/**
 *
 *  PHP validate email
 *  http://www.webtoolkit.info/
 *
 **/
 
function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}


/**
 * Clear Special Characters from field name
 * @param	field -> name to be cleaned
 * @returns -> string (cleaned up field)
 *
 */

function clearSpecialCharsFieldName($field){
	$specialChars = array(' ','#','&','(',')','[',']','$','@','/',chr(92),chr(34),chr(39));
	foreach($specialChars as $i=>$value){
		$field = str_replace($specialChars[$i], "_", $field);
	} //end foreach
	return $field;
} //end function


/**
 * Clear Special Characters from field name
 * duplicate of clearSpecialCharsFieldName but that is what is called around
 * @param	field -> name to be cleaned
 * @returns -> string (cleaned up field)
 *
 */

 
if (!function_exists('cleanUpFieldName')) { 
	function cleanUpFieldName($fieldName){
		$fieldCharsToReplaceArr = array(' ','?',',',chr(39),'"','#','$','.','&',':','[',']','{','}',chr(92),chr(34),chr(39));
		
		$fieldName1 = $fieldName;
		
		foreach($fieldCharsToReplaceArr as $f=>$values){
			$fieldName1 = str_replace($fieldCharsToReplaceArr,'_',$fieldName1);
		} //end foreach
		
		return $fieldName1;
		
	} //end function
} //end if
?>