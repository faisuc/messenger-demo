<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'BoopNoodle->boop(1)';
        $admins = [
            ['admin@test.com', 'Richard', 'Tippin'],
            ['admin2@test.com', 'Andre', 'Nozari'],
            ['admin3@test.com', 'Bala', 'Patel']
        ];
        foreach ($admins as $admin){
            $user = User::create([
                'email' => $admin[0],
                'firstName' => $admin[1],
                'lastName' => $admin[2],
                'active' => 1,
                'password' => Hash::make($password)
            ]);
            factory(App\Models\User\UserInfo::class)->create([
                'user_id' => $user->id,
                'slug' => $user->lastName.'-'.Str::random(4).'-'.Carbon::now()->timestamp,
                'picture' => null
            ]);
            $user->messenger()->create([
                'owner_id' => $user->id,
                'owner_type' => 'App\User'
            ]);
        }

        factory(App\User::class, 10)->create()->each(function ($user){
            factory(App\Models\User\UserInfo::class)->create([
                'user_id' => $user->id,
                'slug' => $user->lastName.'-'.Str::random(4).'-'.Carbon::now()->timestamp
            ]);
            $user->messenger()->create([
                'owner_id' => $user->id,
                'owner_type' => 'App\User'
            ]);
        });
    }
}
