<?php

namespace Queo\CookieRegistryConnector\Controller;

use Queo\CookieRegistry\CookieRegistry;
use Queo\CookieRegistry\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CookieRegistryController extends ActionController
{
    /**
     * @var CookieRegistry
     */
    protected $cookieRegistry;
    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $configurationManager;
    /**
     * @var ConfigurationUtility
     */
    protected $configurationUtility;
    /**
     * @var array
     */
    protected $settings = [];

    public function initializeAction()
    {
        parent::initializeAction();

        if ($GLOBALS['TYPO3_REQUEST']) {
            /**
             * @var $siteLanguage SiteLanguage
             */
            $siteLanguage = $GLOBALS['TYPO3_REQUEST']->getAttribute('language');
            $languageCode = $siteLanguage->getTwoLetterIsoCode();
        } else {
            $languageCode = 'de';
        }


        // get configuration
        $this->configurationUtility = new ConfigurationUtility($this->settings['configurationYamlPath']);
        $configuration              = $this->configurationUtility->getMergedConfiguration();
        $toggleOnStartup = true;

        // get excluded pids
        $excludedPids = explode(',', $this->settings['excludePids']);
        // disable cookie-consent, if current pid matches ignorePids and system-cookie is not already set
        if (
            in_array($GLOBALS['TSFE']->id, $excludedPids) &&
            ! array_key_exists($configuration['settings']['settingsStorageCookie'], $_COOKIE)
        ) {
            $toggleOnStartup = false;
        }

        if ((int)$this->settings['enable'] === 1) {
            $yamlPath = $this->settings['configurationYamlPath'];

            $cookieRegistrySettings = [
                'configurationYamlPath' => \TYPO3\CMS\Core\Core\Environment::getPublicPath() . '/' . $yamlPath,
                'languageKey'           => $languageCode,
                'toggleOnStartup' => $toggleOnStartup
            ];
            $this->cookieRegistry = CookieRegistry::get($cookieRegistrySettings);
        }
    }

    /**
     *
     */
    public function jsonAction()
    {
        if ($this->cookieRegistry) {
            return $this->cookieRegistry->getRegistryJson();
        }
    }

    /**
     *
     */
    public function listAction()
    {
        $cookieList           = $this->cookieRegistry->getCookies();
        $cookieCategoriesList = $this->cookieRegistry::getCookieCategories();

        $this->view->assignMultiple([
            'cookieList'         => $cookieList,
            'cookieCategoryList' => $cookieCategoriesList
        ]);
    }
}