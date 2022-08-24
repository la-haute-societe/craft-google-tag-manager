<?php
/**
 * google-tag-manager plugin for Craft CMS 3.x
 *
 * Google Tag Manager
 *
 * @link      https://www.lahautesociete.com
 * @copyright Copyright (c) 2019 La Haute Société
 */

namespace lhs\googletagmanager\models;

use craft\base\Model;

/**
 * Googletagmanager Settings Model
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    La Haute Société
 * @package   Googletagmanager
 * @since     1.0.0
 */
class Settings extends Model
{
    /**
     * Google Tag Manager - Container ID
     * @var string
     */
    public string $containerID = '';

    /**
     * Returns the validation rules for attributes.
     * @return array
     */
    public function rules(): array
    {
        return [
            ['containerID', 'string'],
        ];
    }
}
