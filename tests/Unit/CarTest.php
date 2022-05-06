<?php

namespace Tests\Unit;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CarTest extends TestCase
{
    /**
     * Проверка, может ли администратор заносить записи в список
     *
     * @return void
     */
    public function test_admin_can_manage_car()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['editCars', 'seeCarInfo']
        );
        $admin = User::find(1);
        $response = $this->json('POST', '/api/user/1/car/2');
        $response
            ->assertStatus(200);
    }

    /**
     * Проверка, может ли администратор отвязать машину от пользователя
     *
     * @return void
     */
    public function test_admin_can_detach_car()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['editCars', 'seeCarInfo']
        );
        $admin = User::find(1);
        $admin->car()->dissociate();
        $admin->car()->associate(2);
        $response = $this->json('DELETE', '/api/user/1/car/2');
        $response
            ->assertStatus(200);
    }

    /**
     * Проверка получения машины опредленного пользователя (админом)
     *
     * @return void
     */
    public function test_admin_can_view_users_car()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['editCars', 'seeCarInfo']
        );
        $response = $this->json('GET', '/api/user/1/car');
        $response
            ->assertStatus(200);
    }

    /**
     * Проверка, запрещено ли пользователю заносить данные в список
     *
     * @return void
     */
    public function test_user_cannot_manage_car()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['seeCarInfo']
        );
        $response = $this->json('POST', '/api/user/1/car/2');
        $response
            ->assertStatus(403);
    }

    /**
     * Проверка, запрещено ли пользователю заносить данные в список
     *
     * @return void
     */
    public function test_user_can_see_other_user_car()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['seeCarInfo']
        );
        $response = $this->json('GET', '/api/user/2/car');
        $response
            ->assertStatus(200);
    }
}
