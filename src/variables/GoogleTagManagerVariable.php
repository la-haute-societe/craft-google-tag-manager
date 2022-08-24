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

use Craft;
use craft\web\View;
use lhs\googletagmanager\GoogleTagManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Markup;
use yii\base\Exception;

/**
 * @author    La Haute Société
 * @package   GoogleTagManager
 * @since     1.0.0
 */
class GoogleTagManagerVariable
{
    /**
     * @return string|Markup
     * @throws Exception
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function headSection(): string|Markup
    {
        $containerID = GoogleTagManager::getInstance()->getSettings()->containerID;

        if (!$containerID) {
            return new Markup('<!-- GoogleTagManage plugin : containerID is not set -->', 'UTF-8');
        }

        return $this->renderPluginTemplate('head', [
            'containerID' => $containerID,
        ]);
    }

    /**
     * @return string|Markup
     * @throws Exception
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function bodySection(): string|Markup
    {
        $containerID = GoogleTagManager::getInstance()->getSettings()->containerID;

        if (!$containerID) {
            return new Markup('<!-- GoogleTagManage plugin : containerID is not set -->', 'UTF-8');
        }

        return $this->renderPluginTemplate('body', [
            'containerID' => $containerID,
        ]);
    }


    /**
     * @param $template
     * @param $data
     * @return string|Markup
     * @throws Exception
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function renderPluginTemplate($template, $data): string|Markup
    {

        $oldMode = \Craft::$app->view->getTemplateMode();
        \Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate(GoogleTagManager::$plugin->handle . '/sections/' . $template,
            $data);
        \Craft::$app->view->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }
}
