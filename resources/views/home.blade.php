@extends('layouts.app')

@section('content')
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="{{ route('home')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				<div class="row">
					<div class="col-xl-12">
						<!-- Search field -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">Dashboard Charts & Graphs</h6>
								
							</div>

							<div class="card-body py-0">
								<div class="row">
									<div class="col-lg-6">
										<table class="table table-hover table-striped" id="example">
											<thead>
												<tr>
													<th>Expenses Category</th>
													<th>Total</th>
												
												</tr>
											</thead>
											<tbody>
												@foreach ($expensesArray as $expense)
													<tr>
														<td>{{ $expense['category'] }}</td>
														<td>{{ $expense['total'] }}</td>
													</tr>
												@endforeach
											</tbody>
											<tfoot>
												<tr>
													<th>Expenses Category</th>
													<th>Total</th>
												
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="text-center mb-3 py-2">
											@if($pieCategoriesExpenses)
												{!! $pieCategoriesExpenses->container() !!}
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
        @push('scripts')
        <!-- Javascript -->
        <!-- Vendors -->
      
        <script src="{{ asset('vendors/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js') }}"></script>
        @endpush('scripts')
@endsection

@section('js')        
	{{-- ChartScript --}}
	@if($pieCategoriesExpenses)
		{!! $pieCategoriesExpenses->script() !!}
	@endif
@endsection
