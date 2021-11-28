<?php

use yii\db\Migration;

/**
 * Class m211126_142013_news
 */
class m211126_142013_news extends Migration
{
    /**
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news',[
            'id'            => $this->primaryKey(),
            'title'         => $this->string()->notNull(),
            'description'   => $this->string()->notNull(),
            'author'        => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('news');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211126_142013_post cannot be reverted.\n";

        return false;
    }
    */
}
