<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $default_user_value=[
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            ];
            DB::beginTransaction();
            try {
                $review = User::create(array_merge([
                    'email' => 'review@gmail.com',
                    'name' =>'review',
                ], $default_user_value));

                $mahasiswa = User::create(array_merge([
                    'email' => 'mahasiswa@gmail.com',
                    'name' =>'mahasiswa',
                ], $default_user_value));

                $admin = User::create(array_merge([
                    'email' => 'admin@gmail.com',
                    'name' =>'admin',
                ], $default_user_value));

                $dospem = User::create(array_merge([
                    'email' => 'dospem@gmail.com',
                    'name' =>'dospem',
                ], $default_user_value));

                $role_review = Role::create(['name'=>'review']);
                $role_mahasiswa = Role::create(['name'=>'mahasiswa']);
                $role_admin = Role::create(['name'=>'admin']);
                $role_dospem = Role::create(['name'=>'dospem']);

                $permission= Permission::create(['name'=> 'read role']);
                $permission= Permission::create(['name' => 'create role']);
                $permission= Permission::create(['name' => 'update role']);
                $permission= Permission::create(['name' => 'delete role']);
                Permission::create(['name' => 'read konfigurasi']);

                $role_admin->givePermissionTo('read role');
                $role_admin->givePermissionTo('create role');
                $role_admin->givePermissionTo('update role');
                $role_admin->givePermissionTo('delete role');
                $role_admin->givePermissionTo('read konfigurasi');


                $review->assignRole('review');
                $review->assignRole('mahasiswa');
                $mahasiswa->assignRole('mahasiswa');
                $admin->assignRole('admin');
                $dospem->assignRole('dospem');

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }


    }
}
