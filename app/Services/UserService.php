<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService {
    public function showCar(int $userId) {
        return User::find($userId)->car;
    }

    public function detachCar(int $userId, int $carId) {
        $user = User::find($userId);
        if($user->car && $user->car->id === $carId) {
            $user->car()->dissociate($carId);
            $user->save();
        } else throw new \Exception('У пользователя нет данного автомобиля');
    }

    public function editCar(int $userId, int $carId) {
        $carInRelationExists = User::where('car_id', $carId)->get();
        if(!count($carInRelationExists)) {
            $user = User::find($userId);
            $user->car()->dissociate();
            $user->car()->associate($carId);
            $user->save();
        } else throw new \Exception('Данный автомобиль уже привязан');
    }

    public function login(array $credentials) {
        $user = User::where('email', $credentials['email'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $tokenAbilities = [];
        switch($user->role->name) {
            case 'Администратор':
                array_push($tokenAbilities, 'editCars', 'seeCarInfo');
            case 'Пользователь':
                array_push($tokenAbilities, 'seeCarInfo');
        }
        return $user->createToken('accessToken', $tokenAbilities)->plainTextToken;
    }
}
