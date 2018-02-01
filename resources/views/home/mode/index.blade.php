@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/mode/create" class="btn btn-success btn-md">
                                <i class="fa fa-plus-circle"></i> 新增产品
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
                                    <th>零售价</th>
                                    <th>状态</th>
                                    <th>编辑</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($modes as $key => $lists)
                                    <tr class="text-center">
                                        <td>{{$lists->id}}</td>
                                        <td>{{$lists->model}}</td>
                                        <td>{{$lists->jmodel}}</td>
                                        <td>{{$lists->price}}</td>
                                        <td>@if($lists->state ===1)
                                                下线
                                                @else
                                                正常
                                                @endif
                                        </td>
                                        <td><a href="/mode/{{ $lists->id }}/edit" class="btn btn-xs btn-info">
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
