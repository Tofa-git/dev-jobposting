<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\backend_menu;
use App\Models\group_role;

class GroupRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $_result = backend_menu::selectRaw('id, `show`, `create`, `update`, `suspend`, `delete`, showMenu, `status`, 1, now()')
    		-> get();
    	foreach($_result as $result){
    		group_role::create([
    			'userid'		=> 1,
    			'menuid'		=> $result->id,
    			'show'			=> $result->show,
    			'create'		=> $result->create,
    			'update'		=> $result->update,
    			'suspend'		=> $result->suspend,
    			'delete'		=> $result->delete,
    			'showMenu'      => $result->showMenu,
    			'status'		=> $result->status,
    			'created_by'    => 1,
        	]);
    	}
    }
}
