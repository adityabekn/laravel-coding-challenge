<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use http\Env\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function getAll(): Collection
    {
        return User::all()->sortBy('id');
    }

    public function getUser($id) {
        return User::findOrFail($id);
    }

    public function insertUser($name, $password) {
        return User::create([
            "name" => $name,
            "password" => Hash::make($password),
        ]);
    }

    public function updateUser($id, $request) {
        $updateUser = $this->getUser($id);
        $updateUser->name = $request->name;
        $updateUser->password = Hash::make($request->password);
        return $updateUser->save();
    }

    public function deleteUser($id) {
        $deleteUser = $this->getUser($id);
        return $deleteUser->delete();
    }
}
