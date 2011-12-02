<?php
/**
 * @version		$Id: helper.php 10554 2008-07-15 17:15:19Z ircmaxell $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(JPATH_BASE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class modStickyHelper {
	function getItem($articleId, &$params)
	{
		global $mainframe;

		$dispatcher	=& JDispatcher::getInstance();
		$table		= modStickyHelper::getModel();

		$model = modStickyHelper::getModel();
		$article = $model->getItem($articleId);

		if ($article == null) {
			JError::raiseWarning( 0, 'Article not found by id: ' . $articleId );
			return $false;
		}

		$aparams		=& $article->parameters;
		$params->merge($aparams);

		$article->readmore_link = JRoute::_(ContentHelperRoute::getArticleRoute($article->id));

		/*
		 * Handle display events
		*/
		$article->event = new stdClass();
		$results = $dispatcher->trigger('onAfterDisplayTitle', array ($article, &$params));
		$article->event->afterDisplayTitle = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onBeforeDisplayContent', array (& $article, & $params));
		$article->event->beforeDisplayContent = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onAfterDisplayContent', array (& $article, & $params));
		$article->event->afterDisplayContent = trim(implode("\n", $results));

		return $article;
	}

	/**
	 * Get articel here...
	 *
	 * @return ContentModelArticle
	 */
	function getModel() {
		if (!class_exists('ContentModelArticle')){
			require JPATH_BASE . DS . 'components' . DS . 'com_content' . DS . 'models' . DS . "article.php";
		}
		return new ContentModelArticle();
	}

}
