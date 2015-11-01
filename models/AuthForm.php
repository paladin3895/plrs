<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\plrs\Patient;

/**
 * AuthForm is the model behind the patient authentication form.
 */
class AuthForm extends Model
{
    public $name;
    public $passcode;
    // public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'passcode'], 'required'],
            // ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            // 'verifyCode' => 'Verification Code',
        ];
    }

    public function auth()
    {
        if ($this->validate()) {
            $patient = Patient::find()->where([
                'name' => $this->name,
                'passcode' => $this->passcode
            ])->one();
            if ($patient) {
                return $patient->id;
            }
        }
        return false;
    }
}
