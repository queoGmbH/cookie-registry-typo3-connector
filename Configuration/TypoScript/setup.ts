plugin.tx_cookieregistryconnector {
	settings {
		configurationYamlPath = {$plugin.tx_cookieregistryconnector.settings.configurationYamlPath}
		enable = {$plugin.tx_cookieregistryconnector.enable}
		excludePids = {$plugin.tx_cookieregistryconnector.settings.excludePids}
	}

	view {
		templateRootPaths.0 = {$plugin.tx_cookieregistryconnector.view.templateRootPaths.0}
		partialRootPaths.0 = {$plugin.tx_cookieregistryconnector.view.partialRootPaths.0}
		layoutRootPaths.0 = {$plugin.tx_cookieregistryconnector.view.layoutRootPaths.0}
	}

	cookies = {$plugin.tx_cookieregistryconnector.cookies}
	cookieCategories = {$plugin.tx_cookieregistryconnector.cookieCategories}

}

jsonPageType = PAGE
jsonPageType {

	typeNum = 12783490
	10 = USER
	10 {
		userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
		extensionName = CookieRegistryConnector
		pluginName = CookieRegistryJson
		vendorName = Queo
	}

	config {
		disableAllHeaderCode = 1
		additionalHeaders = Content-type:application/json
		additionalHeaders.10.header = Content-type:application/json
		xhtml_cleaning = 0
		admPanel = 0
		debug = 0
		no_cache = 1
	}
}

page.includeJSFooter {
	cookieRegistryLib = {$plugin.tx_cookieregistryconnector.settings.includeJSFooter.cookieRegistryInit}
	cookieRegistryInit = {$plugin.tx_cookieregistryconnector.settings.includeJSFooter.cookieRegistryInit}
}