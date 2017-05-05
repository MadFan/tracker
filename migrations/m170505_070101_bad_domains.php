<?php

use yii\db\Schema;

class m170505_070101_bad_domains extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('bad_domains', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            ], $tableOptions);
                
    }

    public function down()
    {
        $this->dropTable('bad_domains');
    }
}
