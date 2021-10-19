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
                    ActiveRecord::EVENT_BEFORE_INSERT => false, //'last_view',
                    ActiveRecord::EVENT_BEFORE_UPDATE => false 
                ],
            ],
        ];
    }
    
    public function getLastView()
    {
        if (is_null($this->last_view)) 
        {
            return NULL;
        }
        
        return \DateTime::createFromFormat('U', $this->last_view);
    }
    
    public function wasSeen() 
    {
        $this->touch('last_view');
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
        ];
    }

}
