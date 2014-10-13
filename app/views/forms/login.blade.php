      @if (!Auth::check())
      {{ Form::open(array('route'=>'users.do_login', 'class'=>'form-signin')) }}

      <div class="form-group">
         {{ Form::label('username') }}
         {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
      </div>

      <div class="form-group">
         {{ Form::label('password') }}
         {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
          <small>
            {{ HTML::linkRoute('users.forgot_password', Lang::get('confide::confide.login.forgot_password')) }}
            </small>
      </div>
      <div class="checkbox">
         <label>
           <input type="hidden" name="remember" value="0">
           <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
          {{{ Lang::get('confide::confide.login.remember') }}}
        </label>
     </div>

     {{ Form::submit('Login', array('class'=>'btn btn-primary'))}}
     
     {{ Form::close() }}
     @else
     <h2>Logged in as {{ Auth::user()->username }}</h2>
     <p>{{ HTML::decode(HTML::linkRoute('users.logout', '<span class="btn btn-primary"><i class="fa fa-fw fa-sign-out"></i> Sign Out</span>')) }}</p>
     @endif