<?php
/**
 * Google Tag Manager plugin for Craft CMS 3.x
 *
 * Google Tag Manager
 *
 * @link      https://www.lahautesociete.com
 * @copyright Copyright (c) 2019 La Haute Société
 */

namespace lhs\googletagmanager\variables;

use craft\web\View;
use lhs\googletagmanager\GoogleTagManager;

use Craft;

/**
 * @author    La Haute Société
 * @package   GoogleTagManager
 * @since     1.0.0
 */
class GoogleTagManagerVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function headSection()
    {
        $containerID = GoogleTagManager::getInstance()->getSettings()->containerID;

        if (!$containerID) {
            return '<!-- GoogleTagManage plugin : containerID is not set -->';
        }

        return $this->renderPluginTemplate('head', [
            'containerID' => $containerID,
        ]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function bodySection()
    {
        $containerID = GoogleTagManager::getInstance()->getSettings()->containerID;

        if (!$containerID) {
            return '<!-- GoogleTagManage plugin : containerID is not set -->';
        }

        return $this->renderPluginTemplate('body', [
            'containerID' => $containerID,
        ]);
    }


    /**
     * @param $template
     * @param $data
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    protected function renderPluginTemplate($template, $data)
    {

        $oldMode = \Craft::$app->view->getTemplateMode();
        \Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate(GoogleTagManager::$plugin->handle . '/sections/' . $template,
            $data);
        \Craft::$app->view->setTemplateMode($oldMode);

        return new \Twig\Markup($html, 'UTF-8');
    }
}
