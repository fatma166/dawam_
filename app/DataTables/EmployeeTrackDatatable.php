<?php

namespace App\DataTables;

use App\Models\User_log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon; 
class EmployeeTrackDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_name',function($row){

return  '<h2 class="table-avatar">
<a class="avatar" data-href="#" ><img alt="" src="'.asset($row->user_avatar).'"></a>
<a class="" data-href="#">'.$row->user_name.' <span>'.$row->job_title.'</span></a>
</h2>';


            })
            ->editColumn('device_info',function($row){
                
                $list=json_decode($row->device_info);
                
                if($list){
                    return $list->brand.'~'.$list->app_ver.'~'.$list->os_ver;
                }
               })->addColumn("last_login_expr",function($row){
                  if($row->last_login){

                    return    Carbon::createFromFormat('Y-m-d H:i:s',$row->last_login)->locale('ar')->diffForHumans();

                  }


               })->rawColumns(['user_name']);
    }

  
    public function query()
    {   
        $request=$this->request;
        $query=$this->company->employeeTrack();
        if($request->filled('branch')){
           $query->where("users.branch_id",$request->branch);
        }
        if ($request->filled('emp_name')) {
            $query->where("users.id",$request->emp_name);
        
        }
        if ($request->filled('date_from')) {
            $query->whereDate("users.last_login",">=",$request->date_from);
        
        }
        if ($request->filled('date_to')) {
            $query->whereDate("users.last_login","<=",$request->date_to);
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('employee_track-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(1)
                    ->parameters([
                        'language' => ['url' => url(__('trans.datatable')),
                        'processing'=> '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                        ]
                      ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
           ["data"=>"user_id","title"=>__('trans.Employee ID'),'searchable'=>false,'orderable'=>false],
           ["name"=>"name","data"=>"user_name","title"=>__("trans.Empolyee")],
           ["name"=>"phone","data"=>"phone","title"=>__('trans.Mobile')],
           ["name"=>"branches.title","data"=>"branch_title","title"=>__('trans.Branch')],
           ["name"=>"users.device_info","data"=>"device_info","title"=> __('trans.DeviceInfo')],
           ["name"=>"users.last_login","data"=>"last_login","title"=> __('trans.LastLogin')],
           ["data"=>"last_login_expr","title"=>"",'searchable'=>false,'orderable'=>false],
        ];
    }

     /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'EmployeeTrack_' . date('YmdHis');
    }
}






















 

