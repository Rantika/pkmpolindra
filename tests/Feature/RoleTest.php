<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanShowRolePage()
    {
        $user =User::role('admin')->get()->random();
        $this->actingAs($user);
        $this->get('/roles')
        ->assertOk();
        // Sudaah Login yang bisa akses admin
    }
    public function testCannotShowRolePage()
    {
       $user = User::role('review')->get()->random();
       $this->actingAs($user)
       ->get('/roles')
       ->assertStatus(403);
    //    Sudah Login akses role tidak bisa untuk review
    }

    public function testCannotShowRoleNotLogin()
        {
           $this->get('roles') 
           ->assertRedirect('login')
           ->assertStatus(302);
            // Belum login akese role tidak bisa
        }

    public function testCanCreateRole()
      {
        $user =User::role('admin')->get()->random();
        $this->actingAs($user);
        $this->get('/roles/create')
        ->assertOk();
        // Sudaah Login yang bisa akses role admin
      }  

      public function testCannotCreateRole()
      {
        $user =User::role('review')->get()->random();
        $this->actingAs($user);
        $this->get('/roles/create')
        ->assertStatus(403)
        ->assertSeeText('unauthorized.');
        // Tidak bisa login admin
      }  
    
      public function testCannotCreateRoleNotLogin()
      {
         $this->get('roles/create') 
         ->assertRedirect('login')
         ->assertStatus(302);
          // Belum login akese role tidak bisa
      }

}
