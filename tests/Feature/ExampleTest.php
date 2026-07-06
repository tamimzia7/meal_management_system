<?php

test('guest is redirected to login', function () {
    $response = $this->get('/');

    $response->assertRedirect('/login');
});

test('login page loads successfully', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('authenticated user can access dashboard', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
});
