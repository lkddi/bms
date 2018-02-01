@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						@if(empty($name))
							本月销售查询系统(所有门店)
						@else
							本月销售查询系统---({{$name}})
						@endif</div>

					<div class="panel-body">
						@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif
							<nav class="navbar navbar-default" role="navigation">
								<div class="container-fluid">
									<div>
										<ul class="nav navbar-nav">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													区域
													<b class="caret"></b>
												</a>
												<ul class="dropdown-menu">
													@foreach ($quyus as $key => $quyu)
														<li><a href="/cxbz?quyu_id={{$quyu->id}}">{{$quyu->qyname}}</a></li>
													@endforeach
												</ul>
											</li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													渠道
													<b class="caret"></b>
												</a>
												<ul class="dropdown-menu">
													@foreach ($qudao as $key => $qudaos)
														<li><a href="/cxbz?qudao_id={{$qudaos->id}}">{{$qudaos->qdname}}</a></li>
													@endforeach
												</ul>
											</li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													门店
													<b class="caret"></b>
												</a>
												<ul class="dropdown-menu">
													@foreach ($mdnames as $key => $mdlists)
														<li><a href="/cxbz?mdname={{$mdlists->mdname}}">{{$mdlists->mdname}}</a></li>
													@endforeach
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</nav>
							<table class="table table-bordered table-condensed" class="table" >
								<thead>
								<tr >
									<th>编号</th>
									<th>门店</th>
									<th>型号</th>
									<th>卖价</th>
									<th>时间</th>
									<th>状态</th>
									<th>发票</th>
								</tr>
								</thead>
								<tbody>
								@foreach ($list as $key => $lists)
									<tr class="text-center">
										<td>{{$key + 1}}</td>
										<td>{{$lists->mdname}}</td>
										<td>{{$lists->model}}</td>
										<td>{{$lists->amount}}</td>
										<td>{{$lists->date}}</td>
										<td>
											@if ($lists->arbitrary === 1)
												<font color="red">乱价</font>
											@else
												正常
											@endif</td>
										<td>
                                            <a class="btn btn-xs btn-info" href="{{ url('/') }}{{$lists->image}}" rel="lightbox-group" title="{{$lists->mdname}}-{{$lists->model}}-{{$lists->amount}}">view</a>
                                        </td>

									</tr>
								@endforeach

								</tbody>
							</table>

							{{ $list->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

