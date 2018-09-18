<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateRegisterTest extends TestCase
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
    public function the_register_fields_are_required()
    {
        $this->post(
            route('register'),$this->userValidData([
                'name' => null,
                'first_name' => null,
                'last_name' => null,
                'email' => null,
                'password' => null,
            ])
        )->assertSessionHasErrors(['name','first_name','last_name','email','password']);
    }

  /** @test **/
  public function the_register_fields_must_be_strings()
  {
      $this->post(
          route('register'),$this->userValidData([
              'name'=> 123456,
              'first_name' => 123456,
              'last_name' => 123456,
              'email' => 123456,
              'password' => 123456,
          ])
      )->assertSessionHasErrors(['name','first_name','last_name','email','password']);;
  }


    /** @test **/
  public function the_user_name_first_and_last_name_may_not_longer_than_50_characters()
    {
        $this->post(
            route('register'),$this->userValidData([
                'name'=>str_random(51),
                'first_name'=>str_random(51),
                'last_name'=>str_random(51),
            ])
        )->assertSessionHasErrors('name');
  }

  /** @test **/
  public function the_user_name_first_and_last_name_have_a_minimum_of_3_characters()
    {
        $this->post(
            route('register'),$this->userValidData([
            'name'=>'12',
            'first_name'=>'12',
            'last_name'=>'12',
        ])
        )->assertSessionHasErrors('name');
    }

    /** @test **/
    public function the_name_and_email_must_be_unique()
    {
        factory(User::class)->create(['name'=>'fvasquez', 'email' => 'fvasquez@local.com']);
        $this->post(
            route('register'),$this->userValidData(['name'=>'fvasquez','email' => 'fvasquez@local.com'])
        )->assertSessionHasErrors(['name','email']);
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
    public function the_first_name_and_last_name_must_contain_only_letters()
    {
        $this->post(
            route('register'),$this->userValidData([
                'first_name'=>'Faustino3',
                'last_name' => 'Vasquez07'
            ])
        )->assertSessionHasErrors(['first_name','last_name']);

        $this->post(
            route('register'),$this->userValidData([
            'first_name'=>'Faustino?',
            'last_name' => 'Vasquez@'
        ])
        )->assertSessionHasErrors(['first_name','last_name']);

    }


    /**
     * Test For Email
     */

    /** @test **/
    public function the_email_must_be_a_valid_email_address()
    {
        $this->post(
            route('register'),$this->userValidData(['email'=>'invalid@email'])
        )->assertSessionHasErrors('email');
    }

    /**
     * Test For Password
     */


    /** @test **/
    public function the_password_must_have_a_min_of_6_characters()
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
