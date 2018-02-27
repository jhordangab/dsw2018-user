<?php

use yii\db\Migration;

class m180223_213645_categoria_pai extends Migration
{
    public function safeUp()
    {
        $two = Yii::$app->db->createCommand("SELECT codigo FROM categoria_padrao WHERE length(codigo) = 2")->queryAll();
        
        foreach($two as $w)
        {
            $p = substr($w['codigo'], 0, 1);
            Yii::$app->db->createCommand("UPDATE categoria_padrao SET is_service = 0, codigo_pai = {$p} WHERE codigo = {$w['codigo']}")->execute();
        }
        
        $three = Yii::$app->db->createCommand("SELECT codigo FROM categoria_padrao WHERE length(codigo) = 3")->queryAll();
        
        foreach($three as $w)
        {
            $p = substr($w['codigo'], 0, 2);
            Yii::$app->db->createCommand("UPDATE categoria_padrao SET is_service = 0, codigo_pai = {$p} WHERE codigo = {$w['codigo']}")->execute();
        }
        
        $four = Yii::$app->db->createCommand("SELECT codigo FROM categoria_padrao WHERE length(codigo) = 4")->queryAll();
        
        foreach($four as $w)
        {
            $p = substr($w['codigo'], 0, 3);
            Yii::$app->db->createCommand("UPDATE categoria_padrao SET is_service = 0, codigo_pai = {$p} WHERE codigo = {$w['codigo']}")->execute();
        }
        
        $six = Yii::$app->db->createCommand("SELECT codigo FROM categoria_padrao WHERE length(codigo) = 6")->queryAll();
        
        foreach($six as $w)
        {
            $p = substr($w['codigo'], 0, 4);
            Yii::$app->db->createCommand("UPDATE categoria_padrao SET is_service = 0, codigo_pai = {$p} WHERE codigo = {$w['codigo']}")->execute();
        }
        
        $eight = Yii::$app->db->createCommand("SELECT codigo FROM categoria_padrao WHERE length(codigo) = 8")->queryAll();
        
        foreach($eight as $w)
        {
            $p = substr($w['codigo'], 0, 6);
            Yii::$app->db->createCommand("UPDATE categoria_padrao SET is_service = 1, codigo_pai = {$p} WHERE codigo = {$w['codigo']}")->execute();
        }
        
        $nine = Yii::$app->db->createCommand("SELECT codigo FROM categoria_padrao WHERE length(codigo) = 9")->queryAll();
        
        foreach($nine as $w)
        {
            $p = substr($w['codigo'], 0, 6);
            Yii::$app->db->createCommand("UPDATE categoria_padrao SET is_service = 1, codigo_pai = {$p} WHERE codigo = {$w['codigo']}")->execute();
        }
        
        $ten = Yii::$app->db->createCommand("SELECT codigo FROM categoria_padrao WHERE length(codigo) = 10")->queryAll();
        
        foreach($ten as $w)
        {
            $p = substr($w['codigo'], 0, 6);
            Yii::$app->db->createCommand("UPDATE categoria_padrao SET is_service = 1, codigo_pai = {$p} WHERE codigo = {$w['codigo']}")->execute();
        }
        
//        SELECT 
//            tatara.desc_codigo,  
//            tara.desc_codigo,  
//            bisa.desc_codigo, 
//            vo.desc_codigo, 
//            pai.desc_codigo, 
//            filho.desc_codigo
//        FROM agrocontar.categoria_padrao filho 
//        LEFT JOIN  agrocontar.categoria_padrao pai ON filho.codigo_pai = pai.codigo
//        LEFT JOIN  agrocontar.categoria_padrao vo ON pai.codigo_pai = vo.codigo
//        LEFT JOIN  agrocontar.categoria_padrao bisa ON vo.codigo_pai = bisa.codigo
//        LEFT JOIN  agrocontar.categoria_padrao tara ON bisa.codigo_pai = tara.codigo
//        LEFT JOIN  agrocontar.categoria_padrao tatara ON tara.codigo_pai = tatara.codigo
//        WHERE filho.is_service = 1 
//        ORDER BY
//            tatara.desc_codigo,  
//            tara.desc_codigo,  
//            bisa.desc_codigo, 
//            vo.desc_codigo, 
//            pai.desc_codigo, 
//            filho.desc_codigo;
                
        return true;
    }

    public function safeDown()
    {
        echo "m180223_213645_categoria_pai cannot be reverted.\n";

        return true;
    }
}
