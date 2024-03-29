<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function getDecrypted($value){
        return Crypt::decryptString($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Crypt::encrypt($value);
    }

    public function getNameAttribute($value)
    {
        if (is_null($value)) {
            return $value;
        }
        return Crypt::decrypt($value);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = Crypt::encrypt($value);
    }

    public function getCpfAttribute($value)
    {
        if (is_null($value)) {
            return $value;
        }
        return Crypt::decrypt($value);
    }

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = Crypt::encrypt($value);
    }

    public function getNumberAttribute($value)
    {
        if (is_null($value)) {
            return $value;
        }
        return Crypt::decrypt($value);
    }

    const ADMIN = 0;
    const PERSONAL = 1;
    const CLIENT = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'number',
        'picture',
        'birth_date',
        'registration_date',
        'type', // 0 para admin, 1 para professor 2 para aluno
        'status' ,// 0 para pendente e 1 para ativo
        'streak',
        'streakDate',
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

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
