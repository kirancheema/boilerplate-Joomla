<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FooNamespace\Component\Foos\Site\View\Foo;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

/**
 * HTML Foos View class for the Foo component
 *
 * @since  __BUMP_VERSION__
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The page parameters
	 *
	 * @var    \Joomla\Registry\Registry|null
	 * @since  __BUMP_VERSION__
	 */
	protected $params = null;

	/**
	 * The item model state
	 *
	 * @var    \Joomla\Registry\Registry
	 * @since  __BUMP_VERSION__
	 */
	protected $state;

	/**
	 * The item object details
	 *
	 * @var    \JObject
	 * @since  __BUMP_VERSION__
	 */
	protected $item;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		$item = $this->item = $this->get('Item');

		$state = $this->State = $this->get('State');
		$params = $this->Params = $state->get('params');
		$itemparams = new Registry(json_decode($item->params));

		$temp = clone $params;

		/**
		 * $item->params are the foo params, $temp are the menu item params
		 * Merge so that the menu item params take priority
		 *
		 * $itemparams->merge($temp);
		 */

		// Merge so that foo params take priority
		$temp->merge($itemparams);
		$item->params = $temp;

		Factory::getApplication()->triggerEvent('onContentPrepare', array ('com_foos.foo', &$item));

		// Store the events for later
		$item->event = new \stdClass;
		$results = Factory::getApplication()->triggerEvent('onContentAfterTitle', array('com_foos.foo', &$item, &$item->params));
		$item->event->afterDisplayTitle = trim(implode("\n", $results));

		$results = Factory::getApplication()->triggerEvent('onContentBeforeDisplay', array('com_foos.foo', &$item, &$item->params));
		$item->event->beforeDisplayContent = trim(implode("\n", $results));

		$results = Factory::getApplication()->triggerEvent('onContentAfterDisplay', array('com_foos.foo', &$item, &$item->params));
		$item->event->afterDisplayContent = trim(implode("\n", $results));

		return parent::display($tpl);
	}
}
