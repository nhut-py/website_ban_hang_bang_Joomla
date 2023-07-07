<?php
/* ======================================================
# Web357 Framework for Joomla! - v1.9.1 (free version)
# -------------------------------------------------------
# For Joomla! CMS (v3.x)
# Author: Web357 (Yiannis Christodoulou)
# Copyright (©) 2014-2022 Web357. All rights reserved.
# License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
# Website: https:/www.web357.com
# Demo: https://demo.web357.com/joomla/
# Support: support@web357.com
# Last modified: Thursday 17 February 2022, 03:25:10 AM
========================================================= */

// no direct access
defined('JPATH_PLATFORM') or die;

jimport('joomla.form.formfield');

class JFormFieldk2categories extends JFormField
{

    protected $type = 'k2categories';

    public function getInput()
    {
        jimport('joomla.component.helper');

        // Get Joomla's version
        $jversion = new JVersion;
        $short_version = explode('.', $jversion->getShortVersion()); // 3.8.10
        $mini_version = $short_version[0] . '.' . $short_version[1]; // 3.8

        // Check if K2 Component is installed
        if (!version_compare($mini_version, "3.5", "<=")):
            // j3x
            $is_installed = JComponentHelper::isInstalled('com_k2');
            $is_enabled = ($is_installed == 1) ? JComponentHelper::isEnabled('com_k2') : 0;
            $style = '';
        else:
            // j25x
            $db = JFactory::getDbo();
            $db->setQuery("SELECT enabled FROM #__extensions WHERE name = 'com_k2'");
            $is_enabled = $db->loadResult();
            $is_installed = $is_enabled;
            $style = ' style="float: left; width: auto; margin: 5px 5px 5px 0;"';
        endif;

        if (!$is_installed):
            return '<div class="control-label"' . $style . '>The <a href="https://getk2.org" target="_blank"><strong>K2 component</strong></a> is not installed.</div>';
            // Check if K2 Component is active
        elseif (!$is_enabled):
            return '<div class="control-label"' . $style . '>The <a href="https://getk2.org" target="_blank"><strong>K2 component</strong></a> is not enabled.</div>';
            // K2 is installed and active
        else:
            return $this->fetchElement($this->name, $this->value, $this->element, isset($this->options['control']) ? $this->options['control'] : null);
        endif;
    }

    public function fetchElement($name, $value, &$node, $control_name)
    {
        $db = JFactory::getDBO();

        $query = 'SELECT m.* FROM #__k2_categories m WHERE trash = 0 ORDER BY parent, ordering';
        $db->setQuery($query);
        $mitems = $db->loadObjectList();
        $children = array();
        if ($mitems) {
            foreach ($mitems as $v) {
                if (K2_JVERSION != '15') {
                    $v->title = $v->name;
                    $v->parent_id = $v->parent;
                }
                $pt = $v->parent;
                $list = @$children[$pt] ? $children[$pt] : array();
                array_push($list, $v);
                $children[$pt] = $list;
            }
        }
        $list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0);
        $mitems = array();

        foreach ($list as $item) {
            $item->treename = JString::str_ireplace('&#160;', ' -', $item->treename);
            $mitems[] = JHTML::_('select.option', $item->id, $item->treename);
        }

        $attributes = 'class="inputbox"';
        if (K2_JVERSION != '15') {
            $attribute = K2_JVERSION == '25' ? $node->getAttribute('multiple') : $node->attributes()->multiple;
            if ($attribute) {
                $attributes .= ' multiple="multiple" size="10"';
            }
        } else {
            if ($node->attributes('multiple')) {
                $attributes .= ' multiple="multiple" size="10"';
            }
        }

        if (K2_JVERSION != '15') {
            $fieldName = $name;
        } else {
            $fieldName = $control_name . '[' . $name . ']';
            if ($node->attributes('multiple')) {
                $fieldName .= '[]';
            }
        }

        return JHTML::_('select.genericlist', $mitems, $fieldName, $attributes, 'value', 'text', $value);
    }
}
