<?php

namespace app\models\plrs;

use Yii;
use \app\models\plrs\base\Report as BaseReport;

/**
 * This is the model class for table "report".
 */
class Report extends BaseReport
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'operator_id', 'date'], 'required'],
            [['patient_id', 'operator_id'], 'integer'],
            [['date'], 'safe']
        ];
    }
	
}
