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

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('sale.update', $sale->id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{ method_field('PUT') }}

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">
                                            门店
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="mdname" autofocus id="title" value="{{ $sale->mdname }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-md-2 control-label">
                                            型号
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="model" id="subtitle" value="{{ $sale->model }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-md-2 control-label">
                                            卖价
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="amount" id="subtitle" value="{{ $sale->amount }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-md-2 control-label">
                                            乱价
                                        </label>
                                        <div class="col-md-8">
                                            <label>
                                                <input type="radio" name="arbitrary"  value="0" @if ($sale->arbitrary ===0) checked="checked" @endif>
                                                正常
                                            </label>
                                            <label>
                                                <input type="radio" name="arbitrary"  value="1" @if($sale->arbitrary) checked="checked" @endif>
                                                乱价
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_image" class="col-md-2 control-label">
                                            发票
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="image" id="page_image"  value="{{$sale->image}}">
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
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

            <div class="form-group">
                <img src="{{ URL::asset('/') }}{{$sale->image }}">
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
                        <form method="POST" action="{{ route('sale.destroy', $sale->id) }}">
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