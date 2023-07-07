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

require_once dirname(__FILE__) . '/helper/vvisit_counter.php';

class plgSystemVVisit_Counter extends JPlugin
{
	public function __construct( &$subject, $config )
	{
		parent::__construct( $subject, $config );
	}
	
	public function onAfterInitialise()
	{
		// Don't run on back-end
		$onbackend = (int) $this->params->get('onbackend', 0);
		if ( !$onbackend && (JPATH_BASE !== JPATH_ROOT) ) return;

		$now		= time();
		$session	= JFactory::getSession();
		$lastlog	= (int) $session->get('vvisit_counter.lastlog');

		if ( $session->isNew() || ($now > $lastlog) )
		{
			$visit_type	= plgVVisitCounterHelper::visitType();
			$lifetime	= (int) $session->getExpire();
			
			$lastlog	= ( floor($now/$lifetime)+1 ) * $lifetime;
			self::_insertRecord($lastlog, $visit_type);
			$session->set('vvisit_counter.lastlog', $lastlog);
			return;
		}
	}

	/*
	 * Insert a new Record
	 */
	private static function _insertRecord($time=0, $visit_type='guests')
	{
		$time	= (int) $time;
		
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		// Insert columns.
		$columns = array('time', 'visits', $visit_type);
		
		// Insert values.
		$values	= array($time, 1, 1);

		// Prepare the insert query.
		$query
			->insert('#__vvisit_counter')
			->columns($columns)
			->values(implode(',', $values));
		
		// Try to update if has more than one visitor who has visited the site
		if(self::_updateRecord($time, $visit_type)) return 1;
		
		// Set the query using our newly populated query object and execute it.
		$db->setQuery($query);
		$db->execute();
		
		return $db->getAffectedRows();
	}

	/*
	 * Update the last Record
	 */
	private static function _updateRecord($time=0, $visit_type='guests')
	{
		$time	= (int) $time;
		
		// Get a db connection.
		$db = JFactory::getDbo();
		 
		// Create a new query object.
		$query = $db->getQuery(true);
		
		// Fields to update.
		$fields = array("visits=visits+1", "$visit_type=$visit_type+1");
		 
		// Conditions for which records should be updated.
		$where = "time=$time";
		 
		$query
			->update('#__vvisit_counter')
			->set($fields)
			->where($where);
		 
		$db->setQuery($query);
		$db->execute();
		
		return $db->getAffectedRows();
	}

}
