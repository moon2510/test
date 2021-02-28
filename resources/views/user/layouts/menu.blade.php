 <div id="sidebar-collapse" class="sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            @if(Auth::user()->image == null)
            <img class="avatar" onclick="javascript:$('#myModal').modal('show');" src="{{ asset('images/default.png') }}" class="img-responsive" alt="">
            @else
            <img class="avatar" onclick="javascript:$('#myModal').modal('show');" src="{{ asset(Auth::user()->image) }}" class="img-responsive" alt="">
            @endif
            <div class="middlee">
                <button onclick="javascript:$('#avatarmodal').modal('show');" class="btn btn-success">Upload</button>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="avatarmodal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Upload avatar image</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <label>Choose your file image here</label>
                                <input type="file" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ Auth::user()->lastname ." ".Auth::user()->firstname}}</div>
            <div class="profile-usertitle-status"><i class="fa fa-circle"></i>Online</div>
        </div>

        <div class="clear"></div>
        @if(session('avaclass'))
        <div class="alert alert-{{session('avaclass')}}" style="margin-top: 10px">
            <li>{{session('message')}}</li>
        </div>
        @endif
    </div>
    <div>
        <div class="block-title">
            <strong><span>Account</span></strong>
        </div>
        <div class="block-content">
            <ul>
                <li class="{{Request::is('account') ? 'current' : ''}}"><a href="{{ route('account_profile') }}">Info Account</a></li>
                <li class="{{Request::is('account/edit') ? 'current' : ''}}"><a href="{{ route('account_edit') }}" >Edit Account</a></li>
                <li class="{{Request::is('account/napthe') ? 'current' : ''}}"><a href="{{ route('napthe') }}" >Nap The</a></li>
                <li class="{{Request::is('account/napthe/log') ? 'current' : ''}}"><a href="{{ route('napthe_log') }}" >Log Nap The</a></li>
            </ul>
        </div>
    </div>
    <div>
        <div class="block-title">
            <strong><span>Order Management</span></strong>
        </div>
        <div class="block-content">
            <ul>
                <li class="{{Request::is('account/order/wait') ? 'current' : ''}}"><a href="{{ route('order_wait') }}">Wait for confirmation</a></li>
                <li class="{{Request::is('account/order/confirmed') ? 'current' : ''}}"><a href="{{ route('order_confirm') }}">Confirmed</a></li>
                <li class="{{Request::is('account/order/borrow') ? 'current' : ''}}"><a href="{{ route('order_borrow') }}">Borrowing Books</a></li>
                <li class="{{Request::is('account/order/history') ? 'current' : ''}}"><a href="{{ route('order_history') }}">History</a></li>
            </ul>
        </div>
    </div>
</div>