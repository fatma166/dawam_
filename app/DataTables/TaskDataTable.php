<?php

namespace App\DataTables;

use App\Models\Task;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class TaskDataTable extends DataTable
{
    
    

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
   public function ajax()
    {
        return datatables()->eloquent($this->query())/*->editColumn('username', function ($row)
        {

            return '<h2 class="table-avatar">
                            <a class="avatar" data-href="#" ><img alt="" src="' .
                asset($row->user_avatar) . '"></a>
                            <a class="" data-href="#">' . $row->user_name .
                ' <span>' . $row->job_title . '</span></a>
                            </h2>'; }
        )*/->addColumn('action', function ($row)
        {
            return '
              <a class="btn btn-outline-success" href="#" data-href="'. url('admin/task-edit/'.$row->id) .'" task-id="'.$row->id.'"  data-toggle="modal" data-target="#edit_task"><i class="fa fa-pencil m-r-5"></i>'.__('trans.Edit').'</a>
              <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_task" delete-id="'.$row->id.'"><i class="fa fa-trash-o m-r-5"></i>'.__('trans.Delete').'</a>
            
            ';
            
            
           
        })->make(true);
    }

        /**
     * Get query source of dataTable.
     *
     * @param \App\Models\task $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $roles=Auth::user()->role()->first(); 
        $company=Auth::user()->company_id;         
        if($roles['name']=="manger") {
        
                  $manger_branch_id= Auth::user()->branch_id;
                  
                  $manger_department_id= Auth::user()->department_id;
        }else{
                  $manger_branch_id= $manger_department_id='all'  ;
        }
        $search=$this->request->all();
      // print_r($search); exit;
   
        if(isset($search['employee_name'])&&$search['employee_name']!='null' )$employee_name=$search['employee_name']; else $employee_name='all';
        if(isset($search['date_from']))$date_from=$search['date_from'];else $date_from='all';
        if(isset($search['date_to']))$date_to=$search['date_to']; else $date_to='all';
        if(isset($search['status']))$status=$search['status']; else $status='all';
        if(isset( $search['department']))$department= $search['department'];else $department='all';
        if(isset( $search['branch'])) $branch= $search['branch'];else  $branch='all';
       /* if ($request->filled('branch'))
        {
            $query->where("users.branch_id", $request->branch);
        }
        if ($request->filled('emp_name'))
        {
            $query->where("users.id", $request->emp_name);

        }
        if ($request->filled('date_from'))
        {
            $query->whereDate("user_logs.datetime", ">=", $request->date_from);

        }
        if ($request->filled('date_to'))
        {
            $query->whereDate("user_logs.datetime", "<=", $request->date_to);
        }*/
        $query=Task::select('tasks.*','users.name as username')
                   ->join('users','users.id', '=', 'tasks.user_id')
                   ->join('departments', 'departments.id', '=', 'users.department_id')
                    ->join('branches', 'branches.id', '=', 'users.branch_id')
                   ->where('tasks.company_id',$company)
 
                         ->Where(function($query1) use ($employee_name) {
                                if($employee_name!='all'){
                                    $query1->Where('users.id',$employee_name);
                                }
                            })
                              
                            ->Where(function($query) use ($status,$date_from,$date_to,$manger_branch_id,$manger_department_id,$department,$branch) {
                      
                                if($status!='all'){
                                    $query->where('tasks.status',$status);
                                }
                                if($date_from!='all'){
                                    $query->whereDate('tasks.created_at','>=',$date_from);
                                }
                                if($date_to!='all'){
                                     $query->whereDate('tasks.created_at','<=',$date_to);
                                }
                                if($department!='all')
                                     $query->where('users.department_id',$department);
                                if($branch!='all')
                                    $query->where('users.branch_id',$branch);
                               /* if($to!='all'){
                                    $query->where('outdoors.date_to','<=' ,$to);
                                }*/
                                     
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                                })
                         
                     
                             ->where('users.id', '!=' , Auth::user()->id)
                             ->orderBy('tasks.due_date','desc') ;  
                             
       return $this->applyScopes($query);
    }

 /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('tasks-table')
                    ->columns($this->getColumns())

                      
                   
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(1)
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export','print'],
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
               ["name" => "tasks.title", "data" => "title", "title" =>__('trans.Title')],
               ["name" =>"username", "data" => "username", "title" =>__('trans.Target user')],
               ["name" =>"tasks.description", "data" => "description", "title" =>__('trans.Description')],
               ["name" =>"tasks.status", "data" => "status", "title" =>__('trans.Status')], 
               ["name" =>"tasks.created_at", "data" => "created_at", "title" =>__('trans.Created_at')], 
               ["name"=>"tasks.due_date","data" =>'due_date', "title" => __('trans.Due Date')],
               ["data"=>"action","title"=>__('trans.Action'),"printable" => false,"exportable"=>false ,"orderable"=>false],
            ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tasks_dawam_' . date('YmdHis');
    }
}
