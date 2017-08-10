        
<?php 

	
		/**
         * General Date Dropdown function
         *
         * @package:	commonLA
         * @author:		Simone Bernacchia <simonebernacchia@gmail.com>
         * @date:		
         * @version: 	1.0.1
		 *
		 * Added id prefix on day,month and year
		 *
		 * @param: year_limit	=	unused (yet)
		 * @param: myDate		=	start date in form YYYY-MM-DD hh:mm:ss AM
		 * @param: prefix		=	identificative for form element to be added
		 * @param: label		=	label for form element
		 *
         *
         */
        
		
		

	function general_date_dropdown($year_limit = 0,$myDate = '2013-12-01 12:00:00 AM',$prefix='start_date',$label='Start Date'){
		
		$myPrefix = $prefix.'_';
		
		$start_year = (date('Y')+5);
		
		//definition of the
		$myCleanDate = cleanUpDate($myDate);
		$shortlabel = str_replace('_','',$prefix);
		
		//translate date in array
		$startDateArr = explode(chr(32),$myCleanDate);
		
		if(!empty($label)){
			$start_date_html_output .= '       <label class="field-name" for="'.$prefix.'_day">'.$label.':</label><br />';
		
		} //end if
                                    
         /*months*/
        $start_date_html_output .= '           <div id="'.$shortlabel.'"><div class="dob-value"><select name="'.$prefix.'_month" id="'.$myPrefix.'month_select" >'.chr(13);
        $start_date_months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $start_date_months_numbers = array("", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$ampmArr = array('AM','PM');
		
		
        for ($start_date_month = 1; $start_date_month <= 12; $start_date_month++) {
            $start_date_html_output .= '               <option value="' . $start_date_months_numbers[$start_date_month] . '"';
			if($startDateArr[0] == $start_date_months_numbers[$start_date_month]){
				$start_date_html_output.=' selected = "selected" ';
			} //end if
			$start_date_html_output .= ' >' . $start_date_months[$start_date_month] . '</option>'.chr(13);
        } //end for
        $start_date_html_output .= '           </select></div>';
                                    
        /*days*/
        $start_date_html_output .= '           <div class="dob-value"><select name="'.$prefix.'_day" id="'.$myPrefix.'day_select">';
        for ($start_date_day = 1; $start_date_day <= 31; $start_date_day++) {

        $start_date_html_output .= '               <option';
		
			if($startDateArr[1] == $start_date_day){
				$start_date_html_output.=' selected = "selected" ';
			} //end if
		
		$start_date_html_output .='>' . $start_date_day . '</option>'.chr(13);
        } //end for
        $start_date_html_output .= '           </select></div>'.chr(13);
                                    
        /*years*/
        $start_date_html_output .= '           <div class="dob-value"><select name="'.$prefix.'_year" id="'.$myPrefix.'year_select">';

        for ($start_date_year = $start_year; $start_date_year >= (date("Y") - 15); $start_date_year--) {
        $start_date_html_output .= '               <option ';
		if($startDateArr[2] == $start_date_year){
				$start_date_html_output.=' selected = "selected" ';
			} //end if
		
		$start_date_html_output.='>' . $start_date_year . '</option>'.chr(13);
        } //end for
      $start_date_html_output .= '           </select></div>';

        
		//hours
		$start_date_html_output .= '<div class="clearfix"></div><div style="margin-top: 10px;"><select name="'.$prefix.'_hours" id="'.$prefix.'_hours">'.chr(13);
		for($i=1;$i<13;$i++) {
            $start_date_html_output.= '<option value="'.$i.'"';
			
			if($startDateArr[3] == $i){
				$start_date_html_output.=' selected = "selected" ';
			} //end if	
			
			$start_date_html_output.= ' >'.$i.'</option>'.chr(13);
        } //end for
		$start_date_html_output.='</select>:'.chr(13);
		
		//minutes
        $start_date_html_output .= '<select name="'.$prefix.'_minutes" id="'.$prefix.'_minutes" >'.chr(13);
		$tempCond = '';
		for($i=0;$i<60;$i++) {
			if($startDateArr[4] == $i){
				$tempCond = 'selected="selected"';
			} else {
				$tempCond = '';
			
			} //end if
		
            if($i>9) { 
				$start_date_html_output.='<option value="'.$i.'" '.$tempCond.'>'.$i.'</option>'.chr(13); 
				} else { 
				$start_date_html_output.='<option value="0'.$i.'" '.$tempCond.' >0'.$i.'</option>'.chr(13); 
				} //end if
            
        } //end for
        $start_date_html_output.='</select>:'.chr(13);
        	
		
		//seconds
		$start_date_html_output .= '<select name="'.$prefix.'_seconds" id="'.$prefix.'_seconds" >';
		$tempCond = '';
		for($i=0;$i<60;$i++) {

			if($startDateArr[5] == $i){
				$tempCond = 'selected="selected"';
			} else {
				$tempCond = '';
			
			} //end if
			
            if($i>9) { 
				$start_date_html_output.='<option value="'.$i.'" '.$tempCond.'>'.$i.'</option>'.chr(13); 
				} else { 
				$start_date_html_output.='<option value="0'.$i.'" '.$tempCond.' >0'.$i.'</option>'.chr(13); 
				} //end if
        } //end for
        $start_date_html_output .= '</select>';
		
		//AM/PM
		$start_date_html_output .= '<select name="'.$prefix.'_ampm" id="'.$prefix.'_ampm" >';

		if($startDateArr[6] == 'AM'){
		$start_date_html_output .= '<option value="AM" selected="selected">AM</option>';
		
		} else {
		$start_date_html_output .= '<option value="AM">AM</option>';
		
		} //end if
		

		if($startDateArr[6] == 'PM'){
		$start_date_html_output .= '<option value="PM" selected="selected">PM</option>';
		
		} else {
		$start_date_html_output .= '<option value="PM">PM</option>';
		
		} //end if		
        $start_date_html_output .= '           </select></div></div>'.chr(13);
                            


		
        return $start_date_html_output;
        } //end function
		
		
		
		
		
	
		
		?>