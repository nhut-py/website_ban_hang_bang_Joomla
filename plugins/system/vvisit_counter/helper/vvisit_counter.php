<?php
/**
 * @package		VINAORA VISITORS COUNTER
 * @subpackage	vvisit_counter
 *
 * @copyright	Copyright (C) 2007-2015 VINAORA. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @website		http://vinaora.com
 * @twitter		http://twitter.com/vinaora
 * @facebook	https://www.facebook.com/pages/Vinaora/290796031029819
 * @google+		https://plus.google.com/111142324019789502653
 */

// no direct access
defined('_JEXEC') or die;

class plgVVisitCounterHelper
{
	/*
	 * Query LastTime log from database
	 */
	public static function getLastTime()
	{
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		// Don't use SELECT MAX(time) because it is much slower than
		// SELECT time FROM #__vvisit_counter USE INDEX(time) ORDER BY time DESC LIMIT 1;
		$query
			->select('time')
			->from('#__vvisit_counter')
			->order('time DESC')
			->setLimit('1');
		
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		 
		$ltime	= $db->loadResult();
		
		if ( $db->getErrorNum() )
		{
			JError::raiseWarning( 500, $db->stderr() );
		}

		return $ltime;
	}

	/*
	 * Get Total Visits in the duration from $timestart to $timestop
	 */
	public static function &getVisits($timestart=0, $timestop=0)
	{
		$timestart	= (int) $timestart;
		$timestop	= (int) $timestop;

		$where		= ($timestop) ? "time > $timestart AND time <= $timestop" : "time > $timestart";
		
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		// SELECT * FROM #__vvisit_counter WHERE time > $timestart AND time <= $timestop
		$query
			->select('*')
			->from('#__vvisit_counter')
			->where($where);
			
		// Reset the query using our newly populated query object.
		$db->setQuery($query);

		$records = $db->loadObjectList();

		$total = array('visits'=>0, 'guests'=>0, 'bots'=>0, 'members'=>0);
		
		if ( !empty($records) && count($records) )
		{
			foreach ( $records as $record )
			{
				$total['visits']	+=	(int) $record->visits;
				$total['guests']	+=	(int) $record->guests;
				$total['bots']		+=	(int) $record->bots;
				$total['members']	+=	(int) $record->members;
			}
		}

		return $total;
	}

	/*
	 * Get Total Visits in the duration from $timestart to $timestop
	 */
	public static function &getVisitsSQL($timestart=0, $timestop=0)
	{
		$timestart	= (int) $timestart;
		$timestop	= (int) $timestop;
		
		$where		= ($timestop) ? "time > $timestart AND time <= $timestop" : "time > $timestart";
		
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		$query
			->select('SUM(visits) AS visits')
			->select('SUM(guests) AS guests')
			->select('SUM(bots) AS bots')
			->from('#__vvisit_counter')
			->where($where);
			
		// Reset the query using our newly populated query object.
		$db->setQuery($query);

		$total = $db->loadResultArray();
		
		return $total;
	}
	
	/*
	 * Get Visits by Type
	 */
	public static function getVisitsByType($type='visits', $timestart=0, $timestop=0)
	{
		$timestart	= (int) $timestart;
		$timestop	= (int) $timestop;
		
		$where		= ($timestop) ? "time > $timestart AND time <= $timestop" : "time > $timestart";
		
		// Ensure that $type is one of 'visits/guests/bots/members' values
		$type	= (($type == 'guests') || ($type == 'bots') || ($type == 'members')) ? $type : 'visits';
		
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		$query
			->select("SUM($type) AS $type")
			->from('#__vvisit_counter')
			->where($where);
		
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		
		$total = $db->loadResult();
		
		return $total;
	}

	/*
	 * Get the Visit Type: members, bots or guests
	 */
	public static function visitType()
	{
		$type = 'members';
		$user = JFactory::getUser();
		
		// If visitor is a guest (not member/user of the site)
		if ( $user->guest )
		{
			$session = JFactory::getSession();
			if ( self::isBot($session->get('session.client.browser')) )
			{
				$type = 'bots';
			}
			else
			{
				$type = 'guests';
			}
		}

		return $type;
	}
	
	/*
	 * Check User Agent is bot or not
	 */
	public static function isBot($user_agent="")
	{
		if(preg_match("#(bot|index|spider|crawl|wget|slurp|robot)#i", $user_agent)) return true;
		return false;
	}

}
