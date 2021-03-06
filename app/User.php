<?php

namespace App;


use App\Models\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends=['avatar'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function createProduct(array $array)
    {
        $post = new Product($array);
        $this->products()->save($post);
        return $post;
    }

    public function avatar()
    {
        return 'https://aprendible.com/images/default-avatar.jpg';
    }

}
