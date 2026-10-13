<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateTransactions extends BaseMigration
{
    /**
     * Change Method.
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('transactions');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('amount', 'decimal', [
            'default' => null,
            'precision' => 10,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
        ]);
        $table->create();
    }
}
