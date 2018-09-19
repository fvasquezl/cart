<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_users_can_register()
    {
      $this->browse(function(Browser $browser){
        $browser->visit(route('register'))
            ->type('name','fvasquez')
            ->type('first_name','Faustino')
            ->type('last_name','Vasquez')
            ->type('email','fvasquez@local.com')
            ->type('password','secret')
            ->type('password_confirmation','secret')
            ->press('@register-btn')
            ->assertPathIs('/')
            ->assertAuthenticated();
      });
    }


    /**
     * @test
     * @throws \Throwable
     */
    public function get_errors_if_not_fill_the_register()
    {
        $this->browse(function(Browser $browser){
           $browser->visit(route('register'))
                ->press('@register-btn')
                ->assertPathIs('/register')
                ->assertSeeErrors([
                    'The name field is required.',
                    'The first name field is required.'
                ]);
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function a_registered_user_can_login()
    {
        factory(User::class)->create(['email'=>'admin@local.com']);

        $this->browse(function (Browser $browser){
            $browser->visit(route('login'))
                ->type('email','admin@local.com')
                ->type('password','secret')
                ->press('@login-btn')
                ->assertPathIs('/')
                ->assertAuthenticated();
        });
    }
}
