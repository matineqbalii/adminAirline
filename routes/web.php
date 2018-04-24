<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//
//
//});


use Carbon\Carbon;

Route::group(['middleware'=>'auth:web','prefix'=>'admin'],function (){
    $this->get('panel','AdminController@index')->name('adminPanel');
    $this->get('getFlight','AdminController@getFlight')->name('getFlight');
    $this->post('getFlight2','AdminController@getFlight2' )->name('getFlight2');
    $this->get('getFlight3','AdminController@getFlight3' )->name('getFlight3');
    $this->get('getFlight4','AdminController@getFlight4' )->name('getFlight4');








//    $this->get('getdate','AdminController@getDate' )->name('getDate');
//    $this->get('getFlight2', function (){
////        "2018-04-16T00:00:00"
//        $json=[
//            "POS"=> [
//                "Source"=> [
//                    "RequestorID"=> [
//                        "MessagePassword"=> "6eeb834b13420733904e2ae33b3d8821",
//                        "Name"=> "ghasedak"
//                    ],
//                    "Language"=> null
//                ]
//            ],
//            "OriginDestinationInformation"=> [
//                "OriginLocation"=> [
//                    "LocationCode"=> "thr"
//                ],
//                "DestinationLocation"=> [
//                    "LocationCode"=> "mhd"
//                ],
//                "DepartureDateTime"=> [
//                    "WindowBefore"=> 0,
//                    "WindowAfter"=> 0,
//                    "Value"=> "2018-04-24T00:00:00"
//                ]
//            ],
//            "TravelPreferences"=> null,
//            "TravelerInfoSummary"=> [
//                "AirTravelerAvail"=> [
//                    "PassengerTypeQuantity"=> [
//                        [
//                            "Code"=> "ADT",
//                            "Quantity"=> 1
//                        ],
//                        [
//                            "Code"=> "CHD",
//                            "Quantity"=> 0
//                        ],
//                        [
//                            "Code"=> "INF",
//                            "Quantity"=> 0
//                        ]
//                    ]
//                ]
//            ]
//        ];
//
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => "http://sepehrapitest.ir/api/OpenTravelAlliance/Air/AirLowFareSearchV6",
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 30,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => "POST",
//            CURLOPT_POSTFIELDS =>json_encode($json),
//
//            CURLOPT_HTTPHEADER => array(
//                "content-type: application/json",
//            ),
//        ));
//        $response = curl_exec($curl);
//        $err = curl_error($curl);
//        curl_close($curl);
//        $response=json_decode($response,true);
//
////        if ($response['PricedItineraries'] ==null){
////            return 'uhkj';
////        }
//
//        if ($response['Errors']!=null)
//            return $response['Errors'][0]['ShortText'];
//
//        else if ($response['Warnings']!=null)
//            return $response['Warnings'][0]['ShortText'];
//
//         else {
//             return $response;
//        }
//    });


});


Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    $this->get('login', 'LoginController@showLoginForm')->name('login');
    $this->post('login', 'LoginController@login');
    $this->get('logout', 'LoginController@logout')->name('logout');

    // Login And Register With Google
    $this->get('login/google', 'LoginController@redirectToProvider');
    $this->get('login/google/callback', 'LoginController@handleProviderCallback');
    // Registration Routes...
    $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});

Route::get('/home', function (){
    return 'hello';
});
