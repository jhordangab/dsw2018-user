<?php

use yii\db\Migration;
use yii\db\Schema;

class m180308_122414_saldo_inicial extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%saldo_inicial}}', 
        [
            'id' => Schema::TYPE_PK,
            'empresa_id' => Schema::TYPE_INTEGER . ' not null',
            'empresa_nome' => Schema::TYPE_STRING . ' not null',
            'mes' => Schema::TYPE_INTEGER . ' not null',
            'ano' => Schema::TYPE_INTEGER . ' not null',
            'categoria_id' => Schema::TYPE_BIGINT . ' not null',
            'valor' => Schema::TYPE_MONEY . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        return true;
    }

    public function down()
    {
        $this->dropTable('{{%saldo_inicial}}');

        return true;
    }
}
