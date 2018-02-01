@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">渠道管理</div>

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
                                    <th>渠道名称</th>
                                    <th>区域</th>
                                    <th>编辑</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($qudaos as $key => $lists)
                                    <tr class="text-center">
                                        <td>{{$lists->id}}</td>
                                        <td>{{$lists->qdname}}</td>
                                        <td>{{$lists->qyname}}</td>
                                        <td><a href="/qudao/{{ $lists->id }}/edit" class="btn btn-xs btn-info">
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
