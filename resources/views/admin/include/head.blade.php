<meta charset="utf-8"/>
<title>{{$setting->website}} - {{ $pageTitle }}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>


<!-- BEGIN GLOBAL MANDATORY STYLES -->
{!! HTML::style("https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all")!!}
{!! HTML::style("assets/global/plugins/font-awesome/css/font-awesome.min.css") !!}
{!! HTML::style("assets/global/plugins/simple-line-icons/simple-line-icons.min.css") !!}
{!! HTML::style("assets/global/plugins/bootstrap/css/bootstrap.min.css") !!}
{!! HTML::style("assets/global/plugins/uniform/css/uniform.default.css") !!}
{!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") !!}

@yield('head')

{!! HTML::style("assets/global/css/components.css") !!}
{!! HTML::style("assets/global/css/plugins.css") !!}
{!! HTML::style("assets/admin/layout/css/layout.css") !!}
{!! HTML::style("assets/admin/layout/css/themes/darkblue.css") !!}
{!! HTML::style("assets/admin/layout/css/custom.css") !!}
{!! HTML::style('assets/global/plugins/froiden-helper/helper.css')  !!}


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


