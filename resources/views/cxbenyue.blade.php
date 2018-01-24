<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>本月数据查询</title>
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
                <h3>本月销售查询系统(所有门店)</h3>
            @else
                <h3>本月销售查询系统({{$name}})</h3>
            @endif

            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    本月
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">

                                    <li><a href="/cxbz">本周</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    区域
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($quyus as $key => $quyu)
                                        <li><a href="/cxby?qyid={{$quyu->id}}">{{$quyu->qyname}}</a></li>
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
                                        <li><a href="/cxby?qdid={{$qudaos->id}}">{{$qudaos->qdname}}</a></li>
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
                                        <li><a href="/cxby?mdname={{$mdlists->mdname}}">{{$mdlists->mdname}}</a></li>
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
                        <th>门店</th>
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
