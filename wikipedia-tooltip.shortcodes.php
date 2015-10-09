<?php

function wt_shortcode($atts, $content) {
	
    $a = shortcode_atts( array(
        'lang' => 'en',
		'title' => $content
	), $atts);

	$url = 'wikipedia.org/wiki/';
	
	return <<<HTML
<a href="http://{$a['lang']}.{$url}{$a['title']}" target="_blank" class="wikipedia-tooltip">{$content}</a>
HTML;
}
add_shortcode('wikipedia', 'wt_shortcode');