<?php


namespace afashio\pushHelpers\traits;


use afashio\pushHelpers\helpers\UploadFile;
use creocoder\translateable\TranslateableBehavior;
use Yii;

/**
 * Trait ModelTranslationTrait
 *
 * @package common\traits
 * @mixin TranslateableBehavior
 */
trait ModelTranslationTrait
{

    public function behaviors()
    {
        $behaviors = [
            'translateable' => [
                'class' => TranslateableBehavior::class,
                'translationAttributes' => ['text'],
                // translationRelation => 'translations',
                'translationLanguageAttribute' => 'language',
            ],
        ];

        return array_merge(parent::behaviors(), $behaviors);
    }

    public function saveModelWithImage($fileInput = 'imageFiles'): bool
    {
        if ($this->saveModel()) {
            UploadFile::upload($this, true, true, $fileInput);

            return true;
        }

        return false;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function saveModel(): bool
    {
         if ($this->load(Yii::$app->request->post())) {
            $translations = Yii::$app->request->post((new \ReflectionClass($this))->getShortName() . 'Lang', []);
            foreach ($translations as $language => $data) {
                foreach ($data as $attribute => $value) {
                    $this->translate($language)->$attribute = $value;
                }
            }

            return $this->save(false);
        }

        return false;
    }

}