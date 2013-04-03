<?php

function afterburner_process_css($css, $theme) {
	global $CFG;
	
    // Set the background image for the logo
    if (!empty($theme->settings->logo)) {
        $cache = cache::make('theme_afterburner', 'settings');
		if (!$logo = $cache->get('logo')) {
			require_once($CFG->libdir.'/adminlib.php');
			$filename = get_config('theme_afterburner','logo'); // 'theme_afterburner/logo' from settings.php.
			$context = context_system::instance();
			$logo = admin_setting_configfilepicker::get_file($filename, $context, 'theme_afterburner', 'logo');
			$cache->set('logo', $logo);
		}
    } else {
        $logo = null;
    }
    $css = afterburner_set_logo($css, $logo);

    // Set custom CSS
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = afterburner_set_customcss($css, $customcss);

    return $css;
}

function afterburner_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = $OUTPUT->pix_url('images/logo', 'theme');
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function afterburner_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
