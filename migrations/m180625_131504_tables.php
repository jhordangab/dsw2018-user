<?php

use yii\db\Migration;
use yii\db\Schema;

class m180625_131504_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%estado_regiao}}', 
        [
            'id' => Schema::TYPE_PK,
            'uf' => Schema::TYPE_STRING . ' not null',
            'nome_estado' => Schema::TYPE_STRING . ' not null',
            'regiao' => Schema::TYPE_STRING . ' not null',
            'sigla_regiao' => Schema::TYPE_STRING . ' not null',
            'tipo_regiao' => Schema::TYPE_STRING . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        $this->batchInsert('{{%estado_regiao}}', ['uf', 'nome_estado', 'regiao', 'sigla_regiao', 'tipo_regiao'], 
        [
            ['RO','RONDÔNIA','NORTE','N','REGIÃO 2'],
            ['AC','ACRE','NORTE','N','REGIÃO 2'],
            ['AM','AMAZONAS','NORTE','N','REGIÃO 2'],
            ['RR','RORAIMA','NORTE','N','REGIÃO 2'],
            ['PA','PARÁ','NORTE','N','REGIÃO 2'],
            ['AP','AMAPÁ','NORTE','N','REGIÃO 2'],
            ['TO','TOCANTINS','NORTE','N','REGIÃO 2'],
            ['MA','MARANHÃO','NORDESTE','NE','REGIÃO 2'],
            ['PI','PIAUÍ','NORDESTE','NE','REGIÃO 2'],
            ['CE','CEARÁ','NORDESTE','NE','REGIÃO 2'],
            ['RN','RIO GRANDE DO NORTE','NORDESTE','NE','REGIÃO 2'],
            ['PB','PARAÍBA','NORDESTE','NE','REGIÃO 2'],
            ['PE','PERNAMBUCO','NORDESTE','NE','REGIÃO 2'],
            ['AL','ALAGOAS','NORDESTE','NE','REGIÃO 2'],
            ['SE','SERGIPE','NORDESTE','NE','REGIÃO 2'],
            ['BA','BAHIA','NORDESTE','NE','REGIÃO 2'],
            ['MG','MINAS GERAIS','SUDESTE','SE','REGIÃO 1'],
            ['ES','ESPIRITO SANTO','SUDESTE','SE','REGIÃO 1'],
            ['RJ','RIO DE JANEIRO','SUDESTE','SE','REGIÃO 1'],
            ['SP','SÃO PAULO','SUDESTE','SE','REGIÃO 1'],
            ['PR','PARANÁ','SUL','S','REGIÃO 1'],
            ['SC','SANTA CATARINA','SUL','S','REGIÃO 1'],
            ['RS','RIO GRANDE DO SUL','SUL','S','REGIÃO 1'],
            ['MS','MATO GROSSO DO SUL','CENTRO OESTE','CO','REGIÃO 2'],
            ['MT','MATO GROSSO','CENTRO OESTE','CO','REGIÃO 2'],
            ['GO','GOIÁS','CENTRO OESTE','CO','REGIÃO 2'],
            ['DF','DISTRITO FEDERAL','CENTRO OESTE','CO','REGIÃO 2']
        ]);
        
        $this->createTable('{{%faixa_faturamento}}', 
        [
            'id' => Schema::TYPE_PK,
            'nome' => Schema::TYPE_STRING . ' not null',
            'faturamento_inicial' => Schema::TYPE_MONEY . ' not null',
            'faturamento_final' => Schema::TYPE_MONEY . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        $this->batchInsert('{{%faixa_faturamento}}', ['nome', 'faturamento_inicial', 'faturamento_final'], 
        [
            ['DE R$ 0,00 ATÉ R$ 15.000.000,00', 0, 15000000],
            ['DE R$ 15.000.000,00 ATÉ R$ 50.000.000,00', 15000000, 50000000],
            ['ACIMA DE R$ 50.000.000,00', 50000000, 999999999]
        ]);
        
        $this->createTable('{{%bandeira}}', 
        [
            'id' => Schema::TYPE_PK,
            'nome' => Schema::TYPE_STRING . ' not null',
            'referencia' => Schema::TYPE_STRING . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        $this->batchInsert('{{%bandeira}}', ['nome', 'referencia'], 
        [
            ['BANDEIRA 1', 'BAYER'],
            ['BANDEIRA 2', 'GENERICO'],
            ['BANDEIRA 3', 'SYNGENTA'],
            ['BANDEIRA 4', 'DU PONT'],
            ['BANDEIRA 5', 'BASF']
        ]);
        
        $this->createTable('{{%segmento}}', 
        [
            'id' => Schema::TYPE_PK,
            'nome' => Schema::TYPE_STRING . ' not null',
            'referencia' => Schema::TYPE_STRING . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        $this->batchInsert('{{%segmento}}', ['nome', 'referencia'], 
        [
            ['SEGMENTO 1', 'HF'],
            ['SEGMENTO 2', 'GRÃOS'],
        ]);
        
        $this->createTable('{{%empresa_dado}}', 
        [
            'id' => Schema::TYPE_PK,
            'empresa_id' => Schema::TYPE_BIGINT . ' not null',
            'regiao_id' => Schema::TYPE_INTEGER . ' not null',
            'faixa_faturamento_id' => Schema::TYPE_INTEGER . ' not null',
            'bandeira_id' => Schema::TYPE_INTEGER . ' not null',
            'segmento_id' => Schema::TYPE_INTEGER . ' not null',
            'unidade' => Schema::TYPE_STRING . ' not null',
            'is_ativo' => Schema::TYPE_BOOLEAN . ' not null default TRUE',
            'is_excluido' => Schema::TYPE_BOOLEAN . ' not null default FALSE',
            'created_at' => Schema::TYPE_TIMESTAMP . ' null',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' null',
            'created_by' => Schema::TYPE_INTEGER . ' null',
            'updated_by' => Schema::TYPE_INTEGER . ' null',
        ], $tableOptions);
        
        $this->addForeignKey('emda_empr_fk', '{{%empresa_dado}}', 'empresa_id', 'admin_empresa', 'id');
        $this->addForeignKey('emda_regi_fk', '{{%empresa_dado}}', 'regiao_id', '{{%estado_regiao}}', 'id');
        $this->addForeignKey('emda_fafa_fk', '{{%empresa_dado}}', 'faixa_faturamento_id', '{{%faixa_faturamento}}', 'id');
        $this->addForeignKey('emda_band_fk', '{{%empresa_dado}}', 'bandeira_id', '{{%bandeira}}', 'id');
        $this->addForeignKey('emda_segm_fk', '{{%empresa_dado}}', 'segmento_id', '{{%segmento}}', 'id');
        
        return true;
    }

    public function safeDown()
    {
        $this->dropTable('{{%empresa_dado}}');
        $this->dropTable('{{%segmento}}');
        $this->dropTable('{{%bandeira}}');
        $this->dropTable('{{%faixa_faturamento}}');
        $this->dropTable('{{%estado_regiao}}');

        return true;
    }
}
