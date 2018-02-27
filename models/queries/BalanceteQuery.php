<?php

namespace app\models\queries;

class BalanceteQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[is_ativo]]=1');
    }
    
    public function exist()
    {
        return $this->andWhere('[[is_excluido]]=0');
    }

    public function all($db = null)
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}
