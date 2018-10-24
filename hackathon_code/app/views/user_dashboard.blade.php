@extends('master')

@section('title')
    Dashboard
@endsection

@section('content')



@if(!Input::get('page'))
<div class="row">
	<div class="col-sm-12">
		<h1>Dashboard</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h6 style="color: rgb(143, 143, 143);">Total Unresolved Issues</h6>
				<h3 style="margin-bottom: 0px;">77</h3>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h6 style="color: rgb(143, 143, 143);">Total Issues Raised</h6>
				<h3 style="margin-bottom: 0px;">200</h3>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h6 style="color: rgb(143, 143, 143);">Total Issues Resolved </h6>
				<h3 style="margin-bottom: 0px;">123</h3>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h6 style="color: rgb(143, 143, 143);"> Issues Raised Today </h6>
				<h3 style="margin-bottom: 0px;">5</h3>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
    <div class="row">
        <ul class="nav nav-tabs nav-justified">
            <li role="presentation" @if($status == 'review') class="active"@endif>
                <a href="/images/review"> Require Manual Review <span class="badge">100</span></a>
            </li>
            <li role="presentation" @if($status == 'processed') class="active"@endif>
                <a href="/images/processed">Processed Valid <span class="badge">80</span></a>
            </li>
            <li role="presentation" @if($status == 'resolved') class="active"@endif>
                <a href="/images/resolved"> Resolved <span class="badge">50</span></a>
            </li>
            <li role="presentation" @if($status == 'unresolved') class="active"@endif>
                <a href="/images/unresolved">Unresolved  <span class="badge">70</span></a>
            </li>
        </ul>
    </div>
</div>
@endif
<div class="tab-content">
    <div id="Tab1" class="tab-pane fade in active">
      
        <div class="row" id="listing">
           <div class="paginatedData">
                @include('list')
            </div>
        </div>
    </div>
 
</div>

<!-- Bootstrap Datepicker -->
<script src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="/assets/bootstrap-datepicker/css/datepicker.css">
<link rel="stylesheet" href="/assets/bootstrap-datepicker/css/datepicker3.css">


@stop

