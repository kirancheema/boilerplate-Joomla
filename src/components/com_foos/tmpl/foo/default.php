<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
\defined('_JEXEC') or die;

<<<<<<< HEAD
use Joomla\CMS\Language\Text;

<<<<<<< HEAD
if ($this->get('State')->get('params')->get('show_foo_name_label')) {
	echo Text::_('COM_FOOS_NAME');
}

echo $this->item->name;
=======
echo Text::_('COM_FOOS_NAME') . $this->item->name;
=======
<?php
echo $this->item->name;
>>>>>>> origin/t7
>>>>>>> origin/t8
