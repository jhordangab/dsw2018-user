<?php

use yii\db\Migration;
use yii\db\Schema;

class m180621_120027_alteracao_indicador extends Migration
{
    public function safeUp()
    {
        $this->dropColumn("{{%balancete}}", 'valuation_metodo_ebitda');
        $this->dropColumn("{{%balancete}}", 'custo_capital_proprio');
        
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%resultado_indicador}}', 
        [
            'id' => Schema::TYPE_PK,
            'empresa_id' => Schema::TYPE_INTEGER . ' not null',
            'ano' => Schema::TYPE_INTEGER . ' not null',
            'valuation_metodo_ebitda' => Schema::TYPE_INTEGER . ' null',
            'custo_capital_proprio' => Schema::TYPE_INTEGER . ' null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        return true;
    }
    
    public function safeDown()
    {
        $this->dropTable('{{%resultado_indicador}}');

        return true;
    }
}
