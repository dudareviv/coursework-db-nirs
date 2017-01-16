<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\Leader]].
 *
 * @see \common\models\Leader
 */
class LeaderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Leader[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Leader|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
