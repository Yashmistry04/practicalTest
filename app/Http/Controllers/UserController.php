<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function interestCalculator()
    {
        return view('interestCalculator');
    }

    public function getInterest(Request $request)
    {
        $rule = array(
            'inerestType' => 'required',
            'duration' => 'required',
            'interestRate' => 'required',
        );
        if(!empty($request->inerestType)){
            $rule['pricipalAmount'] = 'required';
        }
        $validation =  $request->validate($rule);

        $inerestType   = $request->inerestType;
        $pricipalAmount = $request->pricipalAmount;
        $interestRate   = $request->interestRate;
        $timePeriod     = $request->duration;
        if($inerestType == 'FD'){
            $temp = $timePeriod / 100;
            $interestAmount = $pricipalAmount * $interestRate *$temp;
            $totalAmount = $pricipalAmount + $interestAmount;
        }
        $totalInvestAmount = '';
        if($inerestType == 'RD'){
            $temp = $interestRate / 100;
            $interestAmount = $totalAmount = 0;
            for ($i=1; $i <= $timePeriod ; $i++) { 
                $totalAmount += $pricipalAmount * pow(1+ ($temp/4) , ( 4*($i/12)));
            }
            $totalAmount = round($totalAmount);
            $totalInvestAmount = $pricipalAmount * $timePeriod;
            $interestAmount = $totalAmount - $totalInvestAmount;
        }
        return view('interestCalculator',['totalAmount'=>$totalAmount,
        'interestAmount'=>$interestAmount,'pricipalAmount'=>$pricipalAmount,
        'interestRate'=>$interestRate,'timePeriod'=>$timePeriod,
        'inerestType'=>$inerestType,'totalInvestAmount'=>$totalInvestAmount]);
    }


}
