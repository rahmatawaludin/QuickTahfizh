<?php

namespace bootstrap\widgets;

/**
 * Twitter-Bootstrap 2.1.1 Navbar Widget
 * To start, navbars are static (not fixed to the top) and include support for a project name and basic navigation. Place one anywhere within a .container, which sets the width of your site and content.
 * 
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @copyright Copyright &copy; 2012-2012 Php Indonesia <Dashboard Jawa Barat>
 * @version $Id$
 * @package bootstrap-2.1.1-widgets
 */

/**
 * example use: 		
  $this->widget('\\bootstrap\\widgets\\Navbar', array(
  'type' => \bootstrap\widgets\Navbar::type_inverse,
  'display' => \bootstrap\widgets\Navbar::display_fixed_top,
  'htmlOptions' => array(
  'class' => 'test',
  ),
  //			'brand'=>false,
  'nav' => array(
  array(
  'items' => array(
  '|',
  array('label' => 'Dashboard', 'url' => array('/administration/dashboard/index')),
  array('label' => 'dropdown example', 'url' => 'javascript:void(0);', 'items' => array(
  array('label' => 'list1', 'url' => 'javascript:void(0);'),
  '-',
  array('label' => 'list2', 'url' => 'javascript:void(0);'),
  '-',
  )),
  '|',
  ),
  ),
  ),
  ));

 */
class Navbar extends \CWidget
{
	/**
	 * constant for inverse type navbar (black navbar)
	 */
	const type_inverse = 'navbar-inverse';
	/**
	 * constant for inverse type default (white navbar) 
	 */
	const type_default = '';
	/**
	 * navbar normal position display
	 */
	const display_default = '';
	/**
	 * Fix the navbar to the top of the viewport. You need to change any padding on the body.
	 */
	const display_fixed_top = 'navbar-fixed-top';
	/**
	 * Fix the navbar to the bottom of the viewport
	 */
	const display_fixed_bottom = 'navbar-fixed-bottom';

	/**
	 *  Create a full-width navbar that scrolls away with the page
	 */
	const display_static_top = 'navbar-static-top';

	/**
	 * Brand label
	 * @var string A simple link to show your brand or project name. use false for disabled this functionality.
	 */
	public $brand = null;

	/**
	 * Brand Url
	 * @var mixed url for your brand text.
	 */
	public $brandUrl;

	/**
	 * Html Options
	 * @var array your navbar htmlOptions. 
	 */
	public $htmlOptions = array();

	/**
	 * Brand Html Options
	 * @var array Html Options for brand text 
	 */
	public $brandHtmlOptions = array();

	/**
	 * Inner of Navbar Html Options
	 * @var array navbar-inner html Options
	 */
	public $innerHtmlOptions = array();

	/**
	 * collapse div Navbar Html Options
	 * @var array
	 */
	public $collapseNavHtmlOptions = array();

	/**
	 * Type
	 * @var string type of navbar. use const with prefix type_
	 */
	public $type = self::type_default;

	/**
	 * Display
	 * @var string navbar display, fixed top, bottom, or static. Use const with prefix display_
	 */
	public $display = self::display_default;

	/**
	 * nav
	 * @var mixed navigation items content.
	 */
	public $nav = array();

	/**
	 * additional container
	 * @var mixed additional container navigation items content.
	 */
	public $additionalContainer = array();

	/**
	 * Collapse?
	 * @var boolean if true this widget will generate collapsible bootstrap navbar. 
	 */
	public $collapse = true;
	public $collapseDataTarget = '.nav-collapse';
	public $useJs = true;

	/**
	 * init bootstrap navbar.
	 * assign web app name to default brand text
	 * assign web app home url to default brand url
	 * append all Html Options.
	 */
	public function init()
	{
		if (is_null($this->brand))
			$this->brand = \Yii::app()->name;
		if (is_null($this->brandUrl))
			$this->brandUrl = \Yii::app()->homeUrl;
		if ($this->display === self::display_fixed_top)
			\Yii::app()->getClientScript()->registerCss('navbar_fixed_top-body-padding', '
				@media (min-width: 980px){
					body{padding-top:60px}
				}');
		$this->appendAllHtmlOptions();
	}

	/**
	 * Append All Html Options.
	 * assign htmlOptions, brandHtmlOptions, InnerHtmlOptions to default bootstrap Navbar Css. 
	 */
	protected function appendAllHtmlOptions()
	{
		if (isset($this->htmlOptions["class"]))
			$this->htmlOptions["class"].=" navbar $this->type $this->display";
		else
			$this->htmlOptions["class"] = "navbar $this->type $this->display";
		if (isset($this->brandHtmlOptions["class"]))
			$this->brandHtmlOptions["class"].=" brand";
		else
			$this->brandHtmlOptions["class"] = "brand";
		$this->innerHtmlOptions["class"] = (isset($this->innerHtmlOptions["class"])) ? $this->innerHtmlOptions["class"] . " navbar-inner" : "navbar-inner";
		$this->collapseNavHtmlOptions['class'] = (isset($this->collapseNavHtmlOptions['class'])) ? $this->collapseNavHtmlOptions['class'] . ' nav-collapse' : 'nav-collapse';
	}

	/**
	 * generate your navbar to view.
	 */
	public function run()
	{
		echo \CHtml::openTag('div', $this->htmlOptions);
		echo \CHtml::openTag('div', $this->innerHtmlOptions);
		echo ($this->display === self::display_default) ? '<div class="container">' : '<div class="container-fluid">';
		if ($this->collapse)
		{
			if ($this->useJs)
				\Yii::app()->clientScript->registerScriptFile(\Yii::app()->bootstrap->getAssetUrl() . "/js/bootstrap-collapse.js");
			\Yii::app()->bootstrap->responsive = true;
			\Yii::app()->bootstrap->init();
			echo sprintf('<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="%s">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>', $this->collapseDataTarget);
		}
		$nav = '';
		if ($this->nav != array())
		{
			$nav = $this->printoutItems($this->nav);
		}
		$additionalcontainer = '';

		if ($this->additionalContainer != array())
		{
			$additionalcontainer = $this->printoutItems($this->additionalContainer);
		}

		if ($this->brand !== false)
		{
			echo \CHtml::link($this->brand, $this->brandUrl, $this->brandHtmlOptions);
			echo $additionalcontainer;
			echo $this->collapse ? \CHtml::tag('div', $this->collapseNavHtmlOptions, $nav, true) : $nav;
		}
		else
		{
			echo $additionalcontainer;
			echo $this->collapse ? \CHtml::tag('div', $this->collapseNavHtmlOptions, $nav, true) : $nav;
		}
		echo '</div>';
		echo \CHtml::closeTag('div');
		echo \CHtml::closeTag('div');
	}

	public function printoutItems($menus)
	{
		$nav = '';
		foreach ($menus as $menu)
		{
			if (is_array($menu))
			{
				$menu['type'] = '';
				$nav .= $this->widget(isset($menu['class']) ? $menu['class'] : '\\bootstrap\\widgets\\Nav', $menu, true);
			}
			else
				$nav.=$menu;
		}
		return $nav;
	}
}

?>
