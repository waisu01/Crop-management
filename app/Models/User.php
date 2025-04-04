<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

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
        'email',
        'password',
        'role',
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
        'password' => 'hashed',
    ];

    // 自動タイムスタンプを無効化しない場合でも動作するようにカスタマイズ
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // 作成時にはcreated_atを設定し、updated_atを設定しない
            $model->created_at = now();
            $model->updated_at = null; // 初期値をnullにする場合（必要に応じて削除）
        });

        static::updating(function ($model) {
            // 更新時にupdated_atを設定
            $model->updated_at = now();
        });
    }
}