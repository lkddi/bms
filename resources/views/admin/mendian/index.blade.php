@extends('admin.index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">门店列表</h3>
                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered table-condensed" class="table" >
                            <thead>
                            <tr class="text-center" align="center">
                                <th>编号</th>
                                <th>门店名称</th>
                                <th>门店简称</th>
                                <th>区域id</th>
                                <th>渠道id</th>
                                <th>编辑</th>
                                <th>删除</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($qudao as $key => $lists)
                                <tr class="text-center">
                                    <td>{{$lists->id}}</td>
                                    <td>{{$lists->mdname}}</td>
                                    <td>{{$lists->mdpy}}</td>
                                    <td>{{$lists->quyu_id}}</td>
                                    <td>{{$lists->qudao_id}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop