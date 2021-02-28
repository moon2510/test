@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin-home') }}">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Category Manager</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Category Manager</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            @if($errors->any())
            <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{$errors->first()}}</div>
            @endif
            @if(session('class'))
            <div class="alert bg-{{session('class')}}" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{session('message')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="category-add">
                        <div class="input-group">
                            <input type="text" class="form-control input-md" placeholder="Add new category" /><span class="input-group-btn"><button type="submit" class="btn btn-primary btn-md btn-add" >Add new</button></span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên danh mục</th>
                            </tr>
                        </thead>
                        <tbody class="category-content">
                            @foreach($categories as $category)
                            <tr data-row="{{$category->id}}">
                                <td>
                                    <span class="category-name">{{$category->name}}</span>
                                </td>
                                <td class="text-right">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary category-newname" data-id="{{$category->id}}">Chỉnh sửa</a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger category-remove" data-id="{{$category->id}}">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <center>
                        {{ $categories->links() }}
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
<script type="text/javascript" src="{{asset('admin_assets/js/main-app.js')}}"></script>
@endsection