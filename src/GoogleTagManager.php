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

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use lhs\googletagmanager\models\Settings;
use lhs\googletagmanager\variables\GoogleTagManagerVariable;
use yii\base\Event;

/**
 * Class GoogleTagManager
 *
 * @author  La Haute Société
 * @package GoogleTagManager
 * @since   1.0.0
 */
class GoogleTagManager extends Plugin
{
    /**
     * @var GoogleTagManager
     */
    public static GoogleTagManager $plugin;

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.2';

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            static function (Event $event) {
                /**
            * @var CraftVariable $variable 
            */
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

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        // Get and pre-validate the settings
        $settings = $this->getSettings();
        $settings->validate();

        // Get the settings that are being defined by the config file
        $overrides = Craft::$app->getConfig()->getConfigFromFile(strtolower($this->handle));

        return Craft::$app->view->renderTemplate(
            'google-tag-manager/settings',
            [
                'settings'  => $settings,
                'overrides' => array_keys($overrides),
            ]
        );
    }
}
