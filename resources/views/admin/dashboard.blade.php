@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") !!}
    {!! HTML::style("assets/global/plugins/select2/select2.css") !!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css") !!}
    <!-- BEGIN THEME STYLES -->

@stop
@section('mainarea')



    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        แดชบอร์ด
        <small>รายงาน และ สถิติ</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{route('admin.dashboard.index')}}">หน้าแรก</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">แดชบอร์ด</a>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->


    @php($updateVersionInfo = \Froiden\Envato\Functions\EnvatoUpdate::updateVersionInfo())
    @if(isset($updateVersionInfo['lastVersion']))
        <div class="note note-info row">
            <div class="col-md-10"><i class="fa fa-gift"></i> มีรายการอัพเดทใหม่ <label
                    class="label label-success">{{ $updateVersionInfo['lastVersion'] }}</label></div>
            <div class="col-md-2">
                <a href="{{route('admin.updateVersion.index')}}"
                   class="btn btn-success btn-small">อัพเดทตอนนี้
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>

    @endif


    {{--calender--}}
    <div class="row myfont-text">
        <div class="col-md-12">
            <div class="portlet box blue calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> รายการเช็คชื่อ
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="col-md-9 col-sm-12">
                            <div id="calendar" class="has-toolbar">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <p>
                            <h3><a href="#" class="btn btn-sm red"></a> มา</h3></p>
                            <p>
                            <h3><a href="#" class="btn btn-sm blue"></a> ขาด</h3></p>

                        </div>
                    </div>
                    <!-- END CALENDAR PORTLET-->
                </div>
            </div>
        </div>

    </div>


    <!-- BEGIN DASHBOARD STATS -->
    <div class="row myfont-text">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        รายการเบิก
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="expenseChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>

        </div>


        <!-- END DASHBOARD STATS -->
    @endsection

    @section('footerjs')


        <!-- BEGIN PAGE LEVEL PLUGINS -->
            {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
            {!! HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js") !!}
            {!! HTML::script("assets/global/plugins/select2/select2.min.js") !!}

            {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}
            {!! HTML::script("assets/admin/pages/scripts/components-dropdowns.js") !!}


            {!! HTML::script('assets/admin/pages/scripts/ui-blockui.js') !!}
            {!! HTML::script("assets/global/plugins/moment.min.js") !!}
            {!! HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js") !!}
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>



            <script>
                jQuery(document).ready(function () {
                    Calendar.init();
                    UIBlockUI.init();
                    ComponentsDropdowns.init();
                });

                var Calendar = function () {

                    return {
                        //main function to initiate the module
                        init: function () {
                            Calendar.initCalendar();
                        },

                        initCalendar: function () {

                            if (!jQuery().fullCalendar) {
                                return;
                            }

                            var date = new Date();
                            var d = date.getDate();
                            var m = date.getMonth();
                            var y = date.getFullYear();

                            var h = {};


                            if ($('#calendar').parents(".portlet").width() <= 720) {
                                $('#calendar').addClass("mobile");
                                h = {
                                    left: 'title, prev, next',
                                    center: '',
                                    right: 'today,month'
                                };
                            } else {
                                $('#calendar').removeClass("mobile");
                                h = {
                                    left: 'title',
                                    center: '',
                                    right: 'prev,next,today'
                                };
                            }

                            $('#calendar').fullCalendar('destroy'); // destroy the calendar
                            $('#calendar').fullCalendar({ //re-initialize the calendar
                                header: h,
                                defaultView: 'month',
                                eventRender: function (event, element) {
                                    if (event.className == "holiday") {
                                        var dataToFind = moment(event.start).format('YYYY-MM-DD');
                                        $('.fc-day[data-date="' + dataToFind + '"]').css('background', 'rgba(255, 224, 205, 1)');
                                    }
                                },
                                events: [
                                        {{--Holidays on Calendar--}}
                                        @foreach($holidays as $holiday)
                                    {
                                        className: "holiday",
                                        title: "{{$holiday->occassion}}",
                                        start: '{{$holiday->date}}',

                                        color: 'grey'

                                    },

                                        @endforeach
                                        {{-- Attandance on calendar --}}
                                        @foreach($attendance as $index=>$attend)

                                        @if($attend[0]!='all present')
                                            @foreach($attend as $em)
                                            {
                                                title: "ชื่อ: {{\Illuminate\Support\Str::words($em['fullName'],1,'')}}\n ประเภท: {{ $em['type'] }}",
                                                start: '{{$index}}',
                                                color: '#e50000'

                                            },
                                            @endforeach
                                            @else
                                            {
                                                title: 'มาครบ',
                                                start: '{{$index}}'

                                            },
                                        @endif

                                    @endforeach

                                ]
                            });
                        }
                    };
                }();

                $(function () {

                    $('#expenseChart').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'สรุปการเบิกงบ ประจำปี ' + new Date().getFullYear()
                        },
                        xAxis: {
                            categories: [
                                'ม.ค.',
                                'ก.พ.',
                                'มี.ค.',
                                'เม.ย.',
                                'พ.ค.',
                                'มิ.ย.',
                                'ก.ค.',
                                'ส.ค.',
                                'ก.ย.',
                                'ต.ค.',
                                'พ.ย.',
                                'ธ.ค.'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                useHTML: true,
                                text: 'จำนวนเงินที่เบิก (บาท)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f} <span class="fa {!! $setting->currency_icon !!}"></span></b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'การเบิกงบ',
                            data: [{!!$expense!!}]

                        }]
                    });
                });
            </script>

            <!-- END PAGE LEVEL PLUGINS -->
@endsection
