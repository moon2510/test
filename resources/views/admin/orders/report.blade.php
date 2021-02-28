@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li>Order Manager</li>
            <li class="active">Report Order</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Report Order</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sách</th>
                                <th>Giá Thuê</th>
                                <th>Số Lượng</th>
                                <th>Tổng Tiền Thuê</th>
                                <th>Báo Mất</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($books->count() < 1)
                            <tr>
                                <td colspan="6">Không có sách nào</td>
                            </tr>
                            @endif
                            @foreach($books as $book)
                            <tr data-row="{{$book->id}}">
                                <td>{{$book->id}}</td>
                                <td>{{$book->book->name}}</a></td>
                                <td>{{number_format($book->book->price)}}</td>
                                <td>{{$book->quantity}} {{($book->lostbook->count() > 0) ? '(có '.$book->lostbook->count().' Sách Mất)' : ''}}</td>
                                <td>{{number_format($book->book->price * $book->quantity)}}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger order-report" data-id="{{$book->id}}">Báo mất</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <center>
                        {{ $books->links() }}
                    </center>
                </div>
            </div>
        </div><!--/.col-->

    </div><!--/.row-->
</div>  <!--/.main-->
@endsection
@section('javascript')
<script type="text/javascript">
    var api_domain = "{{ url('/admin') }}";
    var api_token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{ asset('admin_assets/js/main-app.js') }}"></script>
@endsection