<section class="container" id="settingsWrapper">
    <div class="row">
        <div class="col-md-3">
            <p>{{__('Login email')}}</p>
        </div>
        <div class="col-md-3">
            <p class="display">{{Auth::user()->email}}</p>
        </div>
        <div class="col">
            {{-- <div class="editButton" onclick="alert('To edit this row');">a</div> --}}
        </div>
        <div class="col">

        </div>
    </div>
    <form class="row" id="contactMailData" action="/profile/applySettings/email" method="POST">
        <div class="col-md-3">
            <p>{{__('Contact email')}}</p>
        </div>
        <div class="col-md-3" id="emailData">
            <input type="email" name="email" value="{{Auth::user()->email}}" class="hidden">
            <p class="display">{{Auth::user()->email}}</p>
        </div>
        <div class="col">
            <div class="editButton" onclick="window.showEmail(this)"></div>
            <input type="submit" value="{{__('Save')}}" class="hidden">
        </div>
        <div class="col">
            
        </div>
        {!! method_field('patch') !!}
        {!! csrf_field() !!}
    </form>
    <form class="row" action="/profile/applySettings/phoneNum" method="POST">
        <div class="col-md-3">
            <p>{{__('Telephone number')}}</p>
        </div>
        <div class="col-md-3" id="phoneData">
            <input type="text" name="phoneNumber" value="{{$userData[0]->phone}}" class="hidden">
            @if ($userData[0]->phone == "")
                <p class="display no-decoration">{{__('Not set.')}}</p>
            @else
                <p class="display no-decoration">{{$userData[0]->phone}}</p>
            @endif
        </div>
        <div class="col">
            <div class="editButton" onclick="window.showPhone(this)"></div>
            <input type="submit" value="{{__('Save')}}" class="hidden">
        </div>
        <div class="col">
            
        </div>
        {!! method_field('patch') !!}
        {!! csrf_field() !!}
    </form>
    <div class="row">
        <div class="col-md-3">
            <p>{{__('Your address')}}</p>
        </div>
        <div class="col-md-3">
            {{-- <input type="text" name="phoneNumber" value="+421 {{$userData[0]->phone}}" class="hidden"> --}}
            @if ($userData[0]->city == "" && $userData[0]->address == "" && $userData[0]->building == "")
                {{__('Not set.')}}
            @else
                <p class="display no-decoration">{{$userData[0]->city}}, {{$userData[0]->address}}, {{$userData[0]->building}}</p>
            @endif
        </div>
        {{-- <div class="col">
            <div class="editButton" onclick="alert('To edit this row');"></div>
        </div> --}}
        <div class="col">
            
        </div>
    </div>
    <form class="row" action="/profile/applySettings/password" method="POST">
        <div class="col-md-3">
            <p>{{__('Password')}}</p>
        </div>
        <div class="col-md-3" id="passwordData">
            <input type="password" name="password" value="{{$userData[0]->password}}" class="hidden">
            <input type="password" name="pass1" value="{{$userData[0]->password}}" disabled>
        </div>
        {{-- <div class="col">
            <input type="password" name="pass2" value="+421 902 907 965">
        </div> --}}
        <div class="col">
            <div class="editButton" onclick="window.showPassword(this)"></div>
            <input type="submit" value="{{__('Save')}}" class="hidden">
        </div>
        {!! method_field('patch') !!}
        {!! csrf_field() !!}
    </form>
</section>

<section class="container">
    <div class="row d-flex justify-content-center" id="dataButtons">
        <div class="col-lg-4 text-center">{{__('Send me my data')}}</div>
        <div class="col-lg-4 text-center">{{__('Close my account')}}</div>
    </div>
</section>