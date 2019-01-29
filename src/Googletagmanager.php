<?php
/**
 * Google Tag Manager plugin for Craft CMS 3.x
 *
 * Google Tag Manager
 *
 * @link      https://www.lahautesociete.com
 * @copyright Copyright (c) 2019 La Haute Société
 */

namespace lhs\googletagmanager;

use lhs\googletagmanager\variables\GoogleTagManagerVariable;
use lhs\googletagmanager\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class GoogleTagManager
 *
 * @author    La Haute Société
 * @package   GoogleTagManager
 * @since     1.0.0
 *
 */
class GoogleTagManager extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var GoogleTagManager
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('googleTagManager', GoogleTagManagerVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'google-tag-manager',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'google-tag-manager/settings',
            [
                'settings' => $this->getSettings(),
            ]
        );
    }
}
