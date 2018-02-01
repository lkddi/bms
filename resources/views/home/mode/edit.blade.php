@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">所有数据 <small>» 修改</small></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('mode.update', $mode->id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{ method_field('PUT') }}

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">
                                            型号
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="model" autofocus id="title" value="{{ $mode->model }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-md-2 control-label">
                                            简称
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="jmodel" id="subtitle" value="{{ $mode->jmodel }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-md-2 control-label">
                                            零售价
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="price" id="subtitle" value="{{ $mode->price }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_image" class="col-md-2 control-label">
                                            状态
                                        </label>
                                        <div class="col-md-8">
                                            <label>
                                                <input type="radio" name="state"  value="0" @if ($mode->state ===0) checked="checked" @endif>
                                                正常
                                            </label>
                                            <label>
                                                <input type="radio" name="state"  value="1" @if($mode->state) checked="checked" @endif>
                                                下线
                                            </label>
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        <button type="submit" class="btn btn-success btn-lg" name="action" value="finished">
                                            <i class="fa fa-floppy-o"></i>
                                            保存
                                        </button>
                                        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modal-delete">
                                            <i class="fa fa-times-circle"></i>
                                            删除
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        {{-- 确认删除 --}}
        <div class="modal fade" id="modal-delete" tabIndex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">提示</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            您确定要删除该条数据吗?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('mode.destroy', $mode->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-times-circle"></i> 确定
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $(function() {
            $("#publish_date").pickadate({
                format: "mmm-d-yyyy"
            });
            $("#publish_time").pickatime({
                format: "h:i A"
            });
            $("#tags").selectize({
                create: true
            });
        });
    </script>
@stop