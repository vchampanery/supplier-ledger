<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending_amount[] = ['label'=>'Overdue Amount','amount'=>'10'];
        $pending_amount[] = ['label'=>'Coming Month Amount','amount'=>'22'];
        $pending_amount[] = ['label'=>'Upcoming Month Amount','amount'=>'31'];
        $pending_amount[] = ['label'=>'Total','amount'=>'63'];

        $overdue_amount=[ 'AHMEDABAD'   => 1187302,
                        'BANGLOR'     => 688572,
                        'BOMBAY'      => 326404,
                        'DELHI'       => 472993,
                        'DHARMAVARAM' => 251192,
                        'HYDERABAD'   => 95550,
                        'JAIPUR'      => 233310,
                        'KOIMTUR'     => 235876,
                        'MUMBAI'      => 169689,
                        'RAJKOT'      => 133560,
                        'SURAT'       => 1044471,
                        'VARANASI'    => 112951];
        $current_month_amount=['AHMEDABAD' => 11802,
                            'DELHI'     => 7834,
                            'SURAT'     => 49280];
          $upcoming_month_amount=[ 'AHMEDABAD'   => 18482,
                            'BANGLOR'     => 602762,
                            'COIMBATORE'  => 123606,
                            'DELHI'       => 4245,
                            'MUMBAI'      => 3696,
                            'SURAT'       => 32197,
                            'VARANASI'    => 20837];
        $overdueAmount = 4963672;
        $currentMonthAmount = 57114;
        $comingMonthAmount = 805825;
        $totalAmount = 5826611;
        
        // chart data
        $donutLabels = ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'];
        $donutData   = [700, 500, 400, 600, 300, 100];

        $areaLabels  = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        $areaData1   = [28, 48, 40, 19, 86, 27, 90]; // Digital Goods
        // $areaData2   = [65, 59, 80, 81, 56, 55, 40]; // Electronics
        
        //dynamic data 
       $cityWise = \DB::table('bills as b')
    ->join('suppliers as s', 's.id', '=', 'b.supplier_id')
    ->join('cities as c', 'c.id', '=', 's.city_id')
    ->leftJoin(\DB::raw('(SELECT bill_number, SUM(amount) as paid_total 
                          FROM payments 
                          GROUP BY bill_number) p'), 'p.bill_number', '=', 'b.bill_number')
    ->select(
        'c.city',
        \DB::raw("SUM(CASE WHEN b.due_date < CURDATE() 
                          THEN (b.amount - IFNULL(p.paid_total, 0)) ELSE 0 END) as overdue_total"),
        \DB::raw("SUM(CASE WHEN MONTH(b.due_date) = MONTH(CURDATE()) 
                           AND YEAR(b.due_date) = YEAR(CURDATE()) 
                          THEN (b.amount - IFNULL(p.paid_total, 0)) ELSE 0 END) as current_month_due"),
        \DB::raw("SUM(CASE WHEN MONTH(b.due_date) = MONTH(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)) 
                           AND YEAR(b.due_date) = YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)) 
                          THEN (b.amount - IFNULL(p.paid_total, 0)) ELSE 0 END) as next_month_due")
    )
    ->groupBy('c.city')
    ->get();

         $areaLabels = $cityWise->pluck('city')->toArray();
         
        $areaData1  = $cityWise->pluck('overdue_total')->map(fn($v) => (float)$v)->toArray();
// totals row
$totals = \DB::table('bills as b')
    ->join('suppliers as s', 's.id', '=', 'b.supplier_id')
    ->join('cities as c', 'c.id', '=', 's.city_id')
    ->leftJoin(\DB::raw('(SELECT bill_number, SUM(amount) as paid_total 
                          FROM payments 
                          GROUP BY bill_number) p'), 'p.bill_number', '=', 'b.bill_number')
    ->select(
        \DB::raw("'TOTAL' as city"),
        \DB::raw("SUM(CASE WHEN b.due_date < CURDATE() 
                          THEN (b.amount - IFNULL(p.paid_total, 0)) ELSE 0 END) as overdue_total"),
        \DB::raw("SUM(CASE WHEN MONTH(b.due_date) = MONTH(CURDATE()) 
                           AND YEAR(b.due_date) = YEAR(CURDATE()) 
                          THEN (b.amount - IFNULL(p.paid_total, 0)) ELSE 0 END) as current_month_due"),
        \DB::raw("SUM(CASE WHEN MONTH(b.due_date) = MONTH(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)) 
                           AND YEAR(b.due_date) = YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)) 
                          THEN (b.amount - IFNULL(p.paid_total, 0)) ELSE 0 END) as next_month_due")
    )
    ->first();
        
      
        $totals_array = (array) $totals; 
        $donutLabels = array_keys($totals_array);    // ["overdue_total", "current_month_due", "next_month_due"]
        $donutLabels = $labels = array_map(function($key) {
    return ucwords(str_replace('_', ' ', $key));
}, $donutLabels); // ["city", "overdue_total", "current_month_due", "next_month_due"]
        $donutData = array_values($totals_array); // ["TOTAL", "400.00", "150.00", "100.00"]
       $cityWise->push($totals);
        $currentMonthAmount = $totals->current_month_due; 
        $comingMonthAmount = $totals->next_month_due; 
        $overdueAmount = $totals->overdue_total; 
        $totalAmount = $currentMonthAmount + $comingMonthAmount + $overdueAmount;
        return view('home2',compact('overdueAmount','currentMonthAmount','comingMonthAmount','totalAmount',
            'pending_amount','overdue_amount','current_month_amount','upcoming_month_amount',
        'donutLabels', 'donutData', 'areaLabels', 'areaData1','totals','cityWise'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
