<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EarningsController extends Controller
{
    public function index($DS=null,$data=null)
    {
        if(empty($data) || empty($DS))
        {
            return response()->json([
                'status'=>400,
                'message'=>"Please check the parameters"
            ]);
        }
        //http://127.0.0.1:8000/helper/earningscalculator/100/[%228%20ABMRB%2024.50%22,%228%20BBMRB%2020%22,%228%20BAMRB%2050%22]

        //$DsE = ["8 ABMRB 24.50","8 BBMRB 20","8 BAMRB 50"];
        //dd($DsE);
        $DsE = json_decode($data);
        $DS = floatval($DS);
        
        $earnings = [];
        foreach($DsE as $value)
        {
            $earnings[] = $this->daily_earnings($value);
        }
        $total_earnings = array_sum($earnings);
        $average_earnings = $total_earnings/count($earnings);
        $message = "";
        if($average_earnings>$DS)
        {
            $message = "Good earnings. Extra money per day: ".number_format($average_earnings-$DS,2);
            
        }
        else
            $message="Hard times. Money needed: ". number_format(($DS*count($earnings))-$total_earnings,2);

        return response()->json([
            'status'=>200,
            'message'=>$message
        ]);
    }

    private function daily_earnings($data)
    {
        $DsE = explode(" ",$data);
        $paths = str_split($DsE[1], 1);
        $bottle_count = 0;
        for($i = 1; $i <= $DsE[0];)
        {
            $path = $paths[($i<=count($paths)?$i-1:($i-1)-count($paths))];
            if($path==="B") $bottle_count++;
            $i++;

        }
        return $bottle_count * $DsE[2];
    }
}
