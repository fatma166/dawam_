@extends('layout.mainlayout')

@section('title')
    {{__('trans.report-department')}}
@endsection
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ __('trans.Companies') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{__('trans.Department Report')}}</li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->



            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <th>#</th>
                                <th>{{ __('trans.Department') }}</th>
                                <th>{{ __('trans.total') }}</th>
                                <th>{{ __('trans.present') }}</th> 
                                <th>{{ __('trans.absent') }}</th> 
                                <th>{{ __('trans.late_comers') }}</th> 
                                <th>{{ __('trans.early leave') }}</th> 
                            </thead>
                            <tbody>
                          
                                @if (!empty( $dep_report))
                                    @foreach ($dep_report as $index=> $dep_rep)
                                   
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($dep_rep['dep_name'])) {{$dep_rep['dep_name'] }} @endif
                                                </h2>
                                            </td>

                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($dep_rep['total'])) {{ $dep_rep['total'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($dep_rep['present'])) {{ $dep_rep['present'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($dep_rep['absent'])) {{ $dep_rep['absent'] }} @endif
                                                </h2>
                                            </td>
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($dep_rep['late_comers'])) {{ $dep_rep['late_comers'] }} @endif
                                                </h2>
                                            </td>  
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($dep_rep['early_leave'])) {{ $dep_rep['early_leave'] }} @endif
                                                </h2>
                                            </td> 
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->



    </div>
@endsection
