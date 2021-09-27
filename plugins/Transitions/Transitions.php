<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\Transitions;

/**
 */
class Transitions extends \Piwik\Plugin
{
    /**
     * @see \Piwik\Plugin::registerEvents
     */
    public function registerEvents()
    {
        return array(
            'AssetManager.getStylesheetFiles'        => 'getStylesheetFiles',
            'AssetManager.getJavaScriptFiles'        => 'getJsFiles',
            'Translate.getClientSideTranslationKeys' => 'getClientSideTranslationKeys',
            'API.getPagesComparisonsDisabledFor'     => 'getPagesComparisonsDisabledFor',
            'CoreAdminHome.getWhatIsNew'             => 'getWhatIsNew',
        );
    }

    public function getWhatIsNew(&$newItems)
    {
        $newItems[] = ['title' => 'New feature x added',
                       'description' => 'Now you can do y with z like this',
                       'linkName' => 'For more information go here',
                       'link' => 'https://www.matomo.org'];
    }

    public function getPagesComparisonsDisabledFor(&$pages)
    {
        $pages[] = "General_Actions.Transitions_Transitions";
    }

    public function getStylesheetFiles(&$stylesheets)
    {
        $stylesheets[] = 'plugins/Transitions/stylesheets/transitions.less';
    }

    public function getJsFiles(&$jsFiles)
    {
        $jsFiles[] = 'plugins/Transitions/javascripts/transitions.js';
        $jsFiles[] = 'plugins/Transitions/angularjs/transitionswitcher/transitionswitcher.controller.js';
    }

    public function getClientSideTranslationKeys(&$translationKeys)
    {
        $translationKeys[] = 'General_TransitionsRowActionTooltipTitle';
        $translationKeys[] = 'General_TransitionsRowActionTooltip';
        $translationKeys[] = 'Actions_PageUrls';
        $translationKeys[] = 'Actions_WidgetPageTitles';
        $translationKeys[] = 'Transitions_NumPageviews';
        $translationKeys[] = 'CoreHome_ThereIsNoDataForThisReport';
        $translationKeys[] = 'General_Others';
    }
}
