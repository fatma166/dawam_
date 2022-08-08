               
                <div class="row" >
                    <div class="col-md-12">
                        <div class="table-responsive">
                                   <th><h2>{{__('trans.visit_type')}}</h2><h3>@if(isset($serach_name['name'])){{$serach_name['name']}}@else {{__('trans.search to get result') }}@endif</h3></th>
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                              
                                <thead>
                                    <tr>
                                        <th>{{__('trans.Question Id')}}</th>
                                        <th>{{__('trans.Question Title')}}</th>
                                        <th>{{__('trans.Question Type')}}</th>
                                        <th>{{__('trans.visit_type')}}</th>
                                        <th colspan="4">{{__('trans.QUESTION ANSWERS')}}</th>
                         
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                 <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                 @foreach($visitquestionanswers as  $id=>$visitquestionanswer_)
                                  <tr>
                                   
                                        <td>
                                            <strong>{{$id}}</strong>
                                        </td>
                                        <td>
                                            <strong>{{$visitquestionanswer_['question_text']}}</strong>
                                        </td>
                                        <td>
                                            <strong>{{$visitquestionanswer_['question_type']}}</strong>
                                        </td>
                                        <td>
                                            <strong>{{$serach_name['name']}}</strong>
                                        </td>
                                         @foreach($visitquestionanswer_['answer'] as $index=> $visitquestionanswer)
                                         @php    $total_answers=0; $total_answers.=($visitquestionanswer->COUNT_NUMBER) @endphp
                                               
                                                <td class="border">
                                                      {{$visitquestionanswer->answer_value}}<span> &nbsp; &nbsp; </span><strong> <a href="{{url('https://egifix.dawam.net/admin/visitReport?outdoor_ids='.$visitquestionanswer->outdoor_ids)}}">{{$visitquestionanswer->COUNT_NUMBER}}</a> </strong>
                                                </td>
                                           
                                              
                                         
                                                
                                            
                                            @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              