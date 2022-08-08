<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" >
									<thead>
										<tr>
										<th>{{__('trans.Scheduled Shift')}}</th>
										<?php
										
										    $currentDayOfMonth=date('j');
										    $days= Carbon\Carbon::now()->daysInMonth; ?>
											@for($day=$currentDayOfMonth;$day<=$days;$day++)
											<th>{{$day}}</th>
				                            @endfor
											
										</tr>
									</thead>
									<tbody>
									    @foreach($users as $user)
											<tr>
												<td>
													<h2 class="table-avatar">
														<a href="profile.html" class="avatar"><img alt="" src="{{asset('uploads/'.$user->avatar)}}"></a>
														<a href="profile.html"> <span>{{$user->name}}</span></a>
													</h2>
												</td>
												@for($day=$currentDayOfMonth;$day<=$days;$day++)
												<?php $count=count($usershifts[$user->id])-1;   if($count>=0) {$compar_day_ex= explode('-',$usershifts[$user->id][$count]->date); $compar_day=$compar_day_ex[2];?>
												    @if($day==$compar_day)
														<td>
															<div class="user-add-shedule-list">
																<h2>
																	<a href="#" data-toggle="modal" data-target="#edit_schedule" style="border:2px dashed #1eb53a">
																	<span class="username-info m-b-10"><?php     $startTime =Carbon\Carbon::parse($usershifts[$user->id][0]->time_in);
																												$endTime = Carbon\Carbon::parse($usershifts[$user->id][0]->time_out);

																												$totalDuration = $endTime->diffForHumans($startTime); echo $totalDuration; ?></span>
																
																	</a>
																		<span class="btn btn-primary user_shift-continue-btn" delete-id="{{$usershifts[$user->id][0]->id}}">{{__('trans.Delete Shift')}}</span>
																</h2>
															</div>
														</td>
													@else
														<td>
														<div class="user-add-shedule-list">
															<a href="#" data-toggle="modal" data-target="#add_schedule">
															<span><i class="fa fa-plus"></i></span>
															</a>
														</div>
													     </td>
													@endif
													<?php --$count; }else{?>
	                                                    <td>
															<div class="user-add-shedule-list">
																<a href="#" data-toggle="modal" data-target="#add_schedule">
																<span><i class="fa fa-plus"></i></span>
																</a>
															</div>
													     </td>

													<?php }?>
												@endfor

											</tr>
										@endforeach
                                    </tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /Content End -->
         