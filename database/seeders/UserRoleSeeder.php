<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\group_role;
use App\Models\user_role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$_result = group_role::selectRaw('id, `menuid`, `show`, `create`, `update`, `suspend`, `delete`, `status`, `showMenu`, now()')
            -> get();
        foreach($_result as $result){
            user_role::create([
            	'userid'        => 1,
            	'menuid'        => $result->menuid,
            	'show'          => $result->show,
            	'create'        => $result->create,
            	'update'        => $result->update,
            	'suspend'       => $result->suspend,
            	'delete'        => $result->delete,
            	'showMenu'      => $result->showMenu,
            	'status'        => $result->status,
            	'created_by'    => 1,
            	'created_at'    => now()
            ]);
        }
    }
}
