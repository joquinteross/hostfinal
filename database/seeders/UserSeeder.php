<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user= User::create([
            'name' => 'Vanessa Restrepo',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $rol= Role::create(['name'=>'administrador']);
        $permisos = Permission::pluck('id','id')->all();
        $rol->syncPermissions($permisos);
        //$user = User::find(12);
        $user->assignrole('administrador');
        User::factory(10)->create();
    }
}
