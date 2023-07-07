<?php
// joomla security check - no direct access to this file
// prevents file path exposure
defined('_JEXEC') or die('Restricted access');

// import joomla plugin class
jimport('joomla.plugin.plugin');

// load required joomla namespaces
use \Joomla\CMS\Factory as JFactory;

/**
 * VirtueMart System Plugin Class
 *
 * @since       3.8
 */
class plgSystemVirtueMart extends JPlugin
{
    //region __construct
    function __construct (&$subject, $config)
    {
        parent::__construct($subject, $config);

        // Load Our Own Language File
        // Which Is Within The Plugin Folder
        $this->loadLanguage();
    }
    //endregion

    //region onAfterInitialise
    public function onAfterInitialise ()
    {
        try
        {
            // Register The Namespace Of The VmStore Template Library
            //
            // check whether the current joomla template is made by the virtuemart team or not
            // we check this based on the name as all virtuemart templates start with "vm_store" string
            $joomlaApplication = JFactory::getApplication();
            if ($joomlaApplication->isClient('site')
                && (strpos($joomlaApplication->getTemplate(), 'vmstore') !== FALSE))
            {
                // tell the auto-loader to look for namespace classes
                // starting with "VmStoreTemplate" in the templates directory
                JLoader::registerNamespace(
                    'VmStoreTemplate',
                    JPATH_THEMES . '/vmstore/library',
                    FALSE,
                    FALSE,
                    'psr4'
                );
                JLoader::registerAlias('VmStoreTemplate', '\\VmStoreTemplate\\VmStoreTemplate');

                // load an instance of the "VmStoreTemplate" library
                VmStoreTemplate::getInstance('joomla');
            }
        } catch (\Exception $e)
        {
            // echo 'Exception abgefangen: ', $e->getMessage(), "\n";
        }
    }
    //endregion

    //region onAfterRoute
    public function onAfterRoute ()
    {
    }
    //endregion

    //region onAfterDispatch
    public function onAfterDispatch ()
    {
    }
    //endregion

    //region onBeforeRender
    public function onBeforeRender ()
    {
    }
    //endregion

    //region onAfterRender
    public function onAfterRender ()
    {
    }
    //endregion

    //region onBeforeCompileHead
    public function onBeforeCompileHead ()
    {
    }
    //endregion
}
