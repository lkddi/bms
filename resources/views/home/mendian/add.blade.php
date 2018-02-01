@extends('layouts.app')

@section('content')
    @include('home.error')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">门店管理 <small>» 新增</small></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('mendian.store') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">
                                            门店
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="model" autofocus id="title" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-md-2 control-label">
                                            简称
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="jmodel" id="subtitle" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-md-2 control-label">
                                            渠道
                                        </label>
                                        <div class="col-md-8">
                                            <select name="qudao_id"  class="form-control" multiple>
                                                @foreach ($qudaos as $tag)
                                                    <option  value="{{ $tag->id }}">
                                                        {{ $tag->qdname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_image" class="col-md-2 control-label">
                                            区域
                                        </label>
                                        <div class="col-md-8">
                                            <select name="quyu_id"  class="form-control" multiple>
                                                @foreach ($quyus as $quyu)
                                                    <option  value="{{ $quyu->id }}">
                                                        {{ $quyu->qyname }}
                                                    </option>
                                                @endforeach
                                            </select>
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

                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>



@stop
