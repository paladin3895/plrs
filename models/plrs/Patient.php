<?php

namespace app\models\plrs;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $passcode
 *
 * @property Report[] $reports
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'passcode'], 'required'],
            [['name', 'email', 'passcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'passcode' => 'Passcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['patient_id' => 'id']);
    }
}
