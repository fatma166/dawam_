  <div class="row" id="visit_question">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>{{__('trans.question_text')}}</th>
                                        <th>{{__('trans.type')}}</th>
                                         <th>{{__('trans.visittype')}}</th>
                                        <th class="text-right">{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                @if(!empty($visits_question))
                                @foreach($visits_question as $visit_question)
                                    <tr>
                                        <td>{{$visit_question->id}}</td>
                                        <td>{{$visit_question->question_text}}</td>
                                        <td>{{$visit_question->type}}</td>
                                       
                                        <td>{{$visit_question->name}}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                   <a class="dropdown-item" data-href="{{ url('admin/visitquestion-edit/'.$visit_question->id) }}" visitquestion-id="{{$visit_question->id}}"  data-toggle="modal" data-target="#edit_visit_question"><i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                                   <a class="dropdown-item" data-toggle="modal"  data-target="#delete_visit_question" delete-id="{{$visit_question->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                </div>

                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach  
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>