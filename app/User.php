<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','company_id','department_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsers()
    {
        $result = User::where('users.approved','<>', 2)
            ->where('users.role','<>', 1)
            ->leftjoin('companies', 'users.company_id', '=', 'companies.id')
            ->select('users.id','users.name','users.email','users.role','users.company_id','users.department_id','users.change_password','users.approved','users.approved_by','companies.company_name','companies.group_company')
            ->orderby('users.approved','asc')
            ->get();
        for($i = 0; $i < count($result); $i++){
            if(isset($result[$i]['department_id']) && $result[$i]['department_id'] != ''){
                $dept_id = explode(',',$result[$i]['department_id']);
                $d = Department::whereIn('id',$dept_id)->select(DB::raw('group_concat(department_name) as department_name'))->first();
                $result[$i]->department_name = str_replace(",",", ",$d->department_name);
            }
        }
        return $result;
    }
}
