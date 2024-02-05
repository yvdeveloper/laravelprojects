<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataCalculatorController extends Controller
{
    public function index()
    {
        //$ls = [0, 1, 3, 6, 10];
        //$ls = [1, 2, 3, 4, 5, 6];
        $ls = [744125, 935, 407, 454, 430, 90, 144, 6710213, 889, 810, 2579358];
        $final[] = array_sum($ls);
        foreach($ls as $index => $value)
        {
            if(count($ls)!=0) array_shift($ls);
            $final[] = array_sum($ls);   
        }
        dd(json_encode($final));
    }

}

