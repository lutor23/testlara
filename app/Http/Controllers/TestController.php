<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Charts;

class TestController extends Controller
{
    public function index()
    {
        $chart = Charts::create('line', 'highcharts')
            ->title('My nice chart')
            ->labels(['First', 'Second', 'Third'])
            ->values([5,10,20])
            ->dimensions(1500,500)
            ->responsive(false);

   // $chart  = Charts::multi('line', 'c3')
   //  ->title('my coold chart')
   //  ->colors(['#ff0000', '#00ff00', '#0000ff'])
   //  ->labels(['2016-04', '2016-05', '2016-06'])
   //  ->dataset('Test 1', [1,2,3])
   //  ->dataset('Test 2', [0,6,0])
   //  ->dataset('Test 3', [3,4,1]);


$chart = Charts::realtime(url('/json'), 2000, 'gauge', 'google')
            ->values([3,0,200])
            ->labels(['First', 'Second', 'Third'])
            ->responsive(false)
            ->height(300)
            ->width(0)
            ->title("Permissions Chart")
            ->valueName('value')
            ->interval(3000); // in ms

            $total=Charts::assets();
            return $total . $chart->render();

        return view('charting', ['chart' => $chart]);
    }
}