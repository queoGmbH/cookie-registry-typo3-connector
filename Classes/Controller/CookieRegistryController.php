<?php

namespace Queo\CookieRegistryConnector\Controller;

use Queo\CookieRegistry\CookieRegistry;
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
     * @inject
     */
    protected $configurationManager;
    /**
     * @var array
     */
    protected $settings = [];

    public function initializeAction()
    {
        parent::initializeAction();

        /**
         * @var $siteLanguage SiteLanguage
         */
        $siteLanguage = $GLOBALS['TYPO3_REQUEST']->getAttribute('language');

        // disable cookie-consent, if current pid matches ignorePids
        $excludedPids = explode(',', $this->settings['excludePids']);

        if (in_array($GLOBALS['TSFE']->id, $excludedPids)) {
            $this->settings['enable'] = 0;
        }

        if ((int)$this->settings['enable'] === 1) {
            $yamlPath = $this->settings['configurationYamlPath'];

            $cookieRegistrySettings = [
                'configurationYamlPath' => PATH_site . $yamlPath,
                'languageKey'           => $siteLanguage->getTwoLetterIsoCode()
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