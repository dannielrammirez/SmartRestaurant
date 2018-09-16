<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%constant%}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'constant_id' => $this->integer()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->addForeignKey('fk_constant_id', '{{%constant}}', 'constant_id', '{{%constant}}', 'id');

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'identificacion_type' => $this->integer()->notNull(),
            'identification_number' => $this->integer()->notNull(),
            'full_name' => $this->string()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'job_id' => $this->integer()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->addForeignKey('identificacion_type', '{{%user}}', 'job_id', '{{%constant}}', 'id');
        $this->addForeignKey('fk_job_id', '{{%user}}', 'job_id', '{{%constant}}', 'id');

        $this->insert('{{%constant}}', [
            'description' => 'TIPO DE IDENTIFICACION',
            'status' => 10,
            'created_at' => time()
        ]);

        $this->insert('{{%constant}}', [
            'description' => 'Cedula de Ciudadania',
            'constant_id' => 1,
            'status' => 10,
            'created_at' => time()
        ]);

        $this->insert('{{%constant}}', [
            'description' => 'OCUPACION',
            'status' => 10,
            'created_at' => time()
        ]);

        $this->insert('{{%constant}}', [
            'description' => 'Administrador',
            'constant_id' => 3,
            'status' => 10,
            'created_at' => time()
        ]);

        $this->insert('{{%user}}', [
            'identificacion_type' => 1,
            'identification_number' => 1013632701,
            'full_name' => 'Administrador General',
            'username' => 'admin',
            'job_id' => 4,
            'auth_key' => 'tLc_m-KPOqGPN3wMmixZ01BocqKVZ1KH',
            'password_hash' => '$2y$13$e04oqDfeKwhXndkC2VqP8eLbV8Y11g.VDfzSuigqOHX92xCmTWRw6',
            'email' => 'admin@admin.com',
            'status' => 10,
            'created_at' => time()
        ]);

        $this->createTable('{{%rol}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->createTable('{{%user_rol}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'rol_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->addForeignKey('fk_user_id', '{{%user_rol}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk_rol_id', '{{%user_rol}}', 'rol_id', '{{%rol}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
