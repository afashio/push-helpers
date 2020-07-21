<?php


namespace afashio\pushHelpers\utils;


use rico\yii2images\models\Image;
use yii\base\Model;

/**
 * Class ImageUtil
 *
 * @package afashio\pushHelpers\utils
 */
abstract class ImageUtil
{

    public static function delete(Model $model, $id)
    {
        $image = Image::findOne($id);
        return $model->removeImage($image);

    }
    public static function getImageUrls(Model $model)
    {
        $images = [];
        foreach ($model->getImages() as $image){
            $images[] = $image->getUrl();
        }

        return $images;
    }

}