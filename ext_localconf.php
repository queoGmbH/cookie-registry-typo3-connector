<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(
    function($extKey)
    {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Queo.CookieRegistryConnector',
            'CookieList',
            [
                'CookieRegistry' => 'list,userSettings',
            ],
            // non-cacheable actions
            [
                'CookieRegistry' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Queo.CookieRegistryConnector',
            'CookieRegistryJson',
            [
                'CookieRegistry' => 'json',
            ],
            // non-cacheable actions
            [
                'CookieRegistry' => 'json'
            ]
        );
    },
    $_EXTKEY
);
