<?php

//use Zizaco\Confide\ConfideUser;

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use App\Models\Role;

class User extends Authenticatable{


	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 /*   protected $fillable = [
        'name', 'email', 'password',
    ];
*/
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
/*    protected $hidden = [
        'password', 'remember_token',
    ];*/

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

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
	
	public function profile()
    {
        return $this->hasOne('UserProfile');
    }

    /**
     * Get the roles a user has
     */
    public function roles()
    {
      
        return $this->belongsToMany('App\Models\Role', 'users_roles');
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function hasRole($check)
    {
        return in_array($check,array_pluck($this->roles->toArray(), 'name'));
    }

    /**
     * Add roles to user to make them a concierge
     */
    public function addRole($name)
    {
        $role_id = Role::getRoleByName($name);
        $this->roles()->attach($role_id);
    }
}