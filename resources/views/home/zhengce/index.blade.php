@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/zhengce/create" class="btn btn-success btn-md">
                                <i class="fa fa-plus-circle"></i> 新增活动
                            </a>
                    </div>


                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table class="table table-bordered table-condensed" class="table" >
                                <thead>
                                <tr class="text-center" align="center">
                                    <th>编号</th>
                                    <th>型号</th>
                                    <th>简称</th>
                                    <th>直降</th>
                                    <th>年</th>
                                    <th>月</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($zhengces as $key => $lists)
                                    <tr class="text-center">
                                        <td>{{$lists->id}}</td>
                                        <td>{{$lists->model}}</td>
                                        <td>{{$lists->jmodel}}</td>
                                        <td>{{$lists->hdamount}}</td>
                                        <td>{{$lists->year}}</td>
                                        <td>{{$lists->month}}</td>
                                        <td><a href="/zhengce/{{ $lists->id }}/edit" class="btn btn-xs btn-info">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
