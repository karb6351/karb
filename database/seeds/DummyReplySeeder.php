<?php

use Illuminate\Database\Seeder;
use App\Reply;

class DummyReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Reply::class, 5000)->create();
    }
}
