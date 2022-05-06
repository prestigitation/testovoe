<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get the user`s car
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function showCar(int $userId) {
        try {
            return $this->userService->showCar($userId);
        } catch(\Exception $e) {
            return new JsonResponse(['message' => 'Не удалось получить автомобиль пользователя'], 400);
        }
    }

    /**
     * Detach the user`s car
     *
     * @param int $userId
     * @param int $carId
     * @return \Illuminate\Http\Response
     */
    public function detachCar(int $userId, int $carId) {
        try {
            return $this->userService->detachCar($userId, $carId);
        } catch(\Exception $e) {
            return new JsonResponse(['message' => 'Не удалось отвязать автомобиль пользователя. Возможно, у него нет данного автомобиля'], 400);
        }
    }

    /**
     * Edit the user`s car
     *
     * @param int $userId
     * @param int $carId
     * @return \Illuminate\Http\Response
     */
    public function editCar(int $userId, int $carId) {
        try {
            return $this->userService->editCar($userId, $carId);
        } catch(\Exception $e) {
            return new JsonResponse(['message' => 'Не удалось отредактировать/привязать автомобиль пользователя'], 400);
        }
    }

    public function login(LoginRequest $request) {
        try {
            return $this->userService->login($request->validated());
        } catch(\Exception $e) {
            return new JsonResponse(['message' => 'Не удалось войти. Проверьте учетные данные'], 401);
        }
    }
}
