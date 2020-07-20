<?php


namespace afashio\pushHelpers\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class UploadFile
 * @package app\modules\models
 */
abstract class UploadFile extends ActiveRecord
{
    /**
     * @param Model $model
     * @param bool $attach
     * @param string $fileInput
     * @return mixed
     */
    public static function upload(Model $model, $attach = false, $multiple = true , $fileInput = 'imageFiles')
    {
        if($multiple){
            $model->$fileInput = UploadedFile::getInstances($model, $fileInput);
        } else {
            $model->$fileInput = UploadedFile::getInstance($model, $fileInput);
        }
        if(!$model->$fileInput){
            return true;
        }
//        if ($model->validate()) {
            if(is_array($model->$fileInput)){
                foreach ($model->$fileInput as $key => $file) {
                    self::uploadImage($file, $model, $attach, $key);
                }
            } else {
                self::uploadImage($model->$fileInput, $model, $attach);
            }
            return true;
//        } else {
//           return $model->errors;
//        }
    }

    /**
     * @param UploadFile $file
     * @param Model $model
     * @param bool $attach
     *
     */
    private static function uploadImage(UploadedFile  $file, Model $model, $attach, $sort = 0)
    {
        $image = Yii::getAlias('@image') . $file->baseName . '.' . $file->extension;
        $file->saveAs($image);
        if ($attach) {
            /** @var \rico\yii2images\models\Image $image */
            $image = $model->attachImage($image);
            $image->save();
        }
    }

}