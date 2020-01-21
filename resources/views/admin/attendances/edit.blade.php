@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") !!}
    {!! HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css") !!}
    
    <link href="https://fonts.googleapis.com/css?family=Kanit:500|Sarabun&display=swap&subset=thai" rel="stylesheet"> 
    <style>
        h1{
            font-family: 'Kanit', sans-serif !important;
        }
        h2{
            font-family: 'Kanit', sans-serif !important;
        }
        h3{
            font-family: 'Kanit', sans-serif !important;
        }
        .myfont-head{
            font-family: 'Kanit', sans-serif !important;
        }
        .myfont-text{
            font-family: 'Sarabun', sans-serif !important;
        }
    </style>

    <!-- BEGIN THEME STYLES -->
    
@stop


@section('mainarea')

	<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			แก้ไขการเช็คชื่อ
			</h3>
			<div class="page-bar myfont-text">
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
						<a href="">แก้ไขการเช็คชื่อ</a>
					</li>
				</ul>

			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row myfont-text">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->

                {{--INLCUDE ERROR MESSAGE BOX--}}
                @include('admin.common.error')
                {{--END ERROR MESSAGE BOX--}}

                   <div class="row">
                               <div class="col-md-2 form-group">
                               {!! Form::open(['route'=>["admin.attendances.create"],'class'=>'form-horizontal','method'=>'GET']) !!}

                                      <div class="input-group input-medium date date-picker"   data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                           <input type="text" class="form-control" name="date" readonly placeholder="เลือกวันที่">
                                           <span class="input-group-btn">
                                           <button class="btn blue" type="submit"><i class="fa fa-calendar"></i> แก้ไข</button>
                                           </span>
                                      </div>

                               {!! Form::close() !!}

                                     </div>

                               <div class="col-md-6 form-group">

                                @if($date!=date('Y-m-d'))
                                     <a href="{{route('admin.attendances.create')}}" class="btn green">
                                        เช็คชื่อของวันนี้ <i class="fa fa-plus"></i>
                                     </a>

                                @endif


                                </div>
                                 <div class="col-md-4 form-group text-right">

								<span id="load_notification" class="myfont-text"></span>
 									 <input  type="checkbox"   onchange="ToggleEmailNotification('attendance_notification');return false;" class="make-switch" name="attendance_notification" @if($setting->attendance_notification==1)checked	@endif data-on-color="success" data-on-text="เปิด" data-off-text="ปิด" data-off-color="danger">
									 แจ้งเตือนทางอีเมล<br>
								</div>



                   </div>

                <hr>
					<div class="portlet box blue">
						<div class="portlet-title myfont-text">
							<div class="caption">
								<i class="fa fa-edit"></i>
								@if(isset($todays_holidays->date))
                                        วันนี้เป็นวันหยุด , {{thaidate('วันl ที่ j F พ.ศ.Y',strtotime($todays_holidays->date))}}
                                 @else
                                        เช็คชื่อ
                                @endif
							</div>
							<div class="tools">
							</div>
						</div>

						<div class="portlet-body form">

						@if(isset($todays_holidays->date))
							   <div class="note note-info">
											<h4 class="block myfont-text">{{thaidate('วันที่ j',strtotime($todays_holidays->date))}} เป็นวันหยุดเนื่องจาก <strong>{{ $todays_holidays->occassion }}</strong></h4>
							   </div>
                   		 @elseif(count($employees)==0)
                   		 <hr>
						<div class="note note-warning">
										<h4 class="block">ไม่มีพนักงาน</h4>
										<p>
											กรุณา<a href="{{route('admin.employees.create')}}">เพิ่มพนักงาน</a>ในฐานข้อมูลก่อน
										</p>
						   </div>
						   <hr>
							@else
						<!-- BEGIN FORM-->
						{!! Form::open(['route'=>["admin.attendances.update",$date],'class'=>'form-horizontal','method'=>'PATCH']) !!}


                                    <div class="form-body">
                                        
                                        <h3 class="form-section">{{thaidate('วันl ที่ j F พ.ศ.Y',strtotime($date))}}</h3>

                                        <div class="form-group">

                                           <label class="col-md-1 control-group">รหัสพนักงาน</label>
                                           <label class="col-md-2 control-group">ชื่อพนักงาน</label>
                                           <label class="col-md-2 control-group">สถานะ</label>
                                           <label class="col-md-2 control-group leaveType" id="leaveTypeLabel">ประเภทการลา</label>
                                           <label class="col-md-2 control-group"><span class="halfLeaveType" id="halfDayLabel">ลาครึ่งวัน</span> </label>

                                           <label class="col-md-3 control-group reason" id="reasonLabel">เนื่องจาก</label>

                                        </div>

                                        @foreach($employees as $employee)
                                            <div class="form-group">
                                                <label class="col-md-1 control-group">{{$employee->employeeID}} </label>
                                                <label class="col-md-2 control-group">{{$employee->fullName}} </label>
                                                <div class="col-md-2">
                                                    <input type="checkbox"  id="checkbox{{$employee->employeeID}}" onchange="showHide('{{$employee->employeeID}}');return false;" class="make-switch" name="checkbox[{{$employee->employeeID}}]" checked data-on-color="success" data-on-text="มา" data-off-text="ขาด" data-off-color="danger">
                                                    <input type="hidden"  name="employees[]" value="{{$employee->employeeID}}">
                                                </div>
                                                <div class="col-md-2">
                                                @if(isset($attendanceArray[$employee->employeeID]['leaveType']))
                                                     {!!  Form::select('leaveType['.$employee->employeeID.']', $leaveTypes,$attendanceArray[$employee->employeeID]['leaveType'],['class' => 'form-control leaveType','onchange'=>'halfDayToggle('.$employee->employeeID.',this.value)','id'=>'leaveType'.$employee->employeeID.''] )  !!}
                                                @else
                                                     {!!  Form::select('leaveType['.$employee->employeeID.']', $leaveTypes,null,['class' => 'form-control leaveType','onchange'=>'halfDayToggle('.$employee->employeeID.',this.value)','id'=>'leaveType'.$employee->employeeID.''] )  !!}
                                                @endif
                                                </div>
                                                <div class="col-md-2">
													@if(isset($attendanceArray[$employee->employeeID]['leaveType']))
														 {!!  Form::select('leaveTypeWithoutHalfDay['.$employee->employeeID.']', $leaveTypeWithoutHalfDay,$attendanceArray[$employee->employeeID]['halfDayType'],['class' => 'form-control halfLeaveType','id'=>'halfLeaveType'.$employee->employeeID.''] )  !!}
													@else
														 {!!  Form::select('leaveTypeWithoutHalfDay['.$employee->employeeID.']', $leaveTypeWithoutHalfDay,null,['class' => 'form-control halfLeaveType','id'=>'halfLeaveType'.$employee->employeeID.''] )  !!}
													@endif
													</div>
                                                 <div class="col-md-3">
                                                        <input type="text" class="form-control reason" id="reason{{$employee->employeeID}}" name="reason[{{$employee->employeeID}}]" placeholder="เหตุผลที่ขาด" value="{{ $attendanceArray[$employee->employeeID]['reason'] ?? ''}}">
                                                 </div>
                                            </div>
                                         @endforeach

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit"   class="btn green"><i class="fa fa-edit"></i> บันทึก</button>

                                                </div>
                                            </div>
                                        </div>
                    						{!!  Form::close()  !!}

                    			@endif
                        							<!-- END FORM-->

						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->

				</div>
			</div>
			<!-- END PAGE CONTENT-->



@stop

@section('footerjs')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
        {!! HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
        {!! HTML::script("assets/admin/pages/scripts/components-pickers.js") !!}

        <!-- END PAGE LEVEL PLUGINS -->

<script>
	jQuery(document).ready(function() {
        ComponentsPickers.init();

	});
</script>

<script>
 $('.leaveType').hide();
        $('.reason').hide();
        $('.halfLeaveType').hide();



       @foreach($attendanceArray as $attend)
       {
        @if($attend['status']=='absent')
            $('#leaveTypeLabel').show(100);
            $('#reasonLabel').show(100);

            @if($attend['leaveType']=='half day')
             		$("#halfLeaveType{{$attend['employeeID']}}").show();
			@endif
				@if($attend['halfDayType']	!=null)
					$('#halfDayLabel').show(100);
				@endif

            $("#checkbox{{$attend['employeeID']}}").bootstrapSwitch('state',false);

        @else
             $("#reason{{$attend['employeeID']}}").hide();
             $("#leaveType{{$attend['employeeID']}}").hide();
             $("#halfLeaveType{{$attend['employeeID']}}").hide();
        @endif

       }
       @endforeach
     function showHide(id){
                $('#leaveTypeLabel').show(100);
                $('#reasonLabel').show(100);


            if($('#checkbox'+id+':checked').val() == 'on') {
                    $('#leaveType'+id).hide(1000);
                    $('#reason'+id).hide(1000);

                 } else {
                     $('#leaveType'+id).show(100);

                     $('#reason'+id).show(500);
                 }
     }

     function halfDayToggle(id,value){

		if(value	==	'half day')
		{
			$('#halfDayLabel').show(100);
			$('#halfLeaveType'+id).show(100);
		}else{
			$('#halfLeaveType'+id).hide(100);
		}


     }
 </script>
@stop