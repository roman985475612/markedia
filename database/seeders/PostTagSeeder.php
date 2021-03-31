<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        
        for ($i = 1; $i <= 20; $i++) {
            for ($j = 0; $j <= 2; $j++) {
                $records[] = [
                    'post_id'    => $i, 
                    'tag_id'     => rand(1, 10),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        DB::table('post_tag')->insert($records);
    }
}
