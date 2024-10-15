<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function secretSantaMakeAll():bool
    {
         User::whereDoesntHave('santa')->get()->each(function (User $user){
            $santa = $this->getRandomForSanta();
            $user->santaRelation()->firstOrCreate(
                ['secret_santa_id'=>$santa->id],
                ['secret_santa_id'=>$santa->id]
            );
        });

        return true;
    }

    public function getRandomForSanta():User
    {
        return User::whereDoesntHave('ward')->inRandomOrder()->first();
    }
}
