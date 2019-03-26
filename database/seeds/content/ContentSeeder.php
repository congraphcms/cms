<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContentSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        Model::unguard();
        $this->call(LocaleSeeder::class);
        $this->call(EntityTypeSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(AttributeSetSeeder::class);
        $this->call(FileSeeder::class);
        $this->call(EntitySeeder::class);
        Model::reguard();
    }
}
