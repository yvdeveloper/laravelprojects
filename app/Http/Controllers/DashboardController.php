<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    {

        return view('dashboard', [
            "gender_report"=> $this->gender_report()[0],
            'salary_report'=>$this->sum_salary()[0],
            'age_report' => $this->age_report()[0]
        ]);
    }

    private function gender_report()
    {
        return Employee::selectRaw("SUM(CASE WHEN gender = 1 THEN 1 ELSE 0 END) as Male, SUM(CASE WHEN gender = 2 THEN 1 ELSE 0 END) as Female")
        ->where(['is_deleted'=>0])->get();
    }

    private function sum_salary()
    {
        return Employee::selectRaw("FORMAT(SUM(monthly_salary),2) as total_salary")
        ->where(['is_deleted'=>0])->get();
    }

    private function age_report()
    {
        return Employee::selectRaw("FORMAT(AVG(DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0),2) AS average_age")
        ->where(["is_deleted"=>0])->get();
    }
}
