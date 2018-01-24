<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>数据查询</title>
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style>
            .table th, .table td { 
text-align: center; 
height:38px;
}
        </style>

    </head>
    <body>

	<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
				@if(empty($name))
				<h3>门店销售查询系统(所有门店)</h3>
				@else
				<h3>门店销售查询系统({{$name}})</h3>
				@endif

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid"> 
	<div class="navbar-header">
		<a class="navbar-brand" href="#">选项</a>
	</div>
	<div>
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					本周 
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					
					<li><a href="/cxby">本月</a></li>
					
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					区域 
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					@foreach ($quyus as $key => $quyu)
					<li><a href="/quire?qyid={{$quyu->id}}">{{$quyu->name}}</a></li>
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
					<li><a href="/quire?mdname={{$mdlists->mdname}}">{{$mdlists->mdname}}</a></li>
					@endforeach
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>
				<table class="table table-bordered table-condensed" class="table" >
					<thead>
						<tr class="text-center" align="center">
							<th>编号</th>
							@if(empty($name))
							<th>门店</th>
							@endif
							<th>型号</th>
							<th>卖价</th>
							<th>时间</th>
							<th>状态</th>
							<th>图片</th>
						</tr>
					</thead>
					<tbody>

						
							@foreach ($list as $key => $lists)
							<tr class="text-center">
							<td>{{$key + 1}}</td>
							@if(empty($name))
							<td>{{$lists->mdname}}</td>
							@endif
							<td>{{$lists->model}}</td>
							<td>{{$lists->amount}}</td>
							<td>{{$lists->date}}</td>
							<td>
								@if ($lists->arbitrary === 1)
								    <font color="red">乱价</font>
								@else
								    正常
								@endif</td>
							<td><a href = {{$lists->image}}>查看</a></td>

							</tr>
							@endforeach
						
					</tbody>
				</table>

{{ $list->links() }}
			</div>
		</div>
	</div>
    </body>
</html>
