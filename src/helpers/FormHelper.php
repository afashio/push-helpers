<?php


namespace afashio\pushHelpers\helpers;


use vova07\imperavi\Widget;
use Yii;
use yii\helpers\Url;

/**
 * Class FormHelper
 *
 * @package backend\helpers
 */
abstract class FormHelper
{

    /**
     * @return array|array[]
     */
    private static function getImperaviWidgetConfig(): array
    {
        return [
            'settings' => [
                'lang' => Yii::$app->language,
                'minHeight' => 200,
                'imageUpload' => Url::to(['content-image-upload']),
                'plugins' => [
                    'fullscreen',
                    'imagemanager',
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    private static function getImperaviWidget(): string
    {
        return Widget::class;
    }

    /**
     * @return string
     */
    public static function textEditorWidgetClass(): string
    {
        return self::getImperaviWidget();
    }

    /**
     * @return array|array[]
     */
    public static function textEditorConfig(): array
    {
        return self::getImperaviWidgetConfig();
    }
}