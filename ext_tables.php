<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
$extKey = $_EXTKEY;

if (TYPO3_MODE === 'BE') {

};
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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Cookie Registry Typo3 Connector');
$pluginSignature = str_replace('_', '', $extKey) . '_cookielist';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
    'FILE:EXT:cookie_registry_typo3_connector/Configuration/FlexForms/flexform_cookie_list.xml');