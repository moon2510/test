@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li>Users Manager</li>
            <li class="active">List Users</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List Users</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form action="{{ route('User.Search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control input-md" name="key" placeholder="Search for..." />
                            <span class="input-group-btn"><button type="submit" class="btn btn-primary btn-md" >Search</button></span>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Độc Giả</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Chức Vụ</th>
                                <th>Gia hạn</th>
                                <th>Chi tiết/Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users->count() < 1)
                            <tr>
                                <td colspan="7">Không có thành viên nào</td>
                            </tr>
                            @endif
                            @foreach($users as $user)
                            <tr data-row="{{$user->id}}">
                                <td>{{$user->id}}</td>
                                <td><a href="{{route('Order.User', $user->id)}}">{{$user->firstname}} {{$user->lastname}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->roles == 1 ? 'Quản lý' : 'Thành viên'}}</td>
                                <td><a href="javascript:void(0);" class="btn btn-sm btn-info update-expiry" data-id="{{$user->id}}">Gia hạn</a></td>
                                <td>
                                    <a href="{{ route('User.Show', $user->id) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger user-remove" data-id="{{$user->id}}">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <center>
                        {{ $users->links() }}
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