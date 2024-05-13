<?php

use App\Models\User;

it('should validate email', function () {


  // Arrange  
  $password = 'hola1234';
  // - Create a user
  $user = User::factory()->create([
    'password' => $password
  ]);
  // - 

  // Assert
  $response = $this->postJson('/api/login', [
    'email' => $user->email,
    'password' => $password,
  ]);

  // Assert
  $response
  ->assertStatus(200)
  ->assertJsonStructure(['token'])
  ;
 

});
