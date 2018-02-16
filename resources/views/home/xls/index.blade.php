@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        数据导出
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form class="form-horizontal" role="form" method="GET" action="{{ route('xls.create') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{--{{ method_field('PUT') }}--}}

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="title" class="col-md-2 control-label">
                                                月份
                                            </label>
                                            <div class="col-md-8">
                                                <label>
                                                    <input type="radio" name="arbitrary"  value="1" @if (date('m',time()) ==='02') checked="checked" @endif>
                                                    1月
                                                </label>
                                                <label>
                                                    <input type="radio" name="arbitrary"  value="2" @if (date('m',time()) ==='03') checked="checked" @endif>
                                                    2月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="3" @if (date('m',time()) ==='04') checked="checked" @endif>
                                                    3月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="4" @if (date('m',time()) ==='05') checked="checked" @endif>
                                                    4月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="5" @if (date('m',time()) ==='06') checked="checked" @endif>
                                                    5月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="6" @if (date('m',time()) ==='07') checked="checked" @endif>
                                                    6月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="7" @if (date('m',time()) ==='08') checked="checked" @endif>
                                                    7月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="8" @if (date('m',time()) ==='09') checked="checked" @endif>
                                                    8月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="9" @if (date('m',time()) ==='10') checked="checked" @endif>
                                                    9月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="10" @if (date('m',time()) ==='11') checked="checked" @endif>
                                                    10月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="11" @if (date('m',time()) ==='12') checked="checked" @endif>
                                                    11月
                                                </label>
                                                <label><input type="radio" name="arbitrary"  value="12" @if (date('m',time()) ==='01') checked="checked" @endif>
                                                    12月
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle" class="col-md-2 control-label">
                                                区域
                                            </label>
                                            <div class="col-md-8">
                                                <select name="quyu_id"  class="form-control" >
                                                    <option value="0">所有区域</option>
                                                    @foreach ($quyus as $tag)
                                                        <option  value="{{ $tag->id }}">
                                                            {{ $tag->qyname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle" class="col-md-2 control-label">
                                                渠道
                                            </label>
                                            <div class="col-md-8">
                                                <select name="qudao_id"  class="form-control" >
                                                    <option value="0">所有渠道</option>
                                                @foreach ($qudaos as $tag)
                                                        <option  value="{{ $tag->id }}">
                                                            {{ $tag->qdname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle" class="col-md-2 control-label">
                                                门店
                                            </label>
                                            <div class="col-md-8">
                                                <select name="mendian_id"  class="form-control" >
                                                    <option value="0">所有门店</option>
                                                @foreach ($mendians as $tag)
                                                        <option  value="{{ $tag->id }}">
                                                            {{ $tag->mdname }}
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
                                                导出
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

