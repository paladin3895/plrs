<?php

namespace app\models\plrs\base;

use Yii;

/**
 * This is the base model class for table "report".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $operator_id
 * @property string $date
 *
 * @property \app\models\plrs\Operator $operator
 * @property \app\models\plrs\Patient $patient
 * @property \app\models\plrs\ReportTest[] $reportTests
 */
class Report extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'patient_id' => Yii::t('app', 'Patient ID'),
            'operator_id' => Yii::t('app', 'Operator ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperator()
    {
        return $this->hasOne(\app\models\plrs\Operator::className(), ['id' => 'operator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(\app\models\plrs\Patient::className(), ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportTests()
    {
        return $this->hasMany(\app\models\plrs\ReportTest::className(), ['report_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\ReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ReportQuery(get_called_class());
    }
}
