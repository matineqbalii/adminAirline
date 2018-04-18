<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public $date="";
    public function index(){
        return view('Panel/panel');

    }
    public function getFlight(){
        return view('Panel/flight');

    }

    public function getDate($date='1397/1/4'){
        //input:1397/1/21
        //input for api :"2018-04-16T00:00:00"
        //output of carbon : 2018-04-18 10:20:30
        $myarray = explode('/', $date);

        $miladi = jalali_to_gregorian($myarray[0], $myarray[1], $myarray[2], 0);
        if ($miladi[1]<10)
            $miladi[1]="0$miladi[1]";
        if ($miladi[2]<10)
            $miladi[2]="0$miladi[2]";


        $myDate = "$miladi[0]-$miladi[1]-$miladi[2]";
        $carbon=explode(' ',Carbon::now());

//        return var_dump($myDate).'<br>'.var_dump($carbon[0]);
        if ($myDate < $carbon[0]){
            $myDateForApi = "$carbon[0]T00:00:00";
            $carbon=explode('-',$carbon[0]);
            $this->date=gregorian_to_jalali($carbon[0],$carbon[1],$carbon[2],1);

        }
        else{
            $myDateForApi = $myDate.'T00:00:00';
            $this->date="false";
        }

        return $myDateForApi;

    }

    public function getFlight2(Request $request){
        //$validation
        if ($request['OriginLocation']=='null')
            $request['OriginLocation']='';
        if ($request['DestinationLocation']=='null')
            $request['DestinationLocation']='';

        $validation=Validator::make($request->all(),[
            'DepartureDateTime' => 'required',
            'OriginLocation' => 'required',
            'DestinationLocation' => 'required'
        ]);

        if ($validation->fails())
            return $validation->errors();
        else{
            $json=[
                "POS"=> [
                    "Source"=> [
                        "RequestorID"=> [
                            "MessagePassword"=> "6eeb834b13420733904e2ae33b3d8821",
                            "Name"=> "ghasedak"
                        ],
                        "Language"=> null
                    ]
                ],
                "OriginDestinationInformation"=> [
                    "OriginLocation"=> [
                        "LocationCode"=> $request['OriginLocation']
                    ],
                    "DestinationLocation"=> [
                        "LocationCode"=> $request['DestinationLocation']
                    ],
                    "DepartureDateTime"=> [
                        "WindowBefore"=> 0,
                        "WindowAfter"=> 0,
                        "Value"=> $this->getDate($request['DepartureDateTime'])
                    ]
                ],
                "TravelPreferences"=> null,
                "TravelerInfoSummary"=> [
                    "AirTravelerAvail"=> [
                        "PassengerTypeQuantity"=> [
                            [
                                "Code"=> "ADT",
                                "Quantity"=> $request['adult']
                            ],
                            [
                                "Code"=> "CHD",
                                "Quantity"=> $request['child']
                            ],
                            [
                                "Code"=> "INF",
                                "Quantity"=> $request['baby']
                            ]
                        ]
                    ]
                ]
            ];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://sepehrapitest.ir/api/OpenTravelAlliance/Air/AirLowFareSearchV6",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>json_encode($json),

                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" ;
            } else {
                $response=json_decode($response,true);
                return ['response'=>$response,'date'=> $this->date];

            }

        }





    }
}
