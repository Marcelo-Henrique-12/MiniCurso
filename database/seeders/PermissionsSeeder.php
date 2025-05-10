<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpar cache das permissões
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões
        $permissions = [
            'acessar painel admin',
            'gerenciar produtos',
            'ver produtos'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Criar ou atualizar os papéis
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Atribuir permissões aos papéis
        $adminRole->givePermissionTo(Permission::all());

        $userRole->givePermissionTo('ver produtos');

        // Atribuir papéis aos usuários de exemplo
        $admin = User::firstOrCreate(['email' => 'admin@teste.com'], [
            'name' => 'Administrador',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');

        $cliente = User::firstOrCreate(['email' => 'cliente@teste.com'], [
            'name' => 'Cliente',
            'password' => bcrypt('12345678')
        ]);
        $cliente->assignRole('user');
    }
}
