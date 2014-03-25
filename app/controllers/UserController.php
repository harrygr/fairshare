<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class UserController extends BaseController {

    /**
     * Displays the form for account creation
     *
     */
    public function create() {
        return View::make('users.register');
    }
    /**
     * Displays the form for account editing
     *
     */
    public function edit() {
        $user = Auth::user();
        return View::make('users.edit')
        ->with(compact('user'));
    }

    public function update(User $user){

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );

        if ( Input::get( 'password' ) !== '' ){
            $user->password = Input::get( 'password' );
        }
        if( $user->amend() ){
            return Redirect::route('users.dashboard')
            ->with( 'message', 'Profile Updated' )
            ->with('alert-class', 'alert-success');
        } else {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all(':message');

            return Redirect::action('UserController@edit')
            ->withInput(Input::except('password'))
            ->withErrors($error);
        }
        

    }

    /**
     * Stores new account
     *
     */
    public function store() {
        //$validator = Validator::make(Input::all(), User::$rules);

        $user = new User;

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get( 'password_confirmation' );

        // Save if valid. Password field will be hashed before save
        $user->save();

        if ( $user->id ) {

            $message = Lang::get('confide::confide.alerts.account_created') . ' ' . Lang::get('confide::confide.alerts.instructions_sent'); 

            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
            return Redirect::action('UserController@login')
            ->with( 'message', $message )
            ->with('alert-class', 'alert-success');
        } else {

            // Get validation errors (see Ardent package)
            $error = $user->errors()->all(':message');
            //$error = '<ul><li>' . implode('</li><li>', $error) . '</li></ul>';

            return Redirect::action('UserController@create')
            ->withInput(Input::except('password'))
            ->withErrors($error);


        }
    }

    /**
     * Displays the login form
     *
     */
    public function login()
    {
        if( Confide::user() ) {
            // If user is logged, redirect to internal 
            // page, change it to '/admin', '/dashboard' or something
            return Redirect::to('/');
        } else {
            return View::make('users.login');
            //return View::make(Config::get('confide::login_form'));
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function do_login()
    {
        $input = array(
            'email'    => Input::get( 'username' ), // May be the username too
            'username' => Input::get( 'username' ), // so we have to pass both
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
            );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Get the value from the config file instead of changing the controller
        if ( Confide::logAttempt( $input, Config::get('confide::signup_confirm') ) ) {
            // Redirect the user to the URL they were trying to access before
            // caught by the authentication filter IE Redirect::guest('user/login').
            // Otherwise fallback to '/'
            // Fix pull #145
            return Redirect::intended('/dashboard'); // change it to '/admin', '/dashboard' or something
        } else {
            $user = new User;

            // Check if there was too many login attempts
            if( Confide::isThrottled( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            }
            elseif( $user->checkUserExists( $input ) and ! $user->isConfirmed( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            }
            else
            {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UserController@login')
            ->withInput(Input::except('password'))
            ->with( 'message', $err_msg )
            ->with( 'alert-class', 'alert-danger' );
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function confirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UserController@login')
            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UserController@login')
            ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function forgot_password()
    {
        return View::make('users.forgot');
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function do_forgot_password() {
        if( Confide::forgotPassword( Input::get( 'email' ) ) ) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UserController@login')
            ->with( 'message', $notice_msg );
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UserController@forgot_password')
            ->withInput()
            ->with( 'error', $error_msg );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function reset_password( $token )
    {
        return View::make('users.reset')
        ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function do_reset_password()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
            );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UserController@login')
            ->with( 'message', $notice_msg )
            ->with('alert-class', 'alert-success');
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UserController@reset_password', array('token'=>$input['token']))
            ->withInput()
            ->with( 'error', $error_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function logout()
    {
        Confide::logout();
        
        return Redirect::to('/');
    }

    public function dashboard() {

        $payers = Auth::user()->payers()->lists('name', 'id');
        $totals = array();
        $settles = array();
        if ( count($payers) ){
            $totals = Payment::payer_summary(Auth::user()->id);
            $settles = Helper::settleUp($totals);
        }

        return View::make('users.dashboard')
        ->with(compact('totals'))
        ->with(compact('settles'))
        ->with(compact('payers'));
    }

}
