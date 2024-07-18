<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            TruncateData::class,
            RoleSeeder::class,
            AdminSeeder::class,
            KS_waliKelas_role::class,
            KriteriaSeeder::class,
            SubKriteriaSeeder::class,
            KsSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
