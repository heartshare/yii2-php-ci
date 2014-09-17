<?php

namespace app\models\query;

use yii\db\ActiveQuery;

class ModulesQuery extends ActiveQuery
{
    /**
     * sated the status for the module
     *
     * @param bool $stated
     * @return ActiveQuery $this
     */
    public function enabled($stated = true)
    {
        $this->andWhere(['disabled' => $stated ? 0 : 1]);

        return $this;
    }
}
