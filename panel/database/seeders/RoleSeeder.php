<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_assistant = Role::create(['name' => 'secretaria']);
        $role_system = Role::create(['name' => 'sistema']);

        $permission_create_user = Permission::create(['name'=>'create users']);
        $permission_read_user = Permission::create(['name'=>'read users']);
        $permission_update_user = Permission::create(['name'=>'update users']);
        $permission_delete_user = Permission::create(['name'=>'delete users']);

        $permission_create_role = Permission::create(['name'=>'create roles']);
        $permission_read_role = Permission::create(['name'=>'read roles']);
        $permission_update_role = Permission::create(['name'=>'update roles']);
        $permission_delete_role = Permission::create(['name'=>'delete roles']);

        $permission_create_client = Permission::create(['name'=>'create clients']);
        $permission_read_client = Permission::create(['name'=>'read clients']);
        $permission_update_client = Permission::create(['name'=>'update clients']);
        $permission_delete_client = Permission::create(['name'=>'delete clients']);

        $permission_create_provider = Permission::create(['name'=>'create providers']);
        $permission_read_provider = Permission::create(['name'=>'read providers']);
        $permission_update_provider = Permission::create(['name'=>'update providers']);
        $permission_delete_provider = Permission::create(['name'=>'delete providers']);

        $permission_create_bankAccount = Permission::create(['name'=>'create bank_Accounts']);
        $permission_read_bankAccount = Permission::create(['name'=>'read bank_Accounts']);
        $permission_update_bankAccount = Permission::create(['name'=>'update bank_Accounts']);
        $permission_delete_bankAccount = Permission::create(['name'=>'delete bank_Accounts']);

        $permission_create_typeMove = Permission::create(['name'=>'create type_Moves']);
        $permission_read_typeMove = Permission::create(['name'=>'read type_Moves']);
        $permission_update_typeMove = Permission::create(['name'=>'update type_Moves']);
        $permission_delete_typeMove = Permission::create(['name'=>'delete type_Moves']);

        $permission_create_move = Permission::create(['name'=>'create moves']);
        $permission_read_move = Permission::create(['name'=>'read moves']);
        $permission_update_move = Permission::create(['name'=>'update moves']);
        $permission_delete_move = Permission::create(['name'=>'delete moves']);

        $permission_create_sp_element = Permission::create(['name'=>'create sp_elements']);
        $permission_read_sp_element = Permission::create(['name'=>'read sp_elements']);
        $permission_update_sp_element = Permission::create(['name'=>'update sp_elements']);
        $permission_delete_sp_element = Permission::create(['name'=>'delete sp_elements']);

        $permissions_admin = [
            $permission_create_user,
            $permission_read_user,
            $permission_update_user,
            $permission_delete_user,
            $permission_create_role,
            $permission_read_role,
            $permission_update_role,
            $permission_delete_role,
            $permission_create_client,
            $permission_read_client,
            $permission_update_client,
            $permission_delete_client,
            $permission_create_provider,
            $permission_read_provider,
            $permission_update_provider,
            $permission_delete_provider,
            $permission_create_bankAccount,
            $permission_read_bankAccount,
            $permission_update_bankAccount,
            $permission_delete_bankAccount,
            $permission_create_typeMove,
            $permission_read_typeMove,
            $permission_update_typeMove,
            $permission_delete_typeMove,
            $permission_create_move,
            $permission_read_move,
            $permission_update_move,
            $permission_delete_move,
            $permission_create_sp_element,
            $permission_read_sp_element,
            $permission_update_sp_element,
            $permission_delete_sp_element,
        ];

        $permissions_assistant = [
            $permission_read_user,
            $permission_update_user,
            $permission_create_client,
            $permission_read_client,
            $permission_update_client,
            $permission_delete_client,
            $permission_create_provider,
            $permission_read_provider,
            $permission_update_provider,
            $permission_delete_provider,
            $permission_create_bankAccount,
            $permission_read_bankAccount,
            $permission_update_bankAccount,
            $permission_delete_bankAccount,
            $permission_create_typeMove,
            $permission_read_typeMove,
            $permission_update_typeMove,
            $permission_delete_typeMove,
            $permission_create_move,
            $permission_read_move,
            $permission_update_move,
            $permission_delete_move,
            $permission_create_sp_element,
            $permission_read_sp_element,
            $permission_update_sp_element,
            $permission_delete_sp_element,
        ];

        $role_admin->syncPermissions($permissions_admin);
        $role_system->syncPermissions($permissions_admin);
        $role_assistant->syncPermissions($permissions_assistant);

        // $role_admin->givePermissionTo($permission_create_client);
    } 
}
