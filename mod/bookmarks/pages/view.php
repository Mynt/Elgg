<?php
/**
 * View a bookmark
 *
 * @package ElggBookmarks
 */

$bookmark = get_entity(get_input('guid'));

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "pg/bookmarks/group/$page_owner->guid/owner");
} else {
	elgg_push_breadcrumb($crumbs_title, "pg/bookmarks/owner/$page_owner->username");
}

$title = $bookmark->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($bookmark, true);
$content .= elgg_view_comments($bookmark);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
	'header' => '',
));

echo elgg_view_page($title, $body);