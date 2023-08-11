<?php
	$blog = queryBlog($_GET['id']);

	if (!validateUInt($_GET['id']) || $blog == null) {
		become404Page();
	}

	$canShow = true;
	foreach (queryBlogTags($_GET['id']) as $tag) {
		if (preg_match('/tutorial\-[1-9][0-9]{0,9}/', $tag)) {
			$ID = substr($tag, strpos($tag, '-') + 1);
			error_log($ID);
			if (!isProblemVisibleToUser(queryProblemBrief(intval($ID)), Auth::user())) {
				$canShow = false;
			}
		}
	}

	if (!$canShow) {
		become403Page();
	}

	redirectTo(HTML::blog_url($blog['poster'], '/post/'.$_GET['id']));
?>
