@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") !!}
    {!! HTML::style("assets/global/plugins/select2/select2.css") !!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css") !!}
    <!-- BEGIN THEME STYLES -->
<style>
    .dropdown-center {
    left: 50% !important;
    right: auto !important;
    text-align: center !important;
    transform: translate(-50%, 0) !important;
    }
</style>

@stop

@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    ประวัติการ เช็คชื่อ/ลา
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{route('admin.dashboard.index')}}">หน้าหลัก</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('admin.attendances.index') }}">การเช็คชื่อ</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('admin.attendances.index') }}">ประวัติการ เช็คชื่อ/ลา</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">{{$employee->fullName}}</a>

            </li>

        </ul>

    </div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

            {{--INLCUDE ERROR MESSAGE BOX--}}
            @include('admin.common.error')
            {{--END ERROR MESSAGE BOX--}}
            <div class="portlet box green-meadow calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list"></i>{{$employee->fullName}}
                    </div>
                </div>
                <div class="portlet-body text-center">
                    <div class="row ">

                        <div class="col-md-4 col-sm-4">
                            <h2>เลือก</h2>
                            <form role="form form-row-sepe">
                                <div class="form-body alert alert-block alert-info fade in">

                                    <div class="row ">

                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label>เลือกพนักงาน</label>
                                                <div class="input-group dropdown-center">

                                                    {!!  Form::select('employeeID', $employeeslist,$employee->employeeID,['class' => 'form-control input-large select2me','data-placeholder'=>'Select Employee...','onchange'=>'redirect_to()','id'=>'changeEmployee'])  !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">

                                        <!--/span-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>เดือน</label>

                                                <div class="input-group dropdown-center">

                                                    <select class="form-control input-large select2me monthSelect"
                                                            id="monthSelect" name="forMonth"
                                                            onclick="changeMonthYear();return false;">
                                                        <option value="01"
                                                                @if(strtolower(date('F'))=='january')selected='selected'@endif>
                                                            มกราคม
                                                        </option>
                                                        <option value="02"
                                                                @if(strtolower(date('F'))=='february')selected='selected'@endif>
                                                            กุมภาพันธ์
                                                        </option>
                                                        <option value="03"
                                                                @if(strtolower(date('F'))=='march')selected='selected'@endif>
                                                            มีนาคม
                                                        </option>
                                                        <option value="04"
                                                                @if(strtolower(date('F'))=='april')selected='selected'@endif>
                                                            เมษายน
                                                        </option>
                                                        <option value="05"
                                                                @if(strtolower(date('F'))=='may')selected='selected'@endif>
                                                            พฤษภาคม
                                                        </option>
                                                        <option value="06"
                                                                @if(strtolower(date('F'))=='june')selected='selected'@endif>
                                                            มิถุนายน
                                                        </option>
                                                        <option value="07"
                                                                @if(strtolower(date('F'))=='july')selected='selected'@endif>
                                                            กรกฎาคม
                                                        </option>
                                                        <option value="08"
                                                                @if(strtolower(date('F'))=='august')selected='selected'@endif>
                                                            สิงหาคม
                                                        </option>
                                                        <option value="09"
                                                                @if(strtolower(date('F'))=='september')selected='selected'@endif>
                                                            กันยายน
                                                        </option>
                                                        <option value="10"
                                                                @if(strtolower(date('F'))=='october')selected='selected'@endif>
                                                            ตุลาคม
                                                        </option>
                                                        <option value="11"
                                                                @if(strtolower(date('F'))=='november')selected='selected'@endif>
                                                            พฤศจิกายน
                                                        </option>
                                                        <option value="12"
                                                                @if(strtolower(date('F'))=='december')selected='selected'@endif>
                                                            ธันวาคม
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label>ปี</label>
                                                <div class="input-group dropdown-center">
                                                    <select class="form-control input-large select2me" id="yearSelect"
                                                            name="forMonth" onclick="changeMonthYear();return false;">
                                                        @for($i=2013;$i<=date('Y');$i++)
                                                            <option value="{{$i}}"
                                                                    @if(date('Y')==$i) selected='selected'@endif>{{$i}}</option>

                                                        @endfor

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!--/span-->

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="alert alert-danger text-center">
                                                <strong>การเช็คชื่อ (ครั้ง)</strong>
                                                <div id="attendanceReport"> NA</div>
                                            </div>
                                        </div>
                                        <!--/span-->

                                        <div class="col-md-6">
                                            <div class="alert alert-danger text-center">
                                                <strong>การเช็คชื่อ (ร้อยละ)</strong>
                                                <div id="attendancePerReport"> NA</div>
                                            </div>
                                        </div>
                                        <!--/span-->

                                    </div>
                                </div>

                            </form>


                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div id="calendar" class="has-toolbar text-center">
                            </div>
                        </div>
                    </div>
                    <!-- END CALENDAR PORTLET-->
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

@stop

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


    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        jQuery(document).ready(function () {

            Calendar.init();
            showReport();
            UIBlockUI.init();
            ComponentsDropdowns.init();

        });


        function changeMonthYear() {
            var month = $("#monthSelect").val();
            var year = $("#yearSelect").val();
            $('#calendar').fullCalendar('gotoDate', year + '-' + month + '-01');
            showReport();


        }

        function showReport() {

            Metronic.startPageLoading({animate: true});

            window.setTimeout(function () {
                Metronic.stopPageLoading();
            }, 1000);

            var month = $("#monthSelect").val();
            var year = $("#yearSelect").val();
            var employeeID = $("#changeEmployee").val();

            var url = "{{ route('admin.attendance.report',':id') }}";
            url = url.replace(':id', employeeID);
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'json',
                data: {"month": month, "year": year, "employeeID": employeeID}

            }).done(function (response) {

                if (response.success == "success") {

                    $('#attendanceReport').html(response.presentByWorking);
                    $('#attendancePerReport').html(response.attendancePerReport);

                }
            });
        }

        //Function to redirect to the employees page
        function redirect_to() {

            var employee = $('#changeEmployee').val();
            var url = "{{ route('admin.attendances.show',':id') }}";
            url = url.replace(':id', employee);
            window.location.href = url;
        }


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
                            right: 'prev,next,today,month'
                        };
                    }


                    $('#calendar').fullCalendar('destroy'); // destroy the calendar
                    $('#calendar').fullCalendar({ //re-initialize the calendar
                        header: h,
//                defaultDate: '2014-06-12',
                        defaultView: 'month',
                        slotMinutes: 15,

                        events: [

                            {{-- Attendance on calendar --}}

                            @foreach($attendance as $attend)
                                @if($attend->status === 'present')
                                {
                                    title: "{{$attend->status}}",
                                    start: '{{$attend->date}}',
                                    backgroundColor: Metronic.getBrandColor('yellow')
                                }
                                @else
                                {
                                    title: "{{$attend->status}}-{{$attend->leaveType}}",
                                    start: '{{$attend->date}}',
                                    backgroundColor: Metronic.getBrandColor('red')
                                }
                                @endif
                            ,
                            @endforeach


                            {{--Holidays on Calendar--}}
                            @foreach($holidays as $holiday)
                            {
                                title: "{{$holiday->occassion}}",
                                start: '{{$holiday->date}}',
                                backgroundColor: Metronic.getBrandColor('grey')
                            },
                            @endforeach
                        ]
                    });

                }

            };

        }();
    </script>
@stop
