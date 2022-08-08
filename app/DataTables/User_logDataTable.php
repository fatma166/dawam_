<?php

namespace App\DataTables;

use App\Models\User_log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class User_logDataTable extends DataTable
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
            ->addColumn('setting',function($row){
                return 
        '<div class="dropdown dropdown-action">
            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"aria-expanded="false"><i class="material-icons">more_vert</i></a>
            <div class="dropdown-menu dropdown-menu-right">
               
            </div>
        </div>';

          
            })->rawColumns(['setting','user_name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User_log $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {   
        $request=$this->request;
        $query=$this->company->logs();
        if($request->filled('branch')){
           $query->where("users.branch_id",$request->branch);
        }

        if ($request->filled('emp_name')) {
            $query->where("users.id",$request->emp_name);
        
        }

        if ($request->filled('date_from')) {
            $query->whereDate("user_logs.datetime",">=",$request->date_from);
        
        }

        if ($request->filled('date_to')) {
            $query->whereDate("user_logs.datetime","<=",$request->date_to);
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
                    ->setTableId('user_log-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(1)
                    ->parameters([
                        'encode'=>'UTF-8',
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
           ["name"=>"name","data"=>"user_name","title"=>__("trans.Empolyee")],
           ["name"=>"user_logs.action","data"=>"action","title"=>__('trans.process')],
           ["name"=>"user_logs.description","data"=>"description","title"=>__('trans.Description')],
           ["name"=>"user_logs.datetime","data"=>"datetime","title"=> __('trans.Time') ],
           ["data"=>"setting","title"=> __('trans.setting') ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_log_' . date('YmdHis');
    }
}
