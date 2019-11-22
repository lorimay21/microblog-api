<?php

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('firstname', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('lastname', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('username', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('birthday', 'date', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('age', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('gender', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true
        ]);
        $table->addColumn('is_enabled', 'boolean', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('image', 'string', [
            'default' => '/img/users/default.png',
            'limit' => 255,
            'null' => true
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false
        ]);
        $table->create();
    }
}
