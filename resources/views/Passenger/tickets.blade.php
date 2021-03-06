<?php
require_once __DIR__ . '/../../../app/Http/Function/funnction.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>پنل مدیریت</title>

    <link rel="stylesheet" href="/assets/css/fontiran.css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" />


    <link href="/assets/css/bootstrap-rtl.min.css" rel="stylesheet" />
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/assets/css/custom.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/assets/css/persianDatepicker-default.css" />


    <link rel="stylesheet" href="/assets/css/bootstrapValidator.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.jqprint-0.3.js"></script>

    {{--<script src="/assets/js/bootstrap.min.js"></script>--}}

    {{--js for toggleButton--}}
    <script src="/assets/js/jquery.metisMenu.js"></script>
    <script src="/assets/js/custom.js"></script>

    <script type='text/javascript'>
        function Print() {
               $('#printable').jqprint();
        }
    </script>

</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('adminPanel')}}">پنل مدیریت</a>
        </div>
        <div class="navbar-header-logout">
            {{toPersianNum(jdate()->format('%d %B، %Y'))}}
            <a href="/logout" class="btn btn-danger">خروج</a>
        </div>
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li class="text-center">
                    @if(auth()->user()->image)
                        <img src="/assets/img/{{auth()->user()->image}}" class="user-image img-responsive"/>
                    @else
                        <img src="/assets/img/find_user.png" class="user-image img-responsive"/>
                    @endif
                </li>
                <li>
                    <a   href="{{route('adminPanel')}}" ><i class="fa fa-dashboard fa-3x"></i> میزکار</a>
                </li>
                <li>
                    <a   href="{{route('getFlight')}}" ><i class="fa fa-plane fa-3x"></i> بلیت هواپیما</a>
                </li>
                <li>
                    <a   href="{{route('getPassenger')}}" ><i class="fa fa-user fa-3x"></i> لیست مسافران</a>
                </li>
                <li>
                    <a   href="{{route('editProfileInfo')}}" ><i class="fa fa-edit fa-3x"></i> تغییر اطلاعات پروفایل</a>
                </li>


            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12" id="printable">
                    <div class="row">
                        <div class="col-sm-12" >

                            <h4 style="color: red">مسیر پروازی {{CodeToCity($tickets[0]->flight->DepartureAirport)}} به
                                {{CodeToCity($tickets[0]->flight->ArrivalAirport)}}:</h4>
                            {{--ticket info--}}
                            <div class="passengerContent">
                                <div class="passengerHeader">
                                    <h4 class="h4Passenger">
                                        اطلاعات بلیت
                                    </h4>
                                </div>

                                <div class="passengerBody">
                                    <div class="row passengerInfo " style="padding: 10px">
                                        <div class="col-sm-4">
                                            <span>زمان رزرو بلیت:</span>
                                            <b>{{toPersianNum(jdate($tickets[0]->dateBook)->format('H:i، %d %B %Y '))}}</b>
                                        </div>
                                        <div class="col-sm-3">
                                            <span>شماره مرجع:</span>
                                            {{$tickets[0]->BookingReference}}
                                        </div>
                                        {{--<div class="col-sm-2">--}}
                                            {{--<span>تعداد بلیت ها:</span>--}}
                                            {{--<b>{{toPersianNum($tickets[0]->flight->passengerNumber)}}</b>  عدد--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-3">--}}
                                            {{--<span>قیمت کل بلیت ها:</span>--}}
                                            {{--<b>{{toPersianNum($tickets[0]->flight->price)}}</b> تومان--}}
                                        {{--</div>--}}
                                    </div>

                                </div>
                            </div>

                            {{--Flight Info--}}
                            <div class="passengerContent">
                                <div class="passengerHeader">
                                    <h4 class="h4Passenger">
                                        اطلاعات پرواز
                                    </h4>
                                </div>
                                <div class="row panelContent" >
                                    <div class="col-md-4">
                                        <ul>
                                            <li>زمان حرکت: <b>{{toPersianNum(jdate($tickets[0]->flight->DepartureDateTime)->format('H:i، %d %B %Y '))}}</b></li>
                                            <li>زمان رسیدن: <b>{{toPersianNum(jdate($tickets[0]->flight->ArrivalDateTime)->format('H:i، %d %B %Y '))}}</b></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 20px">
                                        <span class="text-muted" >هواپیمایی
                                            {{\App\Http\Controllers\AdminController::getMarketingAirlineFA($tickets[0]->flight->MarketingAirline)}}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <ul>
                                            <li>هواپیما: <b>{{$tickets[0]->flight->AirEquipType}} </b></li>
                                            <li>شماره پرواز: <b>{{toPersianNum($tickets[0]->flight->FlightNumber)}}</b></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <ul>
                                            <li>پرواز  <b>چارتر </b></li>
                                            <li>کلاس پروازی: <b>{{\App\Http\Controllers\AdminController::getCabinTypeFA($tickets[0]->flight->cabinType)}}</b></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            {{--customer info--}}
                            <div class="passengerContent" id="ADT">
                                <div class="passengerHeader">
                                    <h4 class="h4Passenger">
                                        اطلاعات خریدار
                                    </h4>
                                </div>

                                <div class="passengerBody">
                                    <div class="row passengerInfo " style="padding: 10px">
                                        <div class="col-sm-4">
                                            <span>نام:</span>
                                            {{$tickets[0]->customer_name}}
                                        </div>
                                        <div class="col-sm-4">
                                            <span>ایمیل:</span>
                                            {{$tickets[0]->customer_email}}
                                        </div>
                                        <div class="col-sm-4">
                                            <span>شماره موبایل:</span>
                                            {{$tickets[0]->customer_tel}}
                                        </div>
                                    </div>

                                </div>
                            </div>


                            {{--Passenger info--}}
                            <div class="passengerContent" style="margin-top: 30px">
                                <div class="passengerHeader">
                                    <h4 class="h4Passenger">
                                        اطلاعات مسافر
                                    </h4>
                                </div>
                                <div class="passengerBody" >
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr class="small">
                                                <th>نوع</th>
                                                <th>جنسیت</th>
                                                <th>نام و نام خانوادگی</th>
                                                <th>کد ملی</th>
                                                <th>تاریخ تولد</th>
                                                <th>قیمت بلیت</th>
                                                <th>شماره بلیت</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        @if($tickets[0]->passenger->type=='ADT')
                                                            بزرگسال
                                                        @elseif($tickets[0]->passenger->type=='CHD')
                                                            کودک
                                                        @else
                                                            نوزاد
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($tickets[0]->passenger->gender==0)
                                                            <b>خانم</b>
                                                        @else
                                                            <b>آقا</b>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$tickets[0]->passenger->fname.' '. $tickets[0]->passenger->lname }}
                                                    </td>
                                                    <td class="nowrap">
                                                        <strong>
                                                            {{toPersianNum($tickets[0]->passenger->doc_id)}}
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        {{toPersianNum($tickets[0]->passenger->birthday)}}
                                                    </td>
                                                    <td>
                                                        {{toPersianNum($tickets[0]->passenger->price)}}
                                                    </td>
                                                    <td>
                                                        {{toPersianNum($tickets[0]->ticketNumber)}}
                                                    </td>
                                                </tr>

                                            {{--@endforeach--}}


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top: 50px">
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>

                            <div class="col-sm-6 passengerBtn">
                                    <a href="{{route('getPassenger')}}" style="text-decoration:none;">
                                        <button class="btn btn-block btn-success  btnSubmit" >
                                        بازگشت
                                        </button>
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="row" style="text-align: center">
                            <div >
                                {!! $tickets->render() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="passengerBtn" >
                                    <button class="btn btn-block btn-primary" onclick="Print()" id="print" type="button">چاپ</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


</body>
</html>
