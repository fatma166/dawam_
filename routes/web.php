<?php



use Illuminate\Support\Facades\Route;

use App\Http\Middleware\PermissionMiddleware;
use App\Http\Controllers\TestController;
/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/
Route::domain('{subdomain}.' . config('app.short_url'))->group(function () { 
  
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
     Route::middleware('langsub')->group(function(){
         Route::GET('visitTypeReport','VisitReportController@vistTypeReport')->name('visitTypeReport'); 
         Route::get('visitTypeReportPrint/{type}','VisitReportController@visitTypeReportPrint')->name('visitTypePrint');
        //for login & register 
        Route::get('change_lang','UserController@change_lang')->name('change_lang');
         Route::get('/test_moaz', 'CompanyController@test_moaz')->name('test_moaz');
        Route::get('show_success','UserController@show_success')->name('show_success');
        Route::get('login','UserController@showLogin')->name('login');

        Route::post('postLogin','UserController@postLogin')->name('postLogin');

        Route::get('register','UserController@register')->name('register');

        Route::post('register_store','UserController@userPostRegistration')->name('userRegister');

        Route::get('logout','UserController@logout')->name('logout');

        Route::post('forget', 'ForgotPasswordController@forgot')->name('password.forget');
        // Route::view('reset_password', 'auth.reset_password')->name('password.reset');
        Route::get('reset_password/{token}', 'ForgotPasswordController@getPassword');
        //Route::post('/reset-password', 'ResetPasswordController@updatePassword');
    
        Route::get('/form_email', 'ForgotPasswordController@form_email')->name('password.email');
     
        
        Route::post('password_reset','ForgotPasswordController@reset')->name('password.reset');       




              /* get user price with type pass*/
                Route::post('emailCheck','UserController@emailCheck')->name('users.check_email');
                Route::post('signupStoreImage','UserController@signupStoreImage')->name('images.signupStoreImage');
                Route::post('sign_up_subscribe_getPlan/{type}/{currency}','UserController@getPlan')->name('subscribe-getPlan');
                Route::post('subscribe_store_plan','CompanyController@subscribe_store_plan')->name('subscribe-store-plan');
                Route::get('company_subscribe','CompanyController@company_subscribe')->name('company-subscribe');
                Route::post('company_subscribe_change_status','CompanyController@company_subscribe_change_status')->name('company-subscribe-change_status');
                Route::get('company_subscribe_show/{id}','CompanyController@company_subscribe_show')->name('company_subscribe_show');
                Route::post('company_subscribe_upgrade/{id}','CompanyController@company_subscribe_upgrade')->name('company_subscribe_upgrade');
                /*payment*/
                Route::post('payment_register_getCheckOutId','UserController@getCheckOutId')->name('payment-register-getCheckOutId');
                Route::post('payment_register_checkout_status/{id}','UserController@checkout_status')->name('payment-register-checkout-status');
                Route::post('payment_getCheckOutId','PaymentGatewayController@getCheckOutId')->name('payment-getCheckOutId');
                Route::post('payment_checkout_status/{id}','PaymentGatewayController@checkout_status')->name('payment-checkout-status');
             
              
                Route::get('plan-edit/{id}','CompanyController@plan_edit')->name('edit-plan');

                Route::post('plan-update/{id}','CompanyController@plan_update')->name('update-plan');
                Route::post('repersenrive-blance-set/{id}','CompanyController@repersenrive_blance_set')->name('repersenrive-blance-set');
         // For admin middlewares
         Route::middleware('auth','cat')->group(function(){
               /* edit admin profile*/
               Route::get('employee/edit_admin','AdminUserController@index')->name('AdminUser'); 
               Route::get('attendance/employee_available/{type}','AvailableController@index')->name('employee_available'); 
               Route::get('client/generate-lat-long/{start}/{end}','ClientController@generateLatLong')->name('generateLatLong');
               /* test moaz*/
                  Route::get('test2_moaz', 'CompanyController@test2_moaz')->name('test2_moaz');
               Route::get('/test_moaz', 'CompanyController@test_moaz')->name('test_moaz');
              /* 
                Route::get('test1_moaz', 'CompanyController@test1_moaz')->name('test1_moaz');
                Route::get('test2_moaz', 'CompanyController@test2_moaz')->name('test2_moaz');
                Route::get('bank_moaz', 'CompanyController@bank_moaz')->name('bank_moaz');
                Route::get('methods_moaz', 'CompanyController@methods_moaz')->name('methods_moaz');
                Route::get('account1', 'CompanyController@account1')->name('account1');
                Route::get('account2', 'CompanyController@account2')->name('account2');
            */
                Route::post('get-notification','HomeController@get_notification')->name('get-notification');
                Route::post('upload-images','CompanyController@storeImage')->name('images.store');
                Route::post('company-img-delete','CompanyController@deleteImg')->name('company-img-delete');
               
                Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index'])->name('/'); 
        
                Route::get('/','HomeController@index')->name('/'); 
        
                Route::get('dashboard','HomeController@index')->name('dashboard.index');
                Route::get('line-chart','HomeController@line_chart')->name('line-chart');
                Route::get('client-line-chart','ClientController@client_line_chart')->name('client-line-chart');
                Route::get('line-chart','HomeController@line_chart')->name('line-chart');
                
                
                
                /*select 2 routes */
                Route::get('selectEmployeeSearch','HomeController@selectEmployeeSearch')->name('selectEmployeeSearch');
                Route::get('selectEmployeeSearchBranch','HomeController@selectEmployeeSearchBranch')->name('selectClientSearchBranch');
                Route::get('selectClientSearchBranch','HomeController@selectClientSearchBranch')->name('selectEmployeeSearchBranch');
                Route::get('selectCompanySearch','BaseController@selectCompanySearch')->name('selectCompanySearch');
                Route::get('selectClientSearch','ClientController@selectClientSearch')->name('selectClientSearch');
                Route::get('selectZoneSearch','CompanyController@selectZoneSearch')->name('selectZoneSearch');
                Route::get('report-dialy/{type}','ReportController@dialyReport')->name('report-dialy'); 
                       
               /*search*/

                Route::get('search_branch','CompanyController@search_branch')->name('search_branch'); 
        
                Route::post('usershift/user_shift_search','ShiftController@user_shift_search')->name('user_shift_search'); 
        
                Route::post('attendance/attendance_search','AttendanceController@attendance_search'); 
                Route::get('attendance/change_attend_status/{id}','AttendanceController@change_attend_status'); 
        
                Route::post('leave/leave_search','LeaveController@leave_search'); 
        
                Route::post('outdoor/outdoor_search','OutdoorController@outdoor_search'); 
        
                Route::post('visit_question/visit_question_search','VisitQuestionController@visit_question_search'); 
        
                Route::post('visit_report/visit_report_search','VisitReportController@visit_report_search'); 
                Route::get('userReport/{id}','ReportController@userReport')->name('userReport'); 
                
                Route::get('userReportPrint/{type}','ReportController@userReportPrint')->name('userReportPrint');
 
                
                
                
       
            Route::get('activities','HomeController@get_notification_all')->name('activities');
            Route::get('mac_check','HomeController@mac_check')->name('mac_check');
            Route::post('change_status_notification','HomeController@change_status_notification')->name('change_status_notification');
           
            Route::get('visit_report_details/{visit_id}/{user_id}','VisitReportController@visit_report_details')->name('visit_report_details');
            Route::get('outdoor-edit-client/{id}','OutdoorController@edit_client')->name('edit-outdoor-client');
           
            Route::post('outdoor-update-client/{id}','OutdoorController@update_client')->name('outdoor-update-client');
            Route::post('outdoor-update-rate/{id}','OutdoorController@update_rate')->name('outdoor-update-rate');
         
          /* abdelkawy Routes */
          
          
                      //specializations
            Route::get('specializations','SpecializationController@index')->name('specializations');
            Route::post('addspecializations','SpecializationController@store')->name('addspecializations');
            Route::get('editspecialization/{id}','SpecializationController@edit')->name('editspecialization');
            Route::post('updatespecialization/{id}','SpecializationController@update')->name('updatespecialization');
            Route::post('deletespecialization/{id}','SpecializationController@destroy')->name('deletespecialization');
            
            
            
            Route::get('elements-evaluation','EvaluationController@index')->name('evaluations');
            Route::get('evaluation_jobs','EvaluationController@evalutaionjob_index')->name('evaluation_jobs');
            
            
            Route::post('evaluation-store','EvaluationController@store')->name('store-Evaluation');
            Route::get('edit-evaluation/{id}','EvaluationController@edit')->name('edit-evaluation');
            Route::post('update-evaluation/{id}','EvaluationController@update')->name('update-evaluation');
            Route::post('delete-evaluation','EvaluationController@delete')->name('delete-evaluation');
                       
            Route::get('edit-evaluationjob/{id}','JobController@edit_evaluation')->name('edit_evaluation');
            Route::post('update-evaluationjob/{id}','EvaluationController@update_evaluationjob')->name('update_evaluationjob');
            Route::get('evaluation_employes','EvaluationController@evaluationemployes_index')->name('evaluation_employes');
            Route::post('sotre_empevaluations','EvaluationController@sotre_empevaluations')->name('sotre_empevaluations');
            Route::get('getemployejob_id/{id}','EvaluationController@getemployejob_id')->name('getemployejob_id');
            Route::post('store_employeevaluation','EvaluationController@store_employeevaluation')->name('store_employeevaluation');
            Route::post('update_empevaluation/{id}','EvaluationController@update_empevaluation')->name('update_empevaluation');
            Route::post('delete_empevaluation','EvaluationController@delete_empevaluation')->name('delete_empevaluation');
            Route::post('add_job','JobController@store')->name('store');
            Route::post('evaluation_search','EvaluationController@evaluation_search')->name('evaluation_search');
            Route::get('editevaluationjob/{id}','EvaluationController@edit_evaluation')->name('edit_evaluation');
            Route::get('Evaluation_Report','EvaluationController@evaluation_report')->name('evaluation_report');
            //Route::get('EvaluationPrint/{type}','ReportController@EvaluationPrint')->name('EvaluationPrint');
             Route::get('evaluationprint/{type}','ReportController@evaluationprint')->name('evaluationprint');
             Route::get('showelementevaluation','JobController@showelementevaluation')->name('showelementevaluation');
             Route::post('delete-evaluationjob','EvaluationController@delete_evalutionjob')->name('delete-evaluationjob');
            Route::get('evaluationemp-edit/{id}','EvaluationController@evaluationemp_edit')->name('evaluationemp-edit');
            Route::get("evaluation_search",'EvaluationController@evaluation_search')->name('evaluation_search');
         
            Route::get('get-totalEvaluation','EvaluationController@gettotalevaluation')->name('get-totalEvaluation');
            Route::post('sotre_job_evaluation','EvaluationController@storeevaluationjobs')->name('sotre_job_evaluation');
            
            //charts
            Route::get('showevaluation_employes','EvaluationController@showevaluation_employes')->name('showevaluation_employes');
            Route::get('showemplopyechart','EvaluationController@showemploye_chart')->name('showemplopyechart');
           
            Route::get('job_chart','EvaluationController@jobchart')->name('job_chart');
            Route::get('showjobcharts','EvaluationController@showjobcharts')->name('showjobcharts');
           
            Route::get('showdeparteval','EvaluationController@showdeparteval')->name('showdeparteval');
            Route::get('showdepartmentscharts','EvaluationController@showdepartmentscharts')->name('showdepartmentscharts');

            Route::get('showbrancheval','EvaluationController@showbrancheval')->name('showbrancheval');
            Route::get('showbranchcharts','EvaluationController@showbranchcharts')->name('showbranchcharts');
             //charts
            /* end abd alkawy routes*/
            
            
            Route::get('employee-profile/{id}','EmployeeController@profile')->name('profile-employee');  
            Route::get('bar-chart','EmployeeController@bar_chart')->name('bar-chart');
        });
        Route::middleware(['auth','permission'])->group(function() {

        


         /*track*/
          Route::get('track','TrackController@index')->name('track');
    
            Route::get('admin_settings','UserController@settings')->name('admin.settings');
       /*representatives */

        Route::get('representative','RepresentativeController@index')->name('representative'); 

        Route::post('representative-store','RepresentativeController@store')->name('store-representative');

        Route::get('representative-edit/{id}','RepresentativeController@edit')->name('edit-representative');
       

        Route::post('representative-update/{id}','RepresentativeController@update')->name('update-representative');

        Route::get('representative-status','RepresentativeController@status')->name('status-representative');

        Route::post('representative-delete','RepresentativeController@delete')->name('delete-representative');
        
        
          /* company */
            Route::post('companySet/{id}','BaseController@companySet')->name('companySet');
            Route::post('allCompanyAdmin','BaseController@allCompanyAdmin')->name('allCompanyAdmin');
            Route::get('company-status','CompanyController@status')->name('status-company');
           /*banks*/
            Route::get('bank','BankController@index')->name('bank');
            Route::get('bank-create','bankController@create')->name('create-bank');
    
            Route::get('bank-edit/{id}','BankController@edit')->name('edit-bank');
    
            Route::post('bank-update/{id}','BankController@update')->name('update-bank');
    
            Route::get('bank-delete','BankController@delete')->name('delete-bank');
    
            Route::post('bank-store','BankController@store')->name('store-bank');
            
             /*methods*/
            Route::get('method','MethodController@index')->name('method');
            Route::get('method-create','MethodController@create')->name('create-method');
    
            Route::get('method-edit/{id}','MethodController@edit')->name('edit-method');
    
            Route::post('method-update/{id}','MethodController@update')->name('update-method');
    
            Route::post('method-delete','MethodController@delete')->name('delete-method');
    
            Route::post('method-store','MethodController@store')->name('store-method');
            Route::get('method-status','MethodController@status')->name('status-method');
            
                 
                 
            /*Category */
            Route::get('category','CategoryController@index')->name('category');
            Route::get('category-create','CategoryController@create')->name('create-category');
    
            Route::get('category-edit/{id}','CategoryController@edit')->name('edit-category');
    
            Route::post('category-update/{id}','CategoryController@update')->name('update-category');
    
            Route::post('category-delete','CategoryController@delete')->name('delete-category');
    
            Route::post('category-store','CategoryController@store')->name('store-category');
            Route::get('category-status','CategoryController@status')->name('status-category');            
            
            
                   
             /*payment*/
            Route::get('payment','PaymentController@index')->name('payment');
            Route::get('payment-create','PaymentController@create')->name('create-payment');
    
            Route::get('payment-edit/{id}','PaymentController@edit')->name('edit-payment');
    
            Route::post('payment-update/{id}','PaymentController@update')->name('update-payment');
    
            Route::post('payment-delete','PaymentController@delete')->name('delete-payment');
    
            Route::post('payment-store','PaymentController@store')->name('store-payment');
            Route::get('payment-status','PaymentController@status')->name('status-payment');
    
            /* company  */
    
            Route::get('companies','CompanyController@index')->name('company');
    
            Route::get('company-create','CompanyController@create')->name('create-company');
    
            Route::get('company-edit/{id}','CompanyController@edit')->name('edit-company');
    
            Route::post('company-update/{id}','CompanyController@update')->name('update-company');
    
            Route::get('company-delete','CompanyController@delete')->name('delete-company');
    
            Route::get('company-store','CompanyController@store')->name('store-company');
    
            Route::get('company/profile/{id}','CompanyController@profile')->name('profile-company');
           
    
            /*branch */
    
            Route::get('branchs','CompanyController@branch_index')->name('branch');
    
            Route::get('branch-create','CompanyController@branch_create')->name('create-branch');
    
            Route::get('branch-edit/{id}','CompanyController@branch_edit')->name('edit-branch');
    
            Route::post('branch-update/{id}','CompanyController@branch_update')->name('update-branch');
    
            Route::post('branch-delete','CompanyController@branch_delete')->name('delete-branch');
    
            Route::post('branch-store','CompanyController@branch_store')->name('store-branch');
    
            /*department*/
    
            Route::get('departments','CompanyController@department_index')->name('department');
    
            Route::get('department-create','CompanyController@department_create')->name('create-department');
    
            Route::get('department-edit/{id}','CompanyController@department_edit')->name('edit-department');
    
            Route::post('department-update/{id}','CompanyController@department_update')->name('update-department');
    
            Route::get('department-delete','CompanyController@department_delete')->name('delete-department');
    
            Route::post('department-store','CompanyController@department_store')->name('store-department');
    
            /* COMPANY-SUBSCRIBE */
    
            //Route::get('company-subscribe','CompanyController@company_subscribe')->name('subscribe-index');
            
            Route::get('subscribe_index','CompanyController@subscribe_index')->name('subscribe-index');
          
            Route::post('subscribe_store_userplan','CompanyController@subscribe_store_userplan')->name('subscribe-store-userplan');
    
            Route::post('upgrade-subscribe','CompanyController@upgrade_subscribe')->name('upgrade-subscribe');
    
            Route::get('subscribe_pay/{plan}/{company}','CompanyController@subscribe_pay')->name('subscribe-pay');
    
    
    
            /* Employee */
    
    
    
            Route::get('employees','EmployeeController@index')->name('employee');
           
          
    
            Route::post('employee-store','EmployeeController@store')->name('store-employee');
    
            Route::get('employee-edit/{id}','EmployeeController@edit')->name('edit-employee');
    
            Route::post('employee-update/{id}','EmployeeController@update')->name('update-employee');
    
            Route::post('employee-delete','EmployeeController@delete')->name('delete-employee');
    
            Route::get('employee-search','EmployeeController@search')->name('search-employee');
            Route::get('employee-status','EmployeeController@status')->name('status-employee');
            
           /*permission*/
            Route::get('permissions','PermissionController@index')->name('permission');
    
            Route::post('permission-store','PermissionController@store')->name('store-permission');
    
            Route::get('permission-edit/{id}','PermissionController@edit')->name('edit-permission');
    
            Route::post('permission-update/{id}','PermissionController@update')->name('update-permission');
    
            Route::post('permission-delete','PermissionController@delete')->name('delete-permission');
    
            Route::get('permission-search','PermissionController@search')->name('search-permission');
              /*roles*/
            Route::get('roles','RoleController@index')->name('role');
    
            Route::post('role-store','RoleController@store')->name('store-role');
    
            Route::get('role-edit/{id}','RoleController@edit')->name('edit-role');
    
            Route::post('role-update/{id}','RoleController@update')->name('update-role');
    
            Route::post('role-delete','RoleController@delete')->name('delete-role');
    
            Route::get('role-search','RoleController@search')->name('search-role');
    
    
            /*Holiday*/
    
            Route::get('exception-holidays','HolidayController@exception_holiday_index')->name('exception-holidays');
    
            Route::get('exception-holidays-create','HolidayController@exception_holiday_create')->name('create-exception-holiday');
    
            Route::post('exception-holidays-store','HolidayController@exception_holidays_store')->name('store-exception-holidays');
    
            Route::get('exception-holidays-edit/{id}','HolidayController@exception_holidays_edit')->name('edit-exception_holidays');
    
            Route::post('exception-holidays-update/{id}','HolidayController@exception_holidays_update')->name('update-exception_holidays');
    
            Route::post('exception-holidays-delete','HolidayController@exception_holidays_delete')->name('delete-exception_holidays');
    
           // Route::get('employee-search','EmployeeController@search')->name('search-employee');*/
    
           /*fixed holiday*/
    
             Route::get('fixed-holidays','HolidayController@fixed_holidays_index')->name('fixed-holidays');
    
             Route::post('fixed-holidays-store','HolidayController@fixed_holidays_store')->name('store-fixed-holidays');
    
             Route::get('fixed-holidays-edit/{id}','HolidayController@fixed_holidays_edit')->name('edit-fixed_holidays');
    
             Route::post('fixed-holidays-update/{id}','HolidayController@fixed_holidays_update')->name('update-fixed_holidays');
    
             Route::post('fixed-holidays-delete','HolidayController@fixed_holidays_delete')->name('delete-fixed_holidays');
    
    
    
             /*workflow*/
    
             Route::get('workflow','WorkflowController@index')->name('workflow'); 
    
             Route::get('workflow-create','WorkflowController@create')->name('create-workflow');
    
             Route::get('workflow-store','WorkflowController@store')->name('store-workflow');
    
             Route::get('workflow-edit/{shift_id}','WorkflowController@edit')->name('edit-workflow');
    
             Route::post('workflow-update/{id}','WorkflowController@update')->name('update-workflow');
    
             Route::post('workflow-delete','WorkflowController@delete')->name('delete-workflow');
    
             /*shifts */
    
             Route::get('shift','ShiftController@index')->name('shift'); 
    
             Route::POST('shift-store','ShiftController@store')->name('store-shift');
    
             Route::get('shift-status','ShiftController@status')->name('status-shift');
    
             Route::get('shift-edit/{id}','ShiftController@edit')->name('edit-shift');
    
             Route::post('shift-update/{id}','ShiftController@update')->name('update-shift');
    
             Route::post('shift-delete','ShiftController@delete')->name('delete-shift');
    
    
    
             /* user shifts */
    
             Route::get('usershift','ShiftController@user_shift_index')->name('user_shift_index'); 
    
             Route::post('usershift/schedule-store','ShiftController@shift_schedule_store')->name('shift_schedule_store'); 
    
             Route::post('usershift/schedule-delete','ShiftController@shift_schedule_delete')->name('shift_schedule_delete'); 
            
             Route::get('usershift/user_shift_edit/{id}','ShiftController@user_shift_edit')->name('user_shift_edit');
    
             Route::post('usershift/user-shift-update/{id}','ShiftController@user_shift_update')->name('user_shift_update');
    
             /*attandance*/
    
             Route::get('attendance','AttendanceController@index')->name('attendance'); 
    
             Route::get('show_details/{id}/{user_id}','AttendanceController@show_details')->name('show_details'); 
    
             /*tasks*/
    
            //Route::get('task','TaskController@index')->name('task'); 
             Route::get('task','TaskController@task_datatable')->name('task'); 
             Route::post('task-store','TaskController@store')->name('store-task');
    
             Route::get('task-edit/{id}','TaskController@edit')->name('edit-task');
    
             Route::post('task-update/{id}','TaskController@update')->name('update-task');
    
             Route::post('task-delete','TaskController@delete')->name('delete-task');
    
    
    
             /*outdoors*/
    
             Route::get('outdoor','OutdoorController@index')->name('outdoor'); 
    
             Route::post('outdoor-store','OutdoorController@store')->name('store-outdoor');
    
             Route::get('outdoor-edit/{id}','OutdoorController@edit')->name('edit-outdoor');
    
             Route::post('outdoor-update/{id}','OutdoorController@update')->name('update-outdoor');
    
             Route::post('outdoor-delete','OutdoorController@delete')->name('delete-outdoor');
    
    
    
             /*visit type*/
    
    
    
             Route::get('outdoor-type','VisitTypeController@index')->name('outdoor-type'); 
    
             Route::post('outdoor-type-store','VisitTypeController@store')->name('store-outdoor-type');
    
             Route::get('outdoor-type-edit/{id}','VisitTypeController@edit')->name('edit-outdoor-type');
    
             Route::post('outdoor-type-update/{id}','VisitTypeController@update')->name('update-outdoor-type');
    
             Route::post('outdoor-type-delete','VisitTypeController@delete')->name('delete-outdoor-type');
    
            /*question */
    
            
    
            Route::get('outdoor-question','VisitQuestionController@index')->name('outdoor-question'); 
    
            Route::post('visitquestion-store','VisitQuestionController@store')->name('store-visitquestion');
    
            Route::get('visitquestion-edit/{id}','VisitQuestionController@edit')->name('edit-visitquestion');
    
            Route::post('visitquestion-update/{id}','VisitQuestionController@update')->name('update-visitquestion');
    
            Route::post('visitquestion-delete','VisitQuestionController@delete')->name('delete-visitquestion');
    
    
    
            /*leaves*/
    
          //  Route::get('leaves','LeaveController@index')->name('leaves'); 
            Route::get('leaves','LeaveController@leave_datatable')->name('leaves'); 
    
            Route::post('leaves-store','LeaveController@store')->name('store-leaves');
    
            Route::post('leaves-update/{id}','LeaveController@update')->name('update-leaves');
    
            Route::get('leaves-edit/{id}','LeaveController@edit')->name('edit-leaves');
    
            Route::post('leaves-delete','LeaveController@delete')->name('delete-leaves');
            Route::post('leaves/leave-settings-change_status','LeaveController@leave_setting_change_status')->name('status-leaves');
    
    
            /*outdoor reports*/
    
            Route::get('visitReport','VisitReportController@index')->name('visitReport'); 
    
            Route::get('visitReport-store','VisitReportControllerr@store')->name('store-visitReport');
    
            Route::post('visitReport-update/{id}','VisitReportController@update')->name('update-visitReport');
    
            Route::get('visitReport-edit/{id}','VisitReportController@edit')->name('edit-visitReport');
    
        
    
    
    
            /*leave setting */
    
    
    
            Route::get('leave/leave-settings','LeaveController@leaveSetting')->name('leave-settings'); 
    
            Route::get('leave/leave-settings-update','LeaveController@update_leave_setting')->name('leave-settings-update'); 
    
            Route::post('leave/add-custom-leave','LeaveController@add_custom_leave')->name('add-custom-leave');
            Route::get('leave/edit-custom-leave/{id}','LeaveController@edit_custom_leave')->name('edit-custom-leave');
            Route::post('leave/customleave-update/{id}','LeaveController@update_custom_leave')->name('update-custom-leave');
    
            Route::get('leave/view-custom','LeaveController@view_custom')->name('view_custom');
    
            Route::get('leave/get_available','LeaveController@get_avialable')->name('get_available');
    
            Route::post('leave/change_status','LeaveController@change_status')->name('change-status');
    
    
    
            /*jobs*/
    
            Route::get('jobs','JobController@index')->name('job');
    
            Route::post('job-store','JobController@store')->name('store-job');
    
            Route::get('job-edit/{id}','JobController@edit')->name('edit-job');
    
            Route::post('job-update/{id}','JobController@update')->name('update-job');
    
            Route::post('job-delete','JobController@delete')->name('delete-job');
    
            
    
            /*clients */
    
            Route::get('clients','ClientController@index')->name('client'); 
    
            Route::post('client-store','ClientController@store')->name('store-client');
    
            Route::get('client-edit/{id}','ClientController@edit')->name('edit-client');
             Route::get('client-profile/{id}','ClientController@profile')->name('profile-client');
    
            Route::post('client-update/{id}','ClientController@update')->name('update-client');
    
            Route::get('client-status','ClientController@status')->name('status-client');
    
            Route::post('client-delete','ClientController@delete')->name('delete-client');
    
    
    
            /*client_type*/
    
            Route::get('client_type','ClientController@index_type')->name('client_type'); 
    
            Route::post('client_type-store','ClientController@store_type')->name('store-client_type');
    
            Route::get('client_type-edit/{id}','ClientController@edit_type')->name('edit-client_type');
    
            Route::post('client_type-update/{id}','ClientController@update_type')->name('update-client_type');
    
            Route::post('client_type-delete','ClientController@delete_type')->name('delete-client_type');
    
    
    
    
    
            /* department report */
    
            Route::get('report-department','ReportController@department_report')->name('report-department'); 
    
            /*dialy report */
    
            Route::get('report-dialy','ReportController@dialyReport')->name('report-dialy'); 
    
            Route::post('dialy-present','ReportController@ajaxPresentDialy')->name('dialy-present');
    
            Route::get('dialyPrint/{type}','ReportController@dialyPrint')->name('dialyPrint');
    
    
    
            /*month  report*/
    
            Route::get('month-report','ReportController@monthReport')->name('month-report');
    
            Route::get('monthlyPrint/{type}','ReportController@monthlyPrint')->name('monthlyPrint');
    
          
    
             
         
            
            
            /*  visit report  */
                Route::get('visitPrint/{type}','VisitReportController@visitPrint')->name('visitPrint');
                
                
                  /*  user logs  */
            Route::get('logs','LogsController@viewLogs')->name('view-logs');
            Route::post('logs/{id}/delete','LogsController@delete')->name('delete-logs');
    
            /*  user tarcking  */
              Route::get('employee/track','EmployeeTrackingController@employeeTrack')->name('employee-track');


    });
      

});
});
Route::get('/', function () {
    return redirect('/admin');
});
});






    

   /* Route::get('/home', function () {

        return view('index');

    });*/






/*
Route::get('/index', function () {

    return view('index');

})->name('page');



Route::get('/employee-dashboard', function () {

    return view('employee-dashboard');

});

Route::get('/chat', function () {

    return view('chat');

});

Route::get('/voice-call', function () {

    return view('voice-call');

});

Route::get('/video-call', function () {

    return view('video-call');

});

Route::get('/outgoing-call', function () {

    return view('outgoing-call');

});

Route::get('/incoming-call', function () {

    return view('incoming-call');

});

Route::get('/events', function () {

    return view('events');

});

Route::get('/contacts', function () {

    return view('contacts');

});

Route::get('/inbox', function () {

    return view('inbox');

});

Route::get('/file-manager', function () {

    return view('file-manager');

});

Route::get('/employees', function () {

    return view('employees');

});

Route::get('/holidays', function () {

    return view('holidays');

});

Route::get('/leaves', function () {

    return view('leaves');

});

Route::get('/leaves-employee', function () {

    return view('leaves-employee');

});

Route::get('/leave-settings', function () {

    return view('leave-settings');

});

Route::get('/attendance', function () {

    return view('attendance');

});

Route::get('/attendance-employee', function () {

    return view('attendance-employee');

});

Route::get('/departments', function () {

    return view('departments');

});

Route::get('/designations', function () {

    return view('designations');

});

Route::get('/timesheet', function () {

    return view('timesheet');

});

Route::get('/overtime', function () {

    return view('overtime');

});

Route::get('/clients', function () {

    return view('clients');

});

Route::get('/projects', function () {

    return view('projects');

});

Route::get('/tasks', function () {

    return view('tasks');

});

Route::get('/task-board', function () {

    return view('task-board');

});

Route::get('/leads', function () {

    return view('leads');

});

Route::get('/tickets', function () {

    return view('tickets');

});

Route::get('/estimates', function () {

    return view('estimates');

});

Route::get('/invoices', function () {

    return view('invoices');

});

Route::get('/payments', function () {

    return view('payments');

});

Route::get('/expenses', function () {

    return view('expenses');

});

Route::get('/provident-fund', function () {

    return view('provident-fund');

});

Route::get('/taxes', function () {

    return view('taxes');

});

Route::get('/salary', function () {

    return view('salary');

});

Route::get('/salary-view', function () {

    return view('salary-view');

});

Route::get('/payroll-items', function () {

    return view('payroll-items');

});

Route::get('/policies', function () {

    return view('policies');

});

Route::get('/expense-reports', function () {

    return view('expense-reports');

});

Route::get('/invoice-reports', function () {

    return view('invoice-reports');

});

Route::get('/performance-indicator', function () {

    return view('performance-indicator');

});

Route::get('/performance', function () {

    return view('performance');

});

Route::get('/performance-appraisal', function () {

    return view('performance-appraisal');

});

Route::get('/goal-tracking', function () {

    return view('goal-tracking');

});

Route::get('/goal-type', function () {

    return view('goal-type');

});

Route::get('/training', function () {

    return view('training');

});

Route::get('/trainers', function () {

    return view('trainers');

});

Route::get('/training-type', function () {

    return view('training-type');

});

Route::get('/promotion', function () {

    return view('promotion');

});

Route::get('/resignation', function () {

    return view('resignation');

});

Route::get('/termination', function () {

    return view('termination');

});

Route::get('/assets', function () {

    return view('assets');

});

Route::get('/jobs', function () {

    return view('jobs');

});

Route::get('/jobs-applicants', function () {

    return view('jobs-applicants');

});

Route::get('/knowledgebase', function () {

    return view('knowledgebase');

});

Route::get('/activities', function () {

    return view('activities');

});

Route::get('/users', function () {

    return view('users');

});

Route::get('/settings', function () {

    return view('settings');

});

Route::get('/localization', function () {

    return view('localization');

});

Route::get('/theme-settings', function () {

    return view('theme-settings');

});

Route::get('/roles-permissions', function () {

    return view('roles-permissions');

});

Route::get('/email-settings', function () {

    return view('email-settings');

});

Route::get('/invoice-settings', function () {

    return view('invoice-settings');

});

Route::get('/salary-settings', function () {

    return view('salary-settings');

});

Route::get('/notifications-settings', function () {

    return view('notifications-settings');

});

Route::get('/change-password', function () {

    return view('change-password');

});

Route::get('/leave-type', function () {

    return view('leave-type');

});

Route::get('/profile', function () {

    return view('profile');

});

Route::get('/client-profile', function () {

    return view('client-profile');

});

Route::get('/login', function () {

    return view('login');

});

Route::get('/register', function () {

    return view('register');

});

Route::get('/forgot-password', function () {

    return view('forgot-password');

});

Route::get('/otp', function () {

    return view('otp');

});

Route::get('/lock-screen', function () {

    return view('lock-screen');

});

Route::get('/error-404', function () {

    return view('error-404');

});

Route::get('/error-500', function () {

    return view('error-500');

});

Route::get('/subscriptions', function () {

    return view('subscriptions');

});

Route::get('/subscriptions-company', function () {

    return view('subscriptions-company');

});

Route::get('/subscribed-companies', function () {

    return view('subscribed-companies');

});

Route::get('/search', function () {

    return view('search');

});

Route::get('/faq', function () {

    return view('faq');

});

Route::get('/terms', function () {

    return view('terms');

});

Route::get('/privacy-policy', function () {

    return view('privacy-policy');

});

Route::get('/blank-page', function () {

    return view('blank-page');

});

Route::get('/components', function () {

    return view('components');

});

Route::get('/form-basic-inputs', function () {

    return view('form-basic-inputs');

});

Route::get('/form-input-groups', function () {

    return view('form-input-groups');

});

Route::get('/form-horizontal', function () {

    return view('form-horizontal');

});

Route::get('/form-vertical', function () {

    return view('form-vertical');

});

Route::get('/form-mask', function () {

    return view('form-mask');

});

Route::get('/form-validation', function () {

    return view('form-validation');

});

Route::get('/tables-basic', function () {

    return view('tables-basic');

});

Route::get('/data-tables', function () {

    return view('data-tables');

});

Route::get('/create-estimate', function () {

    return view('create-estimate');

});

Route::get('/create-invoice', function () {

    return view('create-invoice');

});

Route::get('/clients-list', function () {

    return view('clients-list');

});

Route::get('/compose', function () {

    return view('compose');

});

Route::get('/edit-estimate', function () {

    return view('edit-estimate');

});

Route::get('/edit-invoice', function () {

    return view('edit-invoice');

});

Route::get('/estimate-view', function () {

    return view('estimate-view');

});

Route::get('/job-view', function () {

    return view('job-view');

});

Route::get('/job-list', function () {

    return view('job-list');

});

Route::get('/job-details', function () {

    return view('job-details');

});

Route::get('/knowledgebase-view', function () {

    return view('knowledgebase-view');

});

Route::get('/mail-view', function () {

    return view('mail-view');

});

Route::get('/project-list', function () {

    return view('project-list');

});

Route::get('/project-view', function () {

    return view('project-view');

});

Route::get('/ticket-view', function () {

    return view('ticket-view');

});

Route::get('/invoice-view', function () {

    return view('invoice-view');

});

Route::get('/employees-list', function () {

    return view('employees-list');

});*/