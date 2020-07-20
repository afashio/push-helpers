<?php


namespace afashio\pushHelpers\traits;


use afashio\pushHelpers\interfaces\BasicStatusInterface;
use Yii;
use yii\base\InvalidArgumentException;

/**
 * Trait BasicStatusTrait
 *
 * @package common\traits
 */
trait BasicStatusTrait
{

    /**
     * @return int
     */
    public static function getActiveStatus()
    {
        return BasicStatusInterface::STATUS_ACTIVE;
    }

    /**
     * @return int
     */
    public static function getInActiveStatus()
    {
        return BasicStatusInterface::STATUS_INACTIVE;
    }

    /**
     * @param $statusID
     *
     * @return string
     * @throws \yii\base\InvalidArgumentException
     */
    public static function getStatus($statusID): string
    {
        $list = self::status_list();
        if (isset($list[$statusID])) {
            return $list[$statusID];
        }

        throw new InvalidArgumentException('Given status is not valid!');
    }

    /**
     * @return array
     */
    public static function status_list()
    {
        return [
            BasicStatusInterface::STATUS_INACTIVE => Yii::t('app', 'Не отображать'),
            BasicStatusInterface::STATUS_ACTIVE => Yii::t('app', 'Отображать'),
        ];
    }

}