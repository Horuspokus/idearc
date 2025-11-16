<?php

if ( ! defined('THEMIFY_UPDATER_MENU_PAGE') ) die();

$options = get_option('themify_updater_licence', '');
$username = $key = $noticeEmail = '';
$hideKey = $hideName = $hideNotice = $notification = false;
if ( !empty($options) ) {
    $options = json_decode( $options,true);
    if ( is_array($options) ) {
        $username = $options['username'];
        $key = $options['key'];
        $hideKey = isset($options['hideKey']) ? $options['hideKey'] : false;
        $hideName = isset($options['hideName']) ? $options['hideName'] : false;
        $hideNotice = isset($options['hideNotice']) ? $options['hideNotice'] : false;
        $notification = isset($options['notification']) ? $options['notification'] : false;
        $noticeEmail = isset($options['noticeEmail']) ? $options['noticeEmail'] : '';
    }
}

if ($hideKey) {
    $key = preg_replace("/[0-9a-zA-Z]/", "*", $key);
}

if ($hideName) {
    $username = preg_replace("/[0-9a-zA-Z_-]/", "*", $username);
}

require (THEMIFY_UPDATER_DIR_PATH.'/templates/admin_menu.php');