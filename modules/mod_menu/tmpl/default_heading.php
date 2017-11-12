<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$title      = $item->anchor_title ? ' title="' . $item->anchor_title . '"' : '';
$anchor_css = $item->anchor_css ?: '';

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

$attributes = $item->params->get('menu-anchor_attrs') ? ' ' . $item->params->get('menu-anchor_attrs') : '';
?>
<span class="nav-header <?php echo $anchor_css; ?>"<?php echo $title . $attributes; ?>><?php echo $linktype; ?></span>
