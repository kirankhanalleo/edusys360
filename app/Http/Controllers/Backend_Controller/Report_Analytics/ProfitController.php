<?php

namespace App\Http\Controllers\Backend_Controller\Report_Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinanceEmployeeSalary;
use App\Models\StudentFee;
use App\Models\MiscellaneousCost;
use PDF;

class ProfitController extends Controller
{
    public function ViewProfit()
    {
        return view('backend.analytics.profit.view_profit');
    }
    public function GetProfitByDate(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $start_dt = date('Y-m-d', strtotime($request->start_date));
        $end_dt = date('Y-m-d', strtotime($request->end_date));

        $studentFee = StudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $miscCost = MiscellaneousCost::whereBetween('date', [$start_dt, $end_dt])->sum('amount');
        $empSalary = FinanceEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $totalCost = $miscCost + $empSalary;
        $accountBal = $studentFee - $totalCost;

        $html['tableheader'] = '<h2 style="text-align:center;padding-bottom:0.5rem; padding-top:2rem;">Finance Report From ' . $start_dt . ' to ' . $end_dt . '</h2>';
        $html['tdsource'] = '<tr><th>Particulars</th>';
        $html['tdsource'] .= '<th>Amount (Rs.)</th></tr>';

        $html['tdsource'] .= '<tr><th>Student Fee</th>';
        $html['tdsource'] .= '<td><b>' . (int)$studentFee . '</b></td></tr>';

        $html['tdsource'] .= '<tr><th>Employee Salary</th>';
        $html['tdsource'] .= '<td><b>' . (int)$empSalary . '</b></td></tr>';

        $html['tdsource'] .= '<tr><th>Miscellaneous Cost</th>';
        $html['tdsource'] .= '<td><b>' . (int)$miscCost . '</b></td></tr>';

        $html['tdsource'] .= '<tr><th>Total Cost</th>';
        $html['tdsource'] .= '<td><b>' . (int)$totalCost . '</b></td></tr>';
        if ($accountBal > 0) {
            $html['tdsource'] .= '<tr><th>Total Profit</th>';
            $html['tdsource'] .= '<td><b>' . (int)$accountBal . '</b></td></tr>';
        } else {
            $html['tdsource'] .= '<tr><th>Total Loss</th>';
            $html['tdsource'] .= '<td><b>' . (int)$accountBal . '</b></td></tr>';
        }

        $html['tdsource'] .= '<th width="20%">Action</th>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a style="color:white; background:#df4759; padding:5px 3px; width:70%; border-radius:5px; max-width:max-content;" target="_blanks">Generate PDF</a>';
        $html['tdsource'] .= '</td>';

        $color = 'success';


        return response()->json(@$html);
    }
}
