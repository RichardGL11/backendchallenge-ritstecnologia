<?php

use App\Livewire\ListUsers;
use Livewire\Livewire;
use App\Models\User;


it('renders successfully', function () {
    Livewire::test(ListUsers::class)
        ->assertStatus(200);
});

it('should see all users', function () {
   $user = User::factory()->create();
   $users = User::factory(10)->create();

        $livewire = Livewire::actingAs($user)
            ->test(ListUsers::class);

        $users->each(function ($user) use ($livewire) {
            $livewire->assertSee($user->name);
            $livewire->assertSee($user->email);
            $livewire->assertSee($user->phone);
            $livewire->assertSee($user->created_at);
        });
});
