<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$attributes = array();

if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
}

if ($item->anchor_css)
{
	$attributes['class'] = $item->anchor_css;
}

if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}

$linktype = $item->title;

if ($item->params->get('menu_subtitle', ''))
{
	$linktype .= '<br /><small>' . $item->params->get('menu_subtitle') . '</small>';
}

if ($item->menu_icon == 'html' && $item->menu_icon_html)
{
	$icon = $item->menu_icon_html;

}
if ($item->menu_icon == 'image' && $item->menu_image)
{
	if ($item->menu_image_css)
	{
		$image_attributes['class'] = $item->menu_image_css;
		$icon = JHtml::_('image', $item->menu_image, $item->title, $image_attributes);
	}
	else
	{
		$icon = JHtml::_('image', $item->menu_image, $item->title);
	}
}

if (!empty($icon))
{
	if ($item->params->get('menu_text', 1))
	{
		$linktype = ($item->params->get('menu-icon_direction', 'before') == 'after') ?
			'<span class="image-title image-title-before">' . $linktype . '</span>' . $icon :
			$icon . '<span class="image-title image-title-after">' . $linktype . '</span>';
	}
	else
	{
		$linktype = $icon;
	}
}

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

if ($item->params->get('menu-anchor_attrs', ''))
{
	$pattern = '/(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?/';
	preg_match_all($pattern, $item->params->get('menu-anchor_attrs'), $anchor_attrs);
	if (!empty($anchor_attrs[1]))
	{
		foreach ($anchor_attrs[1] as $key => $name)
		{
			$value             = (!empty($anchor_attrs[2][$key])) ? $anchor_attrs[2][$key] : '';
			$attributes[$name] = $value;
		}
	}
}

echo JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);
