

<div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">{{__('trans.DWAM')}}</div>
                   <div class="card-body">
                    @if (session('resent'))
                         <div class="alert alert-success" role="alert">
                            {{ __('trans.A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <a href="{{url()}}/admin/reset_password/{{$token}}">Click Here</a>.
                </div>
            </div>
        </div>
    </div>
</div>
