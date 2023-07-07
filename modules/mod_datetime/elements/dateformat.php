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
 
defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');
jimport( 'joomla.form.form' );

class JFormFielddateformat extends JFormField {
	
	protected $type = 'dateformat';

	protected function getLabel()
	{
		return '<label id="jform_params_dateformat-lbl" for="jform_params_dateformat" class="hasTooltip" title="&lt;strong&gt;'.JText::_('MOD_DATETIME_DATEFORMAT_LBL').'&lt;/strong&gt;&lt;br /&gt;You have to create a menu item first, that is assigned with Monthly Archive component.">'.JText::_('MOD_DATETIME_DATEFORMAT_LBL').'</label>';	
	}

	protected function getInput() 
	{
		/*
		yy – Two-digit year, e.g. 96
		yyyy – Four-digit year, e.g. 1996
		m – One-digit month for months below 10, e.g. 4
		mm – Two-digit month, e.g. 04
		mmm – Three-letter abbreviation for month, e.g. Apr
		mmmm – Month spelled out in full, e.g. April
		d – One-digit day for days below 10, e.g. 2
		dd – Two-digit day, e.g. 02
		*/
		// Date format LC
		$date_formats_arr_lc = array();
		$date_formats_arr_lc[JText::_('DATE_FORMAT_LC')] = JText::_('DATE_FORMAT_LC');
		$date_formats_arr_lc[JText::_('DATE_FORMAT_LC1')] = JText::_('DATE_FORMAT_LC1');
		$date_formats_arr_lc[JText::_('DATE_FORMAT_LC2')] = JText::_('DATE_FORMAT_LC2');
		$date_formats_arr_lc[JText::_('DATE_FORMAT_LC3')] = JText::_('DATE_FORMAT_LC3');
		$date_formats_arr_lc[JText::_('DATE_FORMAT_LC4')] = JText::_('DATE_FORMAT_LC4');
		$date_formats_arr_lc[JText::_('DATE_FORMAT_LC5')] = JText::_('DATE_FORMAT_LC5');
		$date_formats_arr_lc[JText::_('DATE_FORMAT_JS1')] = JText::_('DATE_FORMAT_JS1');
	
		// Full Date Format
		$date_formats_arr_a = array();
		$date_formats_arr_a["dddd, dd-mm-yyyy"] = "dddd, dd-mm-yyyy [custom]"; // Custom date format in German language for Luis Wetzel

		$date_formats_arr_a["dddd, d mmmm yyyyy"] = "dddd, d mmmm yyyyy";
		$date_formats_arr_a["dddd, dd mmmm yyyyy"] = "dddd, dd mmmm yyyyy";
		$date_formats_arr_a["dddd, d mmm yyyyy"] = "dddd, d mmm yyyyy";
		$date_formats_arr_a["dddd, dd mmm yyyyy"] = "dddd, dd mmm yyyyy";
		$date_formats_arr_a["dddd, dd-mm-yyyyy"] = "dddd, dd-mm-yyyyy";

		// Month Day, Year
		$date_formats_arr_b = array();
		$date_formats_arr_b["mmmm dd, yyyy"] = "mmmm dd, yyyy";
		$date_formats_arr_b["mmmm d, yyyy"] = "mmmm d, yyyy";
		$date_formats_arr_b["mmm dd, yyyy"] = "mmm dd, yyyy";
		$date_formats_arr_b["mmm d, yyyy"] = "mmm d, yyyy";
		
		// Day Month, Year
		$date_formats_arr_c = array();
		$date_formats_arr_c["dd mmmm, yyyy"] = "dd mmmm, yyyy";
		$date_formats_arr_c["d mmmm, yyyy"] = "d mmmm, yyyy";
		$date_formats_arr_c["dd mmm, yyyy"] = "dd mmm, yyyy";
		$date_formats_arr_c["d mmm, yyyy"] = "d mmm, yyyy";
		
		// Day-Month-Year
		$date_formats_arr_d = array();
		$date_formats_arr_d["d-m-Y"] = "dd-mm-yyyy";
		$date_formats_arr_d["j-n-Y"] = "d-m-yyyy";
		
		// Month-Day-Year
		$date_formats_arr_e = array();
		$date_formats_arr_e["m-d-Y"] = "mm-dd-yyyy";
		$date_formats_arr_e["n-j-Y"] = "m-d-yyyy";
		
		// Year-Month-Day
		$date_formats_arr_f = array();
		$date_formats_arr_f["Y-m-d"] = "yyyy-mm-dd";
		$date_formats_arr_f["Y-n-j"] = "yyyy-m-d";
		
		// BEGIN: DEBUGGER
		/*$default_date = date("Y-m-d");
		$items_arr = array_merge($date_formats_arr_a, $date_formats_arr_b, $date_formats_arr_c, $date_formats_arr_d, $date_formats_arr_e, $date_formats_arr_f);
		foreach ($items_arr as $k=>$v):
			echo date($k, strtotime($default_date)).' ('.$v.')<br>';
		endforeach;*/
		// END: DEBUGGER

		// print
		$html = '';
		$html .= '<select class="form-control" id="'.$this->id.'" name="'.$this->name.'">';
		$html .= '<option value="">'.JText::_('MOD_DATETIME_SELECT_DATE_FORMAT').'</option>';
		
		// Date Format from language file
		$html .= '<optgroup label="Date Format LC (.ini)">';
		foreach ($date_formats_arr_lc as $k=>$v):
			$html .= '<option value="'.$k.'"'.(($this->value == $k) ? ' selected="selected"' : '').'>'.$v.'</option>';
		endforeach;
		$html .= '</optgroup>';
		
		// Full Date Format
		$html .= '<optgroup label="Full Date Format">';
		foreach ($date_formats_arr_a as $k=>$v):
			$html .= '<option value="'.$k.'"'.(($this->value == $k) ? ' selected="selected"' : '').'>'.$v.'</option>';
		endforeach;
		$html .= '</optgroup>';
		
		// Month Day, Year
		$html .= '<optgroup label="Month Day, Year">';
		foreach ($date_formats_arr_b as $k=>$v):
			$html .= '<option value="'.$k.'"'.(($this->value == $k) ? ' selected="selected"' : '').'>'.$v.'</option>';
		endforeach;
		$html .= '</optgroup>';
	
		// Day Month, Year
		$html .= '<optgroup label="Day Month, Year">';
		foreach ($date_formats_arr_c as $k=>$v):
			$html .= '<option value="'.$k.'"'.(($this->value == $k) ? ' selected="selected"' : '').'>'.$v.'</option>';
		endforeach;
		$html .= '</optgroup>';

		// Day-Month-Year
		$html .= '<optgroup label="Day-Month-Year">';
		foreach ($date_formats_arr_d as $k=>$v):
			$html .= '<option value="'.$k.'"'.(($this->value == $k) ? ' selected="selected"' : '').'>'.$v.'</option>';
		endforeach;
		$html .= '</optgroup>';

		// Month-Day-Year
		$html .= '<optgroup label="Month-Day-Year">';
		foreach ($date_formats_arr_e as $k=>$v):
			$html .= '<option value="'.$k.'"'.(($this->value == $k) ? ' selected="selected"' : '').'>'.$v.'</option>';
		endforeach;
		$html .= '</optgroup>';

		// Year-Month-Day
		$html .= '<optgroup label="Year-Month-Day">';
		foreach ($date_formats_arr_f as $k=>$v):
			$html .= '<option value="'.$k.'"'.(($this->value == $k) ? ' selected="selected"' : '').'>'.$v.'</option>';
		endforeach;
		$html .= '</optgroup>';

		$html .= '</select> ';

		return $html;
	}
	
}