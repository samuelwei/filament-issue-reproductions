<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\HasName;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class User extends Authenticatable implements HasName, HasLocalePreference, MustVerifyEmail
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
        'firstname',
        'locale',
        'email',
        'password',
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
        ];
    }

    public function getFilamentName(): string
    {
        return "{$this->firstname} {$this->name}";
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForMail(Notification $notification): array|string
    {
        // Return email address only...
        //return $this->email_address;

        // Return email address and full name
        return [$this->email => $this->getFilamentName()];
    }

    /**
     * Get the user's preferred locale.
     */
    public function preferredLocale(): string
    {
        return $this->locale;
    }
}
