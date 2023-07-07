<?php
/* ======================================================
 # Display Date and Time for Joomla! - v2.3.7 (free version)
 # -------------------------------------------------------
 # For Joomla! CMS (v3.x)
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2022 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.com
 # Demo: https://demo.web357.com/joomla/date-time
 # Support: support@web357.com
 # Last modified: Thursday 17 February 2022, 03:25:10 AM
 ========================================================= */
 
defined('_JEXEC') or die;

class modWeb357DateTimeHelper
{
	function getDate($Y, $m, $d, $dateformat, $days, $day_of_the_week, $day, $months, $month, $short_month, $full_month, $year, $dateformat_separator, $offset, $z, $params)
	{
		$custom_date_formats_arr = array(
				"dddd, dd-mm-yyyy", 
				"dddd, d mmmm yyyyy", 
				"dddd, dd mmmm yyyyy", 
				"dddd, d mmm yyyyy", 
				"dddd, dd mmm yyyyy", 
				"dddd, dd-mm-yyyyy", 
				"mmmm dd, yyyy", 
				"mmmm d, yyyy", 
				"mmm dd, yyyy", 
				"mmm d, yyyy", 
				"dd mmmm, yyyy", 
				"d mmmm, yyyy", 
				"dd mmm, yyyy", 
				"d mmm, yyyy"
		);
		
		// exclude predefined date formats
		if (in_array($dateformat, $custom_date_formats_arr)):
			$date_format = "Y-m-d H:i:s";
		else:
			$date_format = $dateformat;
		endif;
		
		// Build Date
		if (!empty($offset)):
			$datetime = new DateTime('now', new DateTimeZone($offset));
			// $print_date = JHTML::_('date', strtotime($datetime->format('Y-m-d H:i:s')), $date_format);
			//$print_date = JHTML::_('date', $datetime->format('Y-m-d H:i:s'));
			//$print_date = JHTML::_('date', $datetime->format($date_format));
			$print_date = JHTML::_('date', strtotime($datetime->format('Y-m-d H:i:s')), $date_format);
		else:
			$print_date = JHTML::_('date', strtotime(date("Y-m-d H:i:s")), $date_format);
		endif;

		// igbo calendar week day
		$igbo_calendar_week_day = '';
		$igbo_calendar_week_day_comma_separated = '';
		$igbo_calendar = $params->get('igbo_calendar', '0');
		if ($igbo_calendar)
		{
			$igbo_calendar_week_day = $this->getIgboCalendarWeekDay($z);
			$igbo_calendar_week_day_comma_separated = $igbo_calendar_week_day.', ';
			$igbo_calendar_week_day = $igbo_calendar_week_day . ' ';
		}
		
		// Date format
		switch ($dateformat):

			// Custom date format
			case "dddd, dd-mm-yyyy":
				$date = $days[$day_of_the_week].", ".$igbo_calendar_week_day. "" .$d."-".$m."-".$year;
			break;
			
			// Full Date Format
			case "dddd, d mmmm yyyyy":
				$date = $days[$day_of_the_week].", ".$igbo_calendar_week_day. "" .$day." ".$months[$month - 1]." ".$year;
			break;
			case "dddd, dd mmmm yyyyy":
				$date = $days[$day_of_the_week].", ".$igbo_calendar_week_day. "". $d." ".$months[$month - 1]." ".$year;
			break;
			case "dddd, d mmm yyyyy":
				$date = $days[$day_of_the_week].", ".$igbo_calendar_week_day. "" .$day." ".$short_month." ".$year;
			break;
			case "dddd, dd mmm yyyyy":
				$date = $days[$day_of_the_week].", ".$igbo_calendar_week_day. "" .$d." ".$short_month." ".$year;
			break;
			case "dddd, dd-mm-yyyyy":
				$date = $days[$day_of_the_week].", ".$igbo_calendar_week_day. "" .$d."-".$m."-".$year;
			break;
			
			// Month Day, Year
			case "mmmm dd, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $full_month." ".$d.", ".$year;
			break;
			case "mmmm d, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $full_month." ".$day.", ".$year;
			break;
			case "mmm dd, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $short_month." ".$d.", ".$year;
			break;
			case "mmm d, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $short_month." ".$day.", ".$year;
			break;
		
			// Day Month, Year
			case "dd mmmm, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $d." ".$full_month.", ".$year;
			break;
			case "d mmmm, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $day." ".$full_month.", ".$year;
			break;
			case "dd mmm, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $d." ".$short_month.", ".$year;
			break;
			case "d mmm, yyyy":
				$date = $igbo_calendar_week_day_comma_separated . "" . $day." ".$short_month.", ".$year;
			break;

			// Default
			default:
				$date = $igbo_calendar_week_day_comma_separated . "" .$print_date;
		endswitch;

		// echo date
		$dateformat_separator = (!empty($dateformat_separator) && $dateformat_separator != '-') ? $dateformat_separator : '-';
		$print_final_date = str_replace('-', $dateformat_separator, $date);
		
		return $print_final_date;
	}
	
	function getTime($timeformat, $display_pm_am, $hour_system, $offset, $h, $i, $a, $module, $show_leading_zero_for_hours, $show_leading_zeros_for_minutes, $type = 'custom_time')
	{
		$html = '';
		
		if (!empty($offset)):
			// calculate timezone
			$tz = new DateTimeZone($offset);
			$date = new DateTime('now', $tz);
			$offset = $tz->getOffset($date) . ' seconds';
			$dateOffset = clone $date;
			$dateOffset->sub(DateInterval::createFromDateString($offset));
			$interval = $dateOffset->diff($date);
			$offset_sign = $interval->format('%R');
			$offset_hours = $interval->format('%H');
			$offset_minutes = $interval->format('%I');
		else:
			$offset_sign = '+';
			$offset_hours = 0;
			$offset_minutes = 0;
		endif;
		
		$js_time_a = '
		<span id="mod_datetime_'.$type.'_'.$module->id.'"></span>
		<script type="text/javascript">
			<!--
			zone=0
			isitlocal=true;
			ampm="";
			
			function mod_datetime_'.$type.'_'.$module->id.'()
			{
				now=new Date();
				'.(!empty($offset) ? 'ofst="'.$offset_hours.'"' /* custom time */ : 'ofst=now.getTimezoneOffset()/60' /* users time */ ).'; 
				'.(!empty($offset) ? 'ofst_minutes="'.$offset_minutes.'";' : '').'
				'.(!empty($offset) ? 'ofst_sign="'.$offset_sign.'";' : '').'
				'.(!empty($offset) ? 'now.setUTCHours(now.getUTCHours()'.$offset_sign.'Math.abs(ofst), now.getUTCMinutes()'.$offset_sign.'Math.abs(ofst_minutes));' : 'now.setUTCHours(now.getUTCHours()+Math.abs(ofst), now.getUTCMinutes());').'
				timezone = now.getTimezoneOffset();
				secs=now.getUTCSeconds();
				sec=-1.57+Math.PI*secs/30;
				mins=now.getUTCMinutes();
				min=-1.57+Math.PI*mins/30;
				hr=(isitlocal)? now.getUTCHours():(now.getUTCHours() + parseInt(ofst)) + parseInt(zone);
				hrs=-1.575+Math.PI*hr/6+Math.PI*parseInt(now.getMinutes())/360;
				if (hr < 0) hr+=24;
				if (hr > 23) hr-=24;
				'.(($display_pm_am) ? '
				ampm = (hr > 11) ? "'.JText::_("MOD_DATETIME_PM").'" : "'.JText::_("MOD_DATETIME_AM").'"; 
				' : '
				ampm = (hr > 11)?"":"";
				').'
				statusampm = ampm;
				
				hr2 = hr;
				if (hr2 == 0) hr2='.$hour_system.';//24 or 12
				(hr2 < 13)?hr2:hr2 %= '.$hour_system.';// 24 or 12'."\n";

			if ($show_leading_zero_for_hours) 
			{
                $js_time_a .= 'if (hr2<10) hr2="0"+hr2'."\n";
			}
			else
			{
                $js_time_a .= 'if (hr2<10) hr2=hr2'."\n";
			}
			
		$js_time_b = '	
				document.getElementById("mod_datetime_'.$type.'_'.$module->id.'").innerHTML=finaltime
				setTimeout("mod_datetime_'.$type.'_'.$module->id.'()",1000)
			}
			mod_datetime_'.$type.'_'.$module->id.'()
			//-->    
		</script>';
		
		// Time format
		switch ($timeformat) :
			
			case 1: // 19:32 (static)
				$html .= " ".$h.":".$i;
				$html .= ($display_pm_am) ? " ".JText::_('MOD_DATETIME_'.$a) : '';
			break;
			
			case 2: // 19:32 (ajax/flashing)
				$html .= $js_time_a;
				if ($show_leading_zeros_for_minutes)
				{
					$html .= 'var finaltime=hr2+":"+((mins < 10)?"0"+mins:mins)+" "+statusampm;'."\n";
				}
				else
				{
					$html .= 'var finaltime=hr2+":"+mins+" "+statusampm;'."\n";
				}
				$html .= $js_time_b;
			break;	

			case 3: // 19:32:22 (ajax/flashing)
				$html .= $js_time_a;
				if ($show_leading_zeros_for_minutes)
				{
					$html .= 'var finaltime=hr2+":"+((mins < 10)?"0"+mins:mins)+":"+((secs < 10)?"0"+secs:secs)+" "+statusampm;'."\n";
				}
				else
				{
					$html .= 'var finaltime=hr2+":"+mins+":"+((secs < 10)?"0"+secs:secs)+" "+statusampm;'."\n";
				}
				$html .= $js_time_b;
			break;
			
			case 4: // none
				$html .= "";
			break;
			
		endswitch;

		return $html;
	}

	/**
	 * IGBO Calendar 
	 * https://en.wikipedia.org/wiki/Igbo_calendar
	 * https://igbocalendar.com/
	*/
	function getIgboCalendarWeekDay($z)
	{
		// control variable
		$counter = 0;
		$igbo_arr = array();
		$final_igbo_week_day = '';
		for ($i=0;$i<=365;$i++)
		{
			if ($counter % 4 === 0) {
				$igbo_arr['NKWO'][] = $i+4;
				$igbo_arr['EKE'][] = ($i+1);
				$igbo_arr['ORIE'][] = ($i+2);
				$igbo_arr['AFO'][] = ($i+3);
			}
			$counter++;
		}

		foreach ($igbo_arr as $igbo_week_day=>$igbo_days)
		{
			foreach ($igbo_days as $igbo_day)
			{
				if ($igbo_day==$z)
				{
					switch ($igbo_week_day) 
					{
						case 'NKWO':
							$final_igbo_week_day = 'Nkwọ';
							break;
						case 'EKE':
							$final_igbo_week_day = 'Afọ';
							break;
						case 'ORIE':
							$final_igbo_week_day = 'Orie';
							break;
						case 'AFO':
							$final_igbo_week_day = 'Afọ';
							break;
						default:
							$final_igbo_week_day = $igbo_week_day;
							break;
					}
					
				}
			}
		}
		
		// echo date
		if (!empty($final_igbo_week_day))
		{
			return $final_igbo_week_day;
		}

		return;
	}
	
}