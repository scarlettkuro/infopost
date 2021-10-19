<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Description of NewsPost
 *
 * @author owkomarow
 */
class NewsPost extends ActiveRecord {
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => false,
                    ActiveRecord::EVENT_BEFORE_UPDATE => false 
                ],
            ],
        ];
    }
    
    public function getLastView()
    {
        return \DateTime::createFromFormat('U', $this->last_view);
    }

}
