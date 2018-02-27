<?php

use yii\db\Migration;
use yii\db\Schema;

class m180226_212045_balancetes extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%balancete}}', 
        [
            'id' => Schema::TYPE_PK,
            'empresa_id' => Schema::TYPE_INTEGER . ' not null',
            'mes' => Schema::TYPE_INTEGER . ' not null',
            'ano' => Schema::TYPE_INTEGER . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        $this->addForeignKey('{{%bala_empr_fk}}', '{{%balancete}}', 'empresa_id', '{{%empresa}}', 'id');
        
        $this->createTable('{{%balancete_valor}}', 
        [
            'id' => Schema::TYPE_PK,
            'balancete_id' => Schema::TYPE_INTEGER . ' not null',
            'categoria_id' => Schema::TYPE_BIGINT . ' not null',
            'valor' => Schema::TYPE_MONEY . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        $this->addForeignKey('{{%balavalo_bala_fk}}', '{{%balancete_valor}}', 'balancete_id', '{{%balancete}}', 'id');
        
        $this->createTable('{{%balancete_log}}', 
        [
            'id' => Schema::TYPE_PK,
            'balancete_id' => Schema::TYPE_INTEGER . ' not null',
            'categoria_id' => Schema::TYPE_STRING . ' not null',
            'valor' => Schema::TYPE_STRING . ' not null',
            'log' => Schema::TYPE_TEXT . ' not null',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
        ], $tableOptions);
        
        $this->addForeignKey('{{%balalog_bala_fk}}', '{{%balancete_log}}', 'balancete_id', '{{%balancete}}', 'id');
        
        return true;
    }

    public function down()
    {
        $this->dropTable('{{%balancete_log}}');
        $this->dropTable('{{%balancete_valor}}');
        $this->dropTable('{{%balancete}}');

        return true;
    }
}
