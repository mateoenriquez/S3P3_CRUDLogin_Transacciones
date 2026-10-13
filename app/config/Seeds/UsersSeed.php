<?php
declare(strict_types=1);

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Migrations\BaseSeed;

/**
 * Users seed.
 */
class UsersSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#seed-seeding
     *
     * @return void
     */
    public function run(): void
    {
        $hasher = new DefaultPasswordHasher();
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'email' => 'mateoenriquez@gmail.com',
                'password' => $hasher->hash('Mateo12345*'),
                'created' => $now,
                'modified' => $now,
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
