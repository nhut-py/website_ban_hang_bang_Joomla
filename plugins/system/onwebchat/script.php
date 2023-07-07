<?php
/**
 * @package     onWebChat.com Integration for Joomla!
 * @type        Plugin (System)
 * @filename    onwebchat.php
 * @folder      <root>/plugins/system/onwebchat
 * @version     2.2.0
 * @modified    2 August 2018
 * @author      onwebchat.com / onWebChat
 * @website     http://www.onwebchat.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @copyright (C) 2015 onwebchat.com
 *
 * This program can be used under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of the License.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
**/
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);

class plgSystemOnWebChatInstallerScript
{
    public $mainifest="onwebchat";
	public function preflight($route, $adapter) {}
    public function install($adapter) {}
    public function update($adapter) {}
    public function uninstall($adapter) {}
    public function postflight($route, $adapter)
    {
      return $this->fixManifest($adapter);
    }

    private function fixManifest($adapter)
    {
       $filesource = $adapter->get('parent')->getPath('source').'/'.$this->mainifest.'.j25.xml';
       $filedest = $adapter->get('parent')->getPath('extension_root').'/'.$this->mainifest.'.xml';

        if (!(JFile::copy($filesource, $filedest)))
        {
            JLog::add(JText::sprintf('JLIB_INSTALLER_ERROR_FAIL_COPY_FILE', $filesource, $filedest), JLog::WARNING, 'jerror');

            if (class_exists('JError'))
            {
                JError::raiseWarning(1, 'JInstaller::install: '.JText::sprintf('Failed to copy file to', $filesource, $filedest));
            }
            else
            {
                throw new Exception('JInstaller::install: '.JText::sprintf('Failed to copy file to', $filesource, $filedest));
            }
            return false;
        }
		return JFile::delete($adapter->get('parent')->getPath('extension_root').'/'.$this->mainifest.'.j25.xml');
    }
}
