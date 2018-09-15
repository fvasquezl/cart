<?php
/**
 * Created by PhpStorm.
 * User: fvasquez
 * Date: 12/09/18
 * Time: 03:17 PM
 */

namespace Tests;


use App\User;

trait TestHelper
{
    public function adminUser()
    {
        return factory(User::class)->create(['role' =>'admin']);
    }
    public function clientUser()
    {
        return factory(User::class)->create(['role' =>'client']);
    }
    public function guestUser()
    {
        return factory(User::class)->create(['role' =>'guest']);
    }
}