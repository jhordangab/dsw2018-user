<?php

use yii\db\Migration;
use yii\db\Schema;

class m180315_115927_log extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->dropTable('{{%balancete_log}}');
        
        $this->createTable('{{%log_importacao}}', 
        [
            'id' => Schema::TYPE_PK,
            'log' => Schema::TYPE_STRING . ' not null',
            'empresa_nome' => Schema::TYPE_STRING . ' not null',
            'mes' => Schema::TYPE_INTEGER . ' not null',
            'ano' => Schema::TYPE_INTEGER . ' not null',
            'tipo' => Schema::TYPE_STRING . '(1) not null',
            'usuario' => Schema::TYPE_STRING . ' not null',
            'dt_log' => Schema::TYPE_TIMESTAMP . ' null',
        ], $tableOptions);
                
        return true;
    }

    public function down()
    {
        $this->dropTable('{{%log_importacao}}');
        
        return true;
    }
}
