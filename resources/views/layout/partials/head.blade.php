<!DOCTYPE html>

<html lang="{{app()->getLocale()}}">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <meta name="description" content="Dawam">

		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">

        <meta name="author" content="Dreamguys - Bootstrap Admin Template">

        <meta name="robots" content="noindex, nofollow">

        <title>@yield('title')</title>

		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<!-- Favicon -->

        <link rel="shortcut icon" type="image/x-icon" href="{{url('img/favicon.png')}}">

		

		<!-- Bootstrap CSS -->

        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

		

		<!-- Fontawesome CSS -->

       <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"> 

		  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;900&display=swap">

		<!-- Lineawesome CSS -->

        <link rel="stylesheet" href="{{asset('css/line-awesome.min.css')}}">

		

        	<!-- Select2 CSS -->

		<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

		

		<!-- Datetimepicker CSS -->

		<link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">

		    

		<!-- Calendar CSS -->

		<link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}">



        <!-- Tagsinput CSS -->

		<link rel="stylesheet" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">



		<!-- Datatable CSS 

		<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json">
        -->
        

		<!-- Chart CSS -->

		<link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">



		<!-- Summernote CSS -->

		<link rel="stylesheet" href="{{asset('plugins/summernote/dist/summernote-bs4.css')}}">

		
   
		<!-- Main CSS -->

        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <link rel="stylesheet" href="{{asset('css/added.css')}}">

     	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

		

      <!--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

		<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet"/>-->
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
       
      


    </head>

