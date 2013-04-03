<?php
function afterburner_process_css($css, $theme) {
    global $CFG;

    // Set the background image for the logo.
    $logo = null;
    if (!empty($theme->settings->logo)) {
        if ($logourl = get_config('theme_afterburner', 'logo')) { // ... 'theme_afterburner/logo' from settings.php.
            $logofile = moodle_url::make_file_url("$CFG->httpswwwroot/pluginfile.php", $logourl);
            $logo = $logofile->out(false);
        }
    }
    $css = afterburner_set_logo($css, $logo);

    // Set custom CSS.
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
