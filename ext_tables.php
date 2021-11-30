<?php
defined( 'TYPO3_MODE' ) || die( 'Access denied.' );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Queo.CookieRegistryConnector',
    'CookieList',
    'Cookie List'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Queo.CookieRegistryConnector',
    'CookieRegistryJson',
    'Cookie Registry JSON'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('cookie_registry_connector', 'Configuration/TypoScript', 'Cookie Registry Typo3 Connector');
$pluginSignature = str_replace('_', '','cookie_registry_connector') . '_cookielist';
