<?php

namespace App\Http\Controllers\API\Reports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class LogsReportData
 * @package App\Http\Controllers\API\Reports
 */
class LogsReportData {

    /**
     * @return array
     */
    public function generateReportData()
    {
        return [
            'day' => $this->getByDay(),
            'week' => $this->getByWeek(),
            'month' => $this->getByMonth(),
        ];
    }

    private function getByDay()
    {
        $aResult = DB::table('t_visit_logs')
            ->select(DB::raw('(created_at) as type'), DB::raw('count(vs_id) as value'))
            ->groupBy(DB::raw('(created_at)'))
            ->where(DB::raw('DATE(created_at)'), Carbon::now()->toDateString())
            ->orderBy('created_at', 'asc')
            ->get()->toArray();
        return $this->flattenData($aResult)->first();
    }
    private function getByWeek()
    {
        $aResult = DB::table('t_visit_logs')
            ->select(DB::raw('DAYNAME(created_at) as type'), DB::raw('count(vs_id) as value'))
            ->groupBy(DB::raw('DAYNAME(created_at)'))
            ->where(DB::raw('YEARWEEK(created_at, 0)'), DB::raw('YEARWEEK(CURDATE(), 0)'))
            ->orderBy('created_at', 'asc')
            ->get()->toArray();
        return $this->flattenData($aResult);
    }
    private function getByMonth()
    {
        $aResult = DB::table('t_visit_logs')
            ->select(DB::raw('CEILING(DATE_FORMAT(created_at,"%d")/7) as type'), DB::raw('count(vs_id) as value'))
            ->groupBy(DB::raw('CEILING(DATE_FORMAT(created_at,"%d")/7)'))
            ->where(DB::raw('MONTH(created_at)'), DB::raw('MONTH(CURRENT_DATE())'))
            ->where(DB::raw('YEAR(created_at)'), DB::raw('YEAR(CURRENT_DATE())'))
            ->orderBy('created_at', 'desc')
            ->get()->toArray();
        return $this->flattenData($aResult);
    }

    private function flattenData(array $aData)
    {
        $aResult = [];
        foreach ($aData as $aValue) {
            $aResult[$aValue->type] = $aValue->value;
        }
        return $aResult;
    }
}
