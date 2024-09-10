<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image_decision}}`.
 */
class m240909_073421_create_image_decision_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image_decision}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->unique()->notNull(),
            'is_approved' => $this->boolean()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image_decision}}');
    }
}
