plugin.tx_cookieregistryconnector {
	enable = 1
	view {
		templateRootPaths.0 = EXT:cookie_registry_typo3_connector/Resources/Private/Templates/
		layoutRootPaths.0 = EXT:cookie_registry_typo3_connector/Resources/Private/Partials/
		partialRootPaths.0 = EXT:cookie_registry_typo3_connector/Resources/Private/Layouts/
	}

	cookies {

	}

	cookieCategories {

	}

	settings {
		configurationYamlPath = config/configuration.prod.yml
		includeJsFooter {
			cookieRegistryLib = EXT:hanse_site/Resources/Public/dist/shared/static/cookie-settings-manager.min.js
			cookieRegistryInit = EXT:cookie_registry_typo3_connector/Resources/Public/javascripts/initCookieRegistry.js
		}
	}
}
