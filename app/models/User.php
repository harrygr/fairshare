<?php

use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	// public static $rules = array(
 //   'username'=>'unique:required|alpha|min:2',
 //   'email'=>'required|email|unique:users',
 //   'password'=>'required|alpha_num|between:6,50|confirmed',
 //   'password_confirmation'=>'required|alpha_num|between:6,50'
 //   );
	public static $rules = array(
		'username' => 'required|unique:users,username',
		'email'    => 'required|email',
		'password' => 'required|between:4,60|confirmed',
		);

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public function payers(){
		return $this->hasMany('Payer');
	} 
	


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}