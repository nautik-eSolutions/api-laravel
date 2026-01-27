<?php

namespace App\Models\users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\boats\Boat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\persons\Person;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'user';


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
    ];




    public function persons():BelongsToMany
    {
        return $this->belongsToMany(Person::class,'user_person');
    }

}
