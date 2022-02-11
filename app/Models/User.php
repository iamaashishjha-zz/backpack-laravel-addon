<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Spatie\Permission\Traits\HasRoles as HasRoles;

use Spatie\Permission\Traits\HasRoles;

// use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Backpack\CRUD\app\Models\Traits\CrudTrait;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;
use Shankhadev\Bsdate\BsdateController;
use Shankhadev\Bsdate\BsdateFacade;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // use CrudTrait;

    use CrudTrait;

    use HasRoles;


    // protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogTags()
    {
        return $this->hasMany(BlogTag::class);
    }

    public function blogCategories()
    {
        return $this->hasMany(BlogCategory::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
