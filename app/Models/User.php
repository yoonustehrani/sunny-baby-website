<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        // 'password',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'role_type' => UserRoleType::class
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function discount_usages()
    {
        return $this->hasMany(DiscountUsage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function credit_logs()
    {
        return $this->hasMany(UserCreditLog::class);
    }

    public function changeCredit(int $amount, ?Transaction $transaction = null): void
    {
        DB::transaction(function() use($amount, $transaction) {
            if ($amount > 0) {
                $this->increment('credit', $amount);
            } else {
                $this->decrement('credit', abs($amount));
            }
            $this->credit_logs()->save(new UserCreditLog([
                'amount' => $amount,
                'transaction_id' => $transaction?->getKey()
            ]));
        });
    }
}
