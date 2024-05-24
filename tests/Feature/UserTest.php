<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_with_admin_role_is_admin()
{
    // Создаем пользователя с ролью 'admin'
    $user = User::factory()->create(['role' => 'admin']);

    // Проверяем, что поле role у пользователя равно 'admin'
    $this->assertEquals('admin', $user->role);
}
}
