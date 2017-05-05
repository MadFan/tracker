<?php

use yii\db\Schema;

class m170505_070101_click_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('click', [
            'id' => $this->primaryKey(),
            'click_id' => $this->char(64)->notNull(),
            'ua' => $this->text()->notNull(),
            'ip' => $this->integer(11)->notNull(),
            'ref' => $this->text(),
            'param1' => $this->string(256)->notNull(),
            'param2' => $this->string(256),
            'error' => $this->integer(8)->defaultValue(0),
            'bad_domain' => $this->integer(8)->defaultValue(0),
            ], $tableOptions);
                
    }

    public function down()
    {
        $this->dropTable('click');
    }
}
