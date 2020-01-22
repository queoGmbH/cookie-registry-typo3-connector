<?php

namespace Queo\CookieRegistryConnector\Controller;

use Queo\CookieRegistry\CookieRegistry;
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

        if ((int)$this->settings['enable'] === 1) {
            $cookieRegistrySettings = [
                'configurationYamlPath' => PATH_site . 'config/configuration.prod.yml',
                'languageKey'           => $_GET['languageKey']
            ];

            $this->cookieRegistry = CookieRegistry::get($cookieRegistrySettings);
        }
    }

    /**
     *
     */
    public function jsonAction()
    {
        return $this->cookieRegistry->getRegistryJson();
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