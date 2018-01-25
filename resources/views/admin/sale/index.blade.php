@extends('admin.index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">销售明细表</h3>
                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered table-condensed" class="table" >
                            <thead>
                            <tr class="text-center" align="center">
                                <th>编号</th>
                                <th>门店</th>
                                <th>型号</th>
                                <th>零售价</th>
                                <th>直降金额</th>
                                <th>卖价</th>
                                <th>时间</th>
                                <th>状态</th>
                                <th>图片</th>
                                <th>编辑</th>
                                <th>删除</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($sales as $key => $lists)
                                <tr class="text-center">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$lists->mdname}}</td>
                                    <td>{{$lists->model}}</td>
                                    <td>{{$lists->price}}</td>
                                    <td>{{$lists->hdamount}}</td>
                                    <td>{{$lists->amount}}</td>
                                    <td>{{$lists->date}}</td>
                                    <td>
                                        @if ($lists->arbitrary === 1)
                                            <font color="red">乱价</font>
                                        @else
                                            正常
                                        @endif</td>
                                    <td><a href = {{$lists->image}}>查看</a></td>
                                    <td>编辑</td>
                                    <td>删除</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{ $sales->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop