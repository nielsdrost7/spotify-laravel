<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = factory(App\Models\User::class, 25)->create();
        // foreach($users as $user)
        // {
        //     $team = factory(App\Team::class)->create(['owner_id' => $user->id]);
        //     $team->users()->attach($user, ['role' => 'owner']);
        //     $members =  factory(App\User::class, 5)->create();
        //     foreach($members as $member)
        //     {
        //         $team->users()->attach($member, ['role' => 'member']);
        //     }
        // }
    }
}
