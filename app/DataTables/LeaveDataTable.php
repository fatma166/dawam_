<?php

namespace App\DataTables;

use App\Models\Leave_request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class LeaveDataTable extends DataTable
{
    
    

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
   public function ajax()
    {
        return datatables()->eloquent($this->query())->editColumn('status', function ($row)
        {
                     if($row->status=="refused") $class="text-danger"; else $class= "text-success";
                           $data_status= '<div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o '.$class.'">
                                                    <span>'.$row->status.'</span>
                                                </i>
                                            </a>';
                    if(($row->status!="refused"&&$row->status!="accepted")||$row->leave_to>=Carbon::now()->format('Y-m-d')) {
                                   $data_status.='<div class="dropdown-menu dropdown-menu-right">
                
                                        <a class="dropdown-item"  data-toggle="modal" data-target="#stutas_leave" leave-id="'.$row->id.'" status="accepted"><i class="fa fa-dot-circle-o text-success"><span>'.__('trans.Accepted').'</span></i></a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#stutas_leave" status="refused" leave-id="'.$row->id.'" ><i class="fa fa-dot-circle-o text-danger"><span></span>'.__('trans.Refused').'</i></a>
                                    </div>';
                   }
                   $data_status.='</div>';
                              
                  return($data_status);
       }
        )->addColumn('action', function ($row)
        {
             $data_action="";
            if(($row->status!="refused"&&$row->status!="accepted")||$row->leave_to>=Carbon::now()->format('Y-m-d')) { 
                   $data_action='
                    
                              <a class="btn btn-outline-success" href="#" data-href="'.url('admin/leaves-edit/'.$row->id).'" leave-id="'.$row->id.'" data-toggle="modal" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i>'.__('trans.Edit').'</a>
                              <a class="btn btn-outline-danger" delete-id="'.$row->id.'" href="#" data-toggle="modal"  data-target="#delete_leave"><i class="fa fa-trash-o m-r-5"></i>'.__('trans.Delete').'</a>
                           ';
           }
                   
           return($data_action);
            
            
           
        })->rawColumns(['status','action'])->make(true);
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
  //  $search= $_GET;
      // print_r($search); exit;
   
        if(isset($search['employee_name']))$employee_name=$search['employee_name'];else $employee_name='all';
        if(isset($search['leave_type']))$leave_type=$search['leave_type']; else $leave_type='all';
        if(isset($search['status']))$status=$search['status']; else $status='all';
        if(isset($search['from']))$from=$search['from'];else $from='all';
        if(isset($search['to']))$to=$search['to']; else $to='all';
        if(isset( $search['department']))$department= $search['department'];else $department='all';
        if(isset( $search['branch'])) $branch= $search['branch'];else  $branch='all';
        if($employee_name=='null'){$employee_name='all';}
        
        $query=Leave_request::select('users.name as user_name','leave_requests.id as leave_id','leave_requests.*','leave_types.name')
                                ->join('leave_types', 'leave_types.id', '=', 'leave_requests.leave_type_id')
                                ->join('users', 'users.id', '=', 'leave_requests.user_id')
                                ->join('departments', 'departments.id', '=', 'users.department_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id')
                                ->where(function($query) use ($manger_branch_id,$manger_department_id){
                                    if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                         $query->where('users.branch_id',$manger_branch_id);
                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                         $query->where('users.department_id',$manger_department_id);
                                       
                               
                                })
                                 ->where('leave_requests.company_id',$company)
                                                                
                                ->Where(function($query) use ($leave_type,$status,$to,$from,$employee_name,$department,$branch) {
                                    
                                    if($leave_type!='all')
                                        $query->where('leave_type_id',$leave_type);
                                    if($status!='all'){
                                        $query->where('leave_requests.status',$status);
                                    }
                                    if($to!='all'){
                                         $query->where('leave_to','<=' ,$to);
                                    }
                                    if($from!='all')
                                         $query->where('leave_from','>=', $from);
                                    if($employee_name!='all')
                                          $query->Where('leave_requests.user_id',$employee_name);
                                     if($department!='all')
                                        $query->where('users.department_id',$department);
                                     if($branch!='all')
                                        $query->where('users.branch_id',$branch);
                                })
                               ->where('users.id','!=',Auth::user()->id)
                               ->where('users.active',1)
                               ->where('users.bassma',1)
                                ->orderBy('leave_requests.created_at','desc')                              
                                                      
                                ;
                                
                             
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
                    ->setTableId('leaves-table')
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
               ["name" => "users.name", "data" => "user_name", "user_name" =>__('trans.Employee')],
               ["name" =>"leave_types.name", "data" => "name", "title" =>__('trans.Leave Type')],
               ["name" =>"leave_requests.leave_from", "data" => "leave_from", "title" =>__('trans.From')],
               ["name" =>"leave_requests.leave_to", "data" => "leave_to", "title" =>__('trans.To')],
               ["name" =>"leave_requests.days", "data" => "days", "title" =>__('trans.No of Days')], 
               ["name" =>"leave_requests.leave_reson", "data" => "leave_reson", "title" =>__('trans.Reason')],
               ["name" =>"leave_requests.answer", "data" => "answer", "title" =>__('trans.reply')],
               ["name" =>"leave_requests.status", "data" => "status", "title" =>__('trans.Status')], 
               
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
        return 'leaves_dawam_' . date('YmdHis');
    }
}
