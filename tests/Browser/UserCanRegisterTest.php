<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @test
     * @throws \Throwable
     */
    public function user_can_register()
    {
      $this->browse(function(Browser $browser){
        $browser->visit('register')
            ->type('first_name','Faustino')
            ->type('last_name','Vasquez')
            ->type('name','fvasquez')
            ->type('email','fvasquez@local.com')
            ->type('password','secret')
            ->type('password_confirmation','secret')
            ->assertPathIs('/')
            ->assertAuthenticated();
      });
    }
}
