<?php

use Illuminate\Database\Seeder;
use App\chartoptions;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('ChartOptionsTable');
        $this->command->info('Chart options table seeded!');        
    }
}




class ChartOptionsTable extends Seeder {

    public function run()
    {
        DB::table('chartoptions')->delete();

        chartoptions::create(['charttype' => 'line', 'library' => 'chartjs' , 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'highcharts', 'multiple'=>1, 'realtime'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'google', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'material', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'chartist', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'fusioncharts', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'morris', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'plottablejs', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'minimalist', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'line', 'library' => 'c3', 'multiple'=>1]);


        chartoptions::create(['charttype' => 'area', 'library' => 'chartjs', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'highcharts', 'multiple'=>1, 'realtime'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'google', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'chartist', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'fusioncharts', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'morris', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'plottablejs', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'minimalist', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'area', 'library' => 'c3', 'multiple'=>1]);

        chartoptions::create(['charttype' => 'bar', 'library' => 'chartjs', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'highcharts', 'multiple'=>1, 'realtime'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'google', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'material', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'chartist', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'fusioncharts', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'morris', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'plottablejs', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'minimalist', 'multiple'=>1]);
        chartoptions::create(['charttype' => 'bar', 'library' => 'c3', 'multiple'=>1]);        


        chartoptions::create(['charttype' => 'pie', 'library' => 'chartjs']);
        chartoptions::create(['charttype' => 'pie', 'library' => 'highcharts']);
        chartoptions::create(['charttype' => 'pie', 'library' => 'google']);
        chartoptions::create(['charttype' => 'pie', 'library' => 'chartist']);
        chartoptions::create(['charttype' => 'pie', 'library' => 'fusioncharts']);
        chartoptions::create(['charttype' => 'pie', 'library' => 'plottablejs']);
        chartoptions::create(['charttype' => 'pie', 'library' => 'minimalist']);
        chartoptions::create(['charttype' => 'pie', 'library' => 'c3']);    


        chartoptions::create(['charttype' => 'donut', 'library' => 'chartjs']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'highcharts']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'google']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'chartist']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'fusioncharts']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'morris']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'plottablejs']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'minimalist']);
        chartoptions::create(['charttype' => 'donut', 'library' => 'c3']);

        chartoptions::create(['charttype' => 'geo', 'library' => 'highcharts']);
        chartoptions::create(['charttype' => 'geo', 'library' => 'google']);

        chartoptions::create(['charttype' => 'temp', 'library' => 'canvas-gauges', 'realtime'=>1]);
                

        chartoptions::create(['charttype' => 'gauge', 'library' => 'google', 'realtime'=>1]);
        chartoptions::create(['charttype' => 'gauge', 'library' => 'c3']);
        chartoptions::create(['charttype' => 'gauge', 'library' => 'canvas-gauges', 'realtime'=>1]);
        chartoptions::create(['charttype' => 'gauge', 'library' => 'justgage', 'realtime'=>1]);
        

        chartoptions::create(['charttype' => 'percentage', 'library' => 'justgage', 'realtime'=>1 ]);
        chartoptions::create(['charttype' => 'percentage', 'library' => 'progressbarjs', 'realtime'=>1]);
        
        chartoptions::create(['charttype' => 'progressbar', 'library' => 'progressbarjs', 'realtime'=>1]);

    }

}