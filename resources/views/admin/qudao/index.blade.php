@extends('admin.index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">渠道列表</h3>
                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered table-condensed" class="table" >
                            <thead>
                            <tr class="text-center" align="center">
                                <th>编号</th>
                                <th>区域名称</th>
                                <th>编辑</th>
                                <th>删除</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($qudao as $key => $lists)
                                <tr class="text-center">
                                    <td>{{$lists->id}}</td>
                                    <td>{{$lists->qdname}}</td>
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