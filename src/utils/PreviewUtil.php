<?php


namespace afashio\pushHelpers\utils;

use rico\yii2images\models\Image;

/**
 * Class PreviewUtil
 *
 * @package afashio\pushHelpers\utils
 */
class PreviewUtil
{
    public $key;
    public $url;

    /**
     * PreviewUtil constructor.
     * @param Image $image
     *
     */

    public function __construct($image, $url )
    {
        $this->key = $image->getPrimaryKey();
        $this->url = $url;
    }

    public static function getPreviewOptions($url,$images)
    {
        $options = [];

        foreach ($images as $image){
            $options[] = new PreviewUtil($image, $url);
        }
        return $options;

    }



}