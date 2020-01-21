<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper myfont-text">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>


            {{---------------------------------------Dashboard-------------------------------}}
            <li class="start {{ $dashboardActive ?? ''}}">
                <a href="{{URL::to('admin')}}">
                    <i class="fa fa-home"></i>
                    <span class="title">แดชบอร์ด</span>
                    <span class="selected"></span>
                </a>
            </li>
            {{---------------------------------------/Dashboard-------------------------------}}


            {{---------------------------------------Employees-------------------------------}}
            <li class="{{ $employeesActive ?? ''}}">
                <a href="{{route('admin.employees.index')}}">
                    <i class="fa fa-users"></i>
                    <span class="title">พนักงาน</span>
                </a>
            </li>
            {{---------------------------------------/Employees-------------------------------}}


            {{---------------------------------------Department-------------------------------}}
            <li class="{{ $departmentActive ?? ''}}">
                <a href="{{route('admin.departments.index')}}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">สำนัก/ฝ่าย</span>
                </a>
            </li>
            {{---------------------------------------Settings-------------------------------}}

            {{---------------------------------------Awards-------------------------------}}
            <li class="{{ $awardsActive ?? ''}}">
                <a href="{{route('admin.awards.index')}}">
                    <i class="fa fa-trophy"></i>
                    <span class="title">รางวัล</span>
                </a>
            </li>
            {{---------------------------------------/Awards-------------------------------}}


            {{---------------------------------------Expense-------------------------------}}
            <li class="{{ $inventoryActive ?? ''}}">
                <a href="{{route('admin.expenses.index')}}">
                    <i class="fa fa-money"></i>
                    <span class="title">รายการเบิก</span>
                </a>
            </li>
            {{---------------------------------------/Expense-------------------------------}}


            {{---------------------------------------Holidays-------------------------------}}
            <li class="{{ $holidayActive ?? ''}}">
                <a href="{{route('admin.holidays.index')}}">
                    <i class="fa fa-send"></i>
                    <span class="title">ปฏิทินวันหยุด</span>
                </a>
            </li>
            {{---------------------------------------/Holiday-------------------------------}}


            {{---------------------------------------Attendance-------------------------------}}
            <li class="{{ $attendanceOpen ?? ''}}">
                <a href="javascript:;">
                    <i class="fa fa-user"></i>
                    <span class="title">การเช็คชื่อ</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $markAttendanceActive ?? ''}}">
                        <a href="{{route('admin.attendances.create')}}">
                            <i class="fa  fa-check"></i>
                            เช็คชื่อ</a>
                    </li>
                    <li class="{{ $viewAttendanceActive ?? ''}}">
                        <a href="{{route('admin.attendances.index')}}">
                            <i class="fa  fa-eye"></i>
                            ประวัติ</a>
                    </li>
                    <li class="{{ $leaveTypeActive ?? ''}}">
                        <a href="{{route('admin.leavetypes.index')}}">
                            <i class="fa fa-sitemap"></i>
                            ประเภทการลา</a>
                    </li>
                </ul>
            </li>

            {{---------------------------------------/Attendance-------------------------------}}

            {{---------------------------------------Leave Applications-------------------------------}}
            <li class="{{ $leaveApplicationActive ?? ''}}">
                <a href="{{route('admin.leave_applications.index')}}">
                    <i class="fa fa-rocket"></i>
                    <span class="title">การลา</span>
                </a>
            </li>

            {{---------------------------------------/Attendance-------------------------------}}


            {{---------------------------------------Notice Board-------------------------------}}
            <li class="{{ $noticeBoardActive ?? ''}}">
                <a href="{{route('admin.noticeboards.index')}}">
                    <i class="fa fa-clipboard"></i>
                    <span class="title">ประกาศ</span>
                </a>
            </li>

            {{---------------------------------------/Notice Board-------------------------------}}


            {{---------------------------------------Settings-------------------------------}}
            <li class="{{ $settingOpen ?? ''}}">
                <a href="javascript:;">
                    <i class="fa fa-cogs"></i>
                    <span class="title">ตั้งค่า</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $settingActive ?? ''}}">
                        <a href="{{route('admin.settings.edit','setting')}}">
                            <i class="fa  fa-cog"></i>
                            ทั่วไป</a>
                    </li>

                    <li class="{{ $profileSettingActive ?? ''}}">
                        <a href="{{route('admin.profile_settings.edit','setting')}}">
                            <i class="fa fa-user"></i>
                            ข้อมูลส่วนตัว</a>
                    </li>
                    <li class="{{ $notificationSettingActive ?? ''}}">
                        <a href="{{route('admin.notificationSettings.edit','setting')}}">
                            <i class="fa fa-bell"></i>
                            การแจ้งเตือน</a>
                    </li>

                    <li class="{{ $emailSettingActive ?? ''}}">
                        <a href="{{route('admin.email_settings.edit','setting')}}">
                            <i class="fa fa-bell"></i>
                            อีเมล</a>
                    </li>

                    <li class="{{ $updateSettingActive ?? ''}}">
                        <a href="{{route('admin.updateVersion.index')}}">
                            <i class="fa fa-language"></i>
                            อัพเดท</a>
                    </li>
                </ul>
            </li>

            {{---------------------------------------/Settings-------------------------------}}

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->