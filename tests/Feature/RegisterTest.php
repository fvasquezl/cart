<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
  /** @test **/
  public function users_can_register_as_client()
  {
      $this->withoutExceptionHandling();
      // 1.Given
      $this->get(route('register'))->assertSuccessful();
      // 2.When
      $response = $this->post(route('register'),$this->userValidData());
      $response->assertRedirect('/');
      // 3.Then
      $this->assertDatabaseHas('users',[
          'name' => 'fvasquez',
          'first_name' => 'Faustino',
          'last_name' => 'Vasquez',
          'role' =>'client'
      ]);

      $this->assertTrue(
          Hash::check('secret', User::first()->password) , 'The password must be encrypted'
      );
  }


  /** @test **/
  public function the_name_is_required()
  {
      $this->post(
          route('register'),$this->userValidData(['name'=>null])
          )->assertSessionHasErrors('name');
  }
  /** @test **/
  public function the_name_must_be_an_string()
  {
      $this->post(
          route('register'),$this->userValidData(['name'=>1234])
      )->assertSessionHasErrors('name');
  }

  /** @test **/
  public function the_name_may_not_longer_than_50_characters()
  {
      $this->post(
          route('register'),$this->userValidData(['name'=>str_random(51)])
      )->assertSessionHasErrors('name');
  }

  /** @test **/
  public function the_name_must_be_unique()
  {
      factory(User::class)->create(['name'=>'fvasquez']);
      $this->post(
          route('register'),$this->userValidData(['name'=>'fvasquez'])
      )->assertSessionHasErrors('name');
  }

  /** @test **/
  public function the_name_may_only_content_letters_and_numbers()
  {
      $this->post(
          route('register'),$this->userValidData(['name'=>'Faustino Vasquez'])
      )->assertSessionHasErrors('name');
      $this->post(
          route('register'),$this->userValidData(['name'=>'FaustinoVasquez??'])
      )->assertSessionHasErrors('name');
  }
  /** @test **/
  public function the_name_must_be_at_least_3_characters()
  {
      $this->post(
          route('register'),$this->userValidData(['name'=>'Fa'])
      )->assertSessionHasErrors('name');
  }

    /**
     * Test For First Name
     */
    /** @test **/
    public function the_first_name_is_required()
    {
        $this->post(
            route('register'),$this->userValidData(['first_name'=>null])
        )->assertSessionHasErrors('first_name');
    }
    /** @test **/
    public function the_first_name_must_be_an_string()
    {
        $this->post(
            route('register'),$this->userValidData(['first_name'=>1234])
        )->assertSessionHasErrors('first_name');
    }

    /** @test **/
    public function the_first_name_may_not_longer_than_50_characters()
    {
        $this->post(
            route('register'),$this->userValidData(['first_name'=>str_random(51)])
        )->assertSessionHasErrors('first_name');
    }

    /** @test **/
    public function the_first_name_may_only_content_letters()
    {
        $this->post(
            route('register'),$this->userValidData(['first_name'=>'Faustino3'])
        )->assertSessionHasErrors('first_name');
        $this->post(
            route('register'),$this->userValidData(['first_name'=>'Faustino??'])
        )->assertSessionHasErrors('first_name');
    }

    /** @test **/
    public function the_first_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),$this->userValidData(['first_name'=>'Fa'])
        )->assertSessionHasErrors('first_name');
    }

    /**
     * Test For Last Name
     */

    /** @test **/
    public function the_last_name_is_required()
    {
        $this->post(
            route('register'),$this->userValidData(['last_name'=>null])
        )->assertSessionHasErrors('last_name');
    }
    /** @test **/
    public function the_last_name_must_be_an_string()
    {
        $this->post(
            route('register'),$this->userValidData(['last_name'=>1234])
        )->assertSessionHasErrors('last_name');
    }

    /** @test **/
    public function the_last_name_may_not_longer_than_50_characters()
    {
        $this->post(
            route('register'),$this->userValidData(['last_name'=>str_random(51)])
        )->assertSessionHasErrors('last_name');
    }

    /** @test **/
    public function the_last_name_may_only_content_letters()
    {
        $this->post(
            route('register'),$this->userValidData(['last_name'=>'Vasquez3'])
        )->assertSessionHasErrors('last_name');
        $this->post(
            route('register'),$this->userValidData(['last_name'=>'Vasquez??'])
        )->assertSessionHasErrors('last_name');
    }

    /** @test **/
    public function the_last_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),$this->userValidData(['last_name'=>'Va'])
        )->assertSessionHasErrors('last_name');
    }


    /**
     * Test For Email
     */

    /** @test **/
    public function the_email_is_required()
    {
        $this->post(
            route('register'),$this->userValidData(['email'=>null])
        )->assertSessionHasErrors('email');
    }

    /** @test **/
    public function the_email_must_be_a_valid_email_address()
    {
        $this->post(
            route('register'),$this->userValidData(['email'=>'invalid@email'])
        )->assertSessionHasErrors('email');
    }

    /** @test **/
    public function the_email_must_be_unique()
    {
        factory(User::class)->create(['email' => 'fvasquez@local.com']);

        $this->post(
            route('register'),$this->userValidData(['email'=> 'fvasquez@local.com'])
        )->assertSessionHasErrors('email');
    }

    /**
     * Test For Password
     */

    /** @test **/
    public function the_password_is_required()
    {
        $this->post(
            route('register'),$this->userValidData(['password'=>null])
        )->assertSessionHasErrors('password');
    }

    /** @test **/
    public function the_password_must_be_an_string()
    {
        $this->post(
            route('register'),$this->userValidData(['password'=>1234])
        )->assertSessionHasErrors('password');
    }

    /** @test **/
    public function the_password_must_be_at_least_6_characters()
    {
        $this->post(
            route('register'),$this->userValidData(['password'=>'12345'])
        )->assertSessionHasErrors('password');
    }

    /** @test **/
    public function the_password_must_be_confirmed()
    {
        $this->post(
            route('register'),
            $this->userValidData([
                'password'=>'secret',
                'password_confirmation'=>null])
        )->assertSessionHasErrors('password');
    }

    /**
     * @param array $overrides
     * @return array
     */
  protected function userValidData($overrides=[]): array
  {
      return array_merge([
            'name' => 'fvasquez',
            'first_name' => 'Faustino',
            'last_name' => 'Vasquez',
            'email' => 'fvasquez@local.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ],$overrides);
  }

}
