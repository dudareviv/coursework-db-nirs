<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\Speciality]].
 *
 * @see \common\models\Speciality
 */
class SpecialityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Speciality[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Speciality|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
