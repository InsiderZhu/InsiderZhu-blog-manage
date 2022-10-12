<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
        	[
        		'link_name'=>'广东轻院',
        		'link_title'=>'国家示范性高校',
        		'link_url'=>'http://www.gdqy.edu.cn',
        		'link_order'=>1
        	],
        	[
        	    'link_name'=>'广东轻院2',
        		'link_title'=>'国家示范性高校2',
        		'link_url'=>'http://www.gdqy.edu.cn',
        		'link_order'=>2
        	]
        ];
        DB::table('links')->insert($data);
    }
}
