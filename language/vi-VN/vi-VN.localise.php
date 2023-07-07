<?php
/**
 * @package    Joomla.Language
 *
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * vi-VN localise class
 *
 * @package		Joomla.Language
 * @since		1.6
 */
abstract class vi_VNLocalise 
{
	/**
	 * Returns the potential suffixes for a specific number of items
	 *
	 * @param   int  $count  The number of items.
	 *
	 * @return  array  An array of potential suffixes.
	 *
	 * @since   1.6
	 */
	public static function getPluralSuffixes($count) 
	{
		if ($count == 0) 
		{
			$return = array('0');
		}
		elseif($count == 1) 
		{
			$return = array('1');
		}
		else
		{
			$return = array('MORE');
		}
		return $return;
	}
	/**
	 * Returns the ignored search words
	 *
	 * @return  array  An array of ignored search words.
	 *
	 * @since   1.6
	 */
	public static function getIgnoredSearchWords() 
	{
		$search_ignore = array();
		$search_ignore[] = "and";
		$search_ignore[] = "in";
		$search_ignore[] = "on";
		return $search_ignore;
	}
	/**
	 * Returns the lower length limit of search words
	 *
	 * @return  integer  The lower length limit of search words.
	 *
	 * @since   1.6
	 */
	public static function getLowerLimitSearchWord() 
	{
		return 3;
	}
	/**
	 * Returns the upper length limit of search words
	 *
	 * @return	integer  The upper length limit of search words.
	 *
	 * @since	1.6
	 */
	public static function getUpperLimitSearchWord() 
	{
		return 20;
	}
	/**
	 * Returns the number of chars to display when searching
	 *
	 * @return	integer  The number of chars to display when searching.
	 *
	 * @since	1.6
	 */
	public static function getSearchDisplayedCharactersNumber() 
	{
		return 200;
	}
  /**
   * 
   * @param type $string
   * @return type
   */
  public static function transliterate($string)
  {
    $str = JString::strtolower($string);

    //Specific language transliteration.
    //This one is for latin 1, latin supplement , extended A, Cyrillic, Greek

    $glyph_array = array(
        'a' => 'á,à,?,ã,?,â,?,?,?,?,?,a,?,?,?,?,?,Á,À,?,Ã,?,Â,?,?,?,?,?,A,?,?,?,?,?',
        'd' => 'd,Ð',
        'e' => 'é,è,?,?,?,ê,?,?,?,?,?,É,È,?,?,?,Ê,?,?,?,?,?',
        'i' => 'í,ì,?,i,?,Í,Ì,?,I,?',
        'o' => 'ó,ò,?,õ,?,ô,?,?,?,?,?,o,?,?,?,?,?,Ó,Ò,?,Õ,?,Ô,?,?,?,?,?,O,?,?,?,?,?',
        'u' => 'ú,ù,?,u,?,u,?,?,?,?,?,Ú,Ù,?,U,?,U,?,?,?,?,?',
        'y' => 'ý,?,?,?,?,Ý,?,?,?,?'
    );

    foreach ($glyph_array as $letter => $glyphs)
    {
      $glyphs = explode(',', $glyphs);
      $str = str_replace($glyphs, $letter, $str);
    }

    return $str;
  }
}