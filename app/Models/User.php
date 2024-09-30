<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     /*
     Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('is_admin')->default(0);  //1 main admin account
            $table->tinyInteger('user_type')->default(1);  //1 for admin and 2 for deealer user
            $table->tinyInteger('active')->default(1);  //1 for active and 0 inactive
            $table->string('phone', 45)->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        */

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'user_type',
        'active',
        'phone',
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

    protected $appends = [
        'full_name',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'bool',
            'is_admin' => 'bool'
        ];
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%');

            });
        });
    }

    public function isMainAdmin() : bool
    {
        return $this->is_admin ? true : false;
    }

    public function isAdminUser() : bool
    {
        return $this->user_type == 1 ? true : false;

    }

    public function isTheDealer() : bool
    {
        return $this->user_type == 2 ? true : false;

    }
}