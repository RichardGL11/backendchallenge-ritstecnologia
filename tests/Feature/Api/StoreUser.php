<?php

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('should be able to create a new user', function () {

  $request =   postJson(route('createUser'),[
        'name' => 'joedoe',
        'email' => 'joedoe@gmail.com',
        'phone' =>  '1199999999',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $request->assertStatus(201);
    $request->assertSessionHasNoErrors();

    assertDatabaseCount(\App\Models\User::class, 1);
    assertDatabaseHas(\App\Models\User::class, [
        'name' => 'joedoe',
        'email' => 'joedoe@gmail.com',
        'phone' =>  '1199999999',

    ]);
});

describe('validation tests', function () {

    test('name', function ($rule,$value){
        $request =   postJson(route('createUser'),[
            'name' => $value,
            'email' => 'joedoe@gmail.com',
            'phone' =>  '1199999999',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $request->assertJsonValidationErrors(['name'=> $rule]);

    })->with([
        'required' => ['The name field is required.', ''],
        'min'     => ['The name field must be at least 3 characters.', 'aa'],
        'max'     => ['The name field must not be greater than 255 characters.', str_repeat('a',256)],
    ]);
    test('email', function ($rule,$value){
        \App\Models\User::factory()->create(['email' => "joe@doe.com"]);
        $request =   postJson(route('createUser'),[
            'name' => 'ahahahhah',
            'email' => $value,
            'phone' =>  '1199999999',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $request->assertJsonValidationErrors(['email'=> $rule]);

    })->with([
        'required' => ['The email field is required.', ''],
        'unique'   => ['The email has already been taken.', 'joe@doe.com'],
        'max'      => ['The email field must not be greater than 255 characters.', str_repeat('@',256)],
        'email'    => ['The email field must be a valid email address.', 'ahahahahah'],
    ]);

    test('phone', function ($rule,$value){
        $request =   postJson(route('createUser'),[
            'name' => 'ahahahhah',
            'email' => "joedoe@gmail.com",
            'phone' =>  $value,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $request->assertJsonValidationErrors(['phone'=> $rule]);

    })->with([
        'required' => ['The phone field is required.', ''],
        'numeric'    => ['The phone field must be a number.', 'ahahahahah'],
    ]);
    test('password', function ($rule,$value){
        $request =   postJson(route('createUser'),[
            'name' => 'ahahahhah',
            'email' => "joedoe@gmail.com",
            'phone' =>  '11111111111',
            'password' => $value,
            'password_confirmation' => 'password',
        ]);

        $request->assertJsonValidationErrors(['password'=> $rule]);

    })->with([
        'required'          => ['The password field is required.', ''],
        'min'               => ['The password field must be at least 8 characters.', 'aaa'],
        'confirmation'      => ['The password field confirmation does not match.', 'aaa'],
    ]);

});
