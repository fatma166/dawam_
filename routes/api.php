<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
date_default_timezone_set('Africa/Cairo');


Route::group(['middleware' => 'authapi'], function ($router) {

    /*accounts*/
    route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/signin', "UserController@login")->withoutMiddleware(['authapi']);
        Route::post('{token}/password/reset', "UserController@ResetPassword")->withoutMiddleware(['authapi']);
        Route::post('activationCode/send', "UserController@resendActivationCode")->withoutMiddleware(['authapi']);
        Route::post('{token}/mopile/verify', "UserController@verifyMopile");
        Route::post('{token}/email/verify', "UserController@verifyEmail");
        Route::get('/user', "UserController@user");
        Route::get('/user/shift', "UserController@getUserShift");
        Route::get('/user/attend/status', "UserController@CheckUserAttendStatus");
        Route::post('/token-refresh', "UserController@refresh")->withoutMiddleware(['authapi']);
        Route::post('/profile/update', "UserController@updateProfile");
        Route::post('/signout', "UserController@signout");
        //new 22/11
        Route::get('/user/data', "UserController@UserData");
        Route::get('/user/getUserDetail','UserController@getUserDetail')->name('getUserDetail');
        Route::get('/user/profile', "UserController@profile");
        Route::post('/user/reset_password', "UserController@change_password");
        Route::get('/user/statistics', "UserController@statistics");
    });



    /**
     *employees
     */
    // route::group(['middleware' => 'role:employee'], function ($router) {

/**
 * attendence
 */
    Route::group(['prefix' => 'attendence'], function ($router) {
        Route::get('/{limit?}', "users\AttendenceController@Index");
        Route::POST('/register', "users\AttendenceController@Register");
        //new 22/11
        Route::POST('/register/store', "users\AttendenceController@Store");
        Route::get('/registered/count', "users\AttendenceController@Count");

    });

    /**
     * users
     */

    Route::group(['prefix' => 'shifts'], function ($router) {
        Route::get('/', "users\ShiftController@Index");


    });

/**
 * leaverequests
 */
    Route::group(['prefix' => 'leaverequests'], function ($router) {
        Route::POST('/request', "users\LeaveRequestController@Request");
        Route::get('/types', "users\LeaveRequestController@ViewTypes");
        Route::get('/', "users\LeaveRequestController@Index");
        Route::get('/{id?}', "users\LeaveRequestController@Index");


    });

    /**
     * outdoors
     */

    Route::group(['prefix' => 'outdoors'], function ($router) {
        Route::get('/{id?}', "users\OutdoorController@Index");
        Route::get('/registered/count', "users\OutdoorController@Count");
        Route::get('/registered/history', "users\OutdoorController@History");
        Route::post('/create', "users\OutdoorController@Create");
         Route::post('/create_v1', "users\OutdoorController@create_v1");
        Route::post('/{id}/template/register', "users\OutdoorController@RegisterTemplate");
        Route::post('/{id}/register', "users\OutdoorController@Register");
        //new 22/11
        Route::post('/{id}/register/store', "users\OutdoorController@Store");

    });

    /**
     *outdoorsQuestions
     */
    Route::group(['prefix' => 'outdoors/types'], function ($router) {
        Route::get('/{id?}', "users\OutdoorTypesController@Index");
        Route::get('{id}/questions', "users\OutdoorQuestionController@Index");

    });

     //new 22/11

     /**
     *All outdoorsQuestions
     */
    Route::group(['prefix' => 'outdoors/questions'], function ($router) {
        Route::get('view/{id?}', "users\OutdoorQuestionController@questions");
       

    });


     /**
     *clients
     */
    Route::group(['prefix' => 'clients'], function ($router) {
        Route::get('/{id?}', "users\ClientController@Index");
        Route::post('/create', "users\ClientController@Create");
        Route::post('/create_v1', "users\ClientController@create_v1");
        Route::post('/{id}/edit', "users\ClientController@Edit");

    });


   /**
     *clientsTypes
     */
    Route::group(['prefix' => 'clients/types'], function ($router) {
        Route::get('/view/{id?}', "users\ClientTypeController@Index");

    });


    /**
     * tasks
     */
    Route::group(['prefix' => 'tasks'], function ($router) {
        Route::get('/{id?}', "users\TaskController@Index");
        Route::post('/{id}/state/register', "users\TaskController@Register");

    });


      /**
     * user Notification
     */
    Route::group(['prefix' => 'notifications'], function ($router) {
        Route::get('/{id?}', "users\NotificationController@Index");
        Route::post('/{id}/change/state', "users\NotificationController@ChangeState");

    });

 /**
     * user logs
     */
    Route::group(['prefix' => 'logs'], function ($router) {
        Route::get('/{id?}', "users\LogsController@Index");
        Route::post('/store', "users\LogsController@store");

    });
    
            /**
     * user process
     */
    Route::group(['prefix' => 'process'], function ($router) {
        Route::get('/{id?}', "users\ProcessController@index");
        Route::post('/store', "users\ProcessController@store");

    });
     /**
     * Track user
     */
    Route::group(['prefix' => 'track_user'], function ($router) {
        Route::get('/{id?}', "users\TrackUserController@index");
        Route::post('/store', "users\TrackUserController@store");

    });
    // });
    Route::group(['prefix' => 'specializations'], function ($router) {
        Route::get('/', "users\SpecializationsController@index");
        //Route::post('/store', "users\TrackUserController@store");

    });
});

Route::get('auth/errors', function () {


    $data['msg'] = 'un authenticated';
    return response($data, 401);
})->name("unauth");

use App\Models\Company;
use App\Models\attendence_report;
use App\Models\attendance_attachment;

Route::get('test', function () {
    //use  Nexmo\Laravel\Facade\Nexmo;



    // Nexmo::message()->send([
    //     'to'   => '01121602253',
    //     'from' => '01205552344',
    //     'text' => 'Using the facade to send a message.'
    // ]);
///test ftp sync


    $current_time=date_create();
        $current_hour=$current_time->format("H:i");
        $today=$current_time->format("Y-m-d");

        $companies=Company::Where("logout_time","LIKE","%".$current_hour."%")->get();

        foreach($companies as $company){

            $attendances=$company->attendances()->whereDate('created_at',"!=", $today)->whereNull("time_out")->whereNotNull("time_in")->get();
            foreach($attendances as $attend){

               
                $attend->time_out=$current_time->format("H:i:s");
                $attend->status = "Attendance_discount";
                $attend->description = $attend->description.",auto_out";
                $attend->save();
                //new
                $attendence_attachement_all=$attend->attendence_attachments;
                $attendence_attachement_in=$attendence_attachement_all[0];
                $attendence_attachement = new attendance_attachment();

                $attendence_attachement->lati = $attendence_attachement_in->lati;
                $attendence_attachement->longi = $attendence_attachement_in->longi;
                $attendence_attachement->address = $attendence_attachement_in->address;
                $attendence_attachement->type = "out";
                $attendence_attachement->avatar = $attendence_attachement_in->avatar;
                $attendence_attachement->attendance_id = $attend->id;
                $attendence_attachement->is_fake =0;
                $attendence_attachement->save();


                $TimeDiff = date_diff(date_create($attend->time_out), date_create($attend->time_in));

                $attendence_report = attendence_report::where("attendance_id",$attend->id)->first();
                $attendence_report->worktime = $TimeDiff->format("%H:%I");
                $attendence_report->save();
            }
        }
    return response($data['msg']="code is send", 200);


});
