<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddCourseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function a_course_can_be_added()
    {
        // Создаем пользователя с ролью администратора
        $admin = User::factory()->create(['role' => 'admin']);

        $CourseData = User::factory()->make()->toArray();

        $response = $this->actingAs($admin)->post(route('courses.create'), $CourseData);
        print_r(Course::all()->toArray());
        $response->assertRedirect(route('storeCourse'));
    }
}
