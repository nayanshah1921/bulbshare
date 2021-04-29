<div>
    @if(session()->has('success_message'))
        <div class="alert alert-success alert-dismissible m-sm-2">{{session()->get('success_message')}}</div>
    @elseif(session()->has('error_message'))
        <div class="alert alert-danger alert-dismissible m-sm-2">{{session()->get('error_message')}}</div>
    @endif
</div>