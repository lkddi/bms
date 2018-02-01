@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">欢迎登陆！！！</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    操作请点击上面导航，如有不懂请联系 董冬明!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
