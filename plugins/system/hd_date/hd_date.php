<?php
# HD-Date   4     	          	          	              
# Copyright (C) 2021 by Hyde-Design  	   	   	   	   
# Homepage   : www.hyde-design.co.uk		   	   	   
# Author     : Hyde-Design    		   	   	   	   
# Email      : sales@hyde-design.co.uk 	   	   	   
# Version    : 4                      	   	    	
# License    : http://www.gnu.org/copyleft/gpl.html GNU/GPL  

// no direct access
defined( '_JEXEC' ) or die;

use Joomla\CMS\Plugin\CMSPlugin;

class PlgSystemHD_Date extends CMSPlugin 
{ protected $app;
public function onAfterRender() {
if ($this->app->isClient('site')){

// GET PARAMS
$plugin = JPluginHelper::getPlugin('system', 'hd_date');
if ($plugin){$pluginParams = new JRegistry($plugin->params);
    $date_side = $pluginParams->get('date_side');
}
$buffer = JFactory::getApplication()->getBody();

	if ($date_side == "client_side") {$thisdate = '<span class="hd-date"><script type="text/javascript">
today=new Date(); date=today.getDate(); month=today.getMonth()+1; year=today.getFullYear(); var dayName=new Array(7) 
dayName[0]="Sunday"; dayName[1]="Monday"; dayName[2]="Tuesday"; dayName[3]="Wednesday"; dayName[4]="Thursday"; dayName[5]="Friday"; dayName[6]="Saturday"; day = today.getDay();
if (date==1) suffix=("st"); else if (date==2) suffix=("nd"); else if (date==3) suffix=("rd"); else if (date==21) suffix=("st"); else if (date==22) suffix=("nd"); else if (date==23) suffix=("rd"); else if (date==31) suffix=("st"); else suffix=("th"); month=today.getMonth()+1;
if (month==1) monthName=("January"); else if (month==2) monthName=("February"); else if (month==3) monthName=("March"); else if (month==4) monthName=("April"); else if (month==5) monthName=("May"); else if (month==6) monthName=("June"); else if (month==7) monthName=("July"); else if (month==8) monthName=("August"); else if (month==9) monthName=("September"); else if (month==10) monthName=("October"); else if (month==11) monthName=("November"); else monthName=("December");
document.write (dayName[day] + " " + date + suffix + " " + monthName + " " + year); </script></span>';
$thisday = '<span class="hd-date"><script type="text/javascript">
today=new Date(); date=today.getDate(); month=today.getMonth()+1; year=today.getFullYear(); var dayName=new Array(7) 
dayName[0]="Sunday"; dayName[1]="Monday"; dayName[2]="Tuesday"; dayName[3]="Wednesday"; dayName[4]="Thursday"; dayName[5]="Friday"; dayName[6]="Saturday"; day = today.getDay();
if (date==1) suffix=("st"); else if (date==2) suffix=("nd"); else if (date==3) suffix=("rd"); else if (date==21) suffix=("st"); else if (date==22) suffix=("nd"); else if (date==23) suffix=("rd"); else if (date==31) suffix=("st"); else suffix=("th"); month=today.getMonth()+1;
if (month==1) monthName=("January"); else if (month==2) monthName=("February"); else if (month==3) monthName=("March"); else if (month==4) monthName=("April"); else if (month==5) monthName=("May"); else if (month==6) monthName=("June"); else if (month==7) monthName=("July"); else if (month==8) monthName=("August"); else if (month==9) monthName=("September"); else if (month==10) monthName=("October"); else if (month==11) monthName=("November"); else monthName=("December");
document.write (dayName[day]); </script></span>';
$thismonth = '<span class="hd-date"><script type="text/javascript">
today=new Date(); date=today.getDate(); month=today.getMonth()+1; year=today.getFullYear(); var dayName=new Array(7) 
dayName[0]="Sunday"; dayName[1]="Monday"; dayName[2]="Tuesday"; dayName[3]="Wednesday"; dayName[4]="Thursday"; dayName[5]="Friday"; dayName[6]="Saturday"; day = today.getDay();
if (date==1) suffix=("st"); else if (date==2) suffix=("nd"); else if (date==3) suffix=("rd"); else if (date==21) suffix=("st"); else if (date==22) suffix=("nd"); else if (date==23) suffix=("rd"); else if (date==31) suffix=("st"); else suffix=("th"); month=today.getMonth()+1;
if (month==1) monthName=("January"); else if (month==2) monthName=("February"); else if (month==3) monthName=("March"); else if (month==4) monthName=("April"); else if (month==5) monthName=("May"); else if (month==6) monthName=("June"); else if (month==7) monthName=("July"); else if (month==8) monthName=("August"); else if (month==9) monthName=("September"); else if (month==10) monthName=("October"); else if (month==11) monthName=("November"); else monthName=("December");
document.write (monthName); </script></span>';
$thisyear = '<span class="hd-date"><script type="text/javascript">today=new Date(); year=today.getFullYear(); document.write (year); </script></span>';};
	

	if ($date_side == "server_side") {$thisdate = '<span class="hd-date">'. date("l jS M Y") .'</span>'; 
	                                  $thisday = '<span class="hd-date">'. date("l") .'</span>';
	                                  $thismonth = '<span class="hd-date">'. date("F") .'</span>';
									  $thisyear = '<span class="hd-date">'.date("Y").'</span>';};

	$buffer = str_replace ('{date}', $thisdate, $buffer);
	$buffer = str_replace ('{day}', $thisday, $buffer);
	$buffer = str_replace ('{month}', $thismonth, $buffer);
	$buffer = str_replace ('{year}', $thisyear, $buffer);

    JFactory::getApplication()->setBody($buffer);


}}}

?>