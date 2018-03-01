<?php

use yii\db\Migration;
use yii\db\Schema;

class m180301_115559_status extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->addColumn("{{%balancete}}", 'status', Schema::TYPE_STRING . ' not null');
        $this->addColumn("{{%balancete}}", 'outras_adicoes', Schema::TYPE_MONEY . ' null');
        $this->addColumn("{{%balancete}}", 'outras_exclusoes', Schema::TYPE_MONEY . ' null');
        $this->addColumn("{{%balancete}}", 'base_negativa', Schema::TYPE_MONEY . ' null');
        $this->addColumn("{{%balancete}}", 'csll_retida', Schema::TYPE_MONEY . ' null');
        $this->addColumn("{{%balancete}}", 'prejuizo_anterior_compensar', Schema::TYPE_MONEY . ' null');
        $this->addColumn("{{%balancete}}", 'base_negativa_irpj', Schema::TYPE_MONEY . ' null');
        $this->addColumn("{{%balancete}}", 'irrf_mes', Schema::TYPE_MONEY . ' null');
        
        $this->addColumn("{{%balancete}}", 'valuation_metodo_ebitda', Schema::TYPE_INTEGER . ' null');
        $this->addColumn("{{%balancete}}", 'custo_capital_proprio', Schema::TYPE_INTEGER . ' null');

        return true;
    }

    public function down()
    {
        return true;
    }
}
