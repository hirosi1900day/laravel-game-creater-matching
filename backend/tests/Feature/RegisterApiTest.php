<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function ユーザー登録画面を開く()
    {
        $response = $this->get('signup');
        $response->assertOk();
    }
     /**
     * @test
     */
    
    public function 新しいユーザーを作成して返却する() 
    {
        //データの作成
        $data = [
            'name' => 'vuesplash user',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];
        
        $this->post('signup',$data);

        unset($data['password'],$data[ 'password_confirmation']);
        
        $this->assertDatabaseHas('users',$data);

        //パスワードの検証
        $user = User::firstWhere($data);
        $this->assertTrue(\Hash::check('test1234',$user->password));

    }
}
