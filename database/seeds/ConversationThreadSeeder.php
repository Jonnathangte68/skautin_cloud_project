<?php

use Illuminate\Database\Seeder;

class ConversationThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversation_thread')->insert([
            'id' => 1,
            'user_a' => 'X',
            'user_b' => 'Y',
        ]);
    }
}
