<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void 
    {
        parent::setUp();

        //ユーザー作成
        $this->user = factory(User::class)->create();
    }
    /**
     * @test
     */
    public function ログイン画面が開ける() 
    {
         $this->get('login')
              ->assertOk();
    }

    /**
     * @test
     */
    public function ログイン入力チェック() 
    {
        $url = 'login';
        $this->from($url)->post($url,[])
        ->assertRedirect($url);
        
        $this->from($url)->post($url, ['email' => ''])->assertRedirect($url);
        $this->from($url)->post($url, ['email' => 'test@test@'])->assertRedirect($url);
        $this->from($url)->post($url, ['password' => ''])->assertRedirect($url);
    }

    /**
     * @test
     */
     

    public function 登録済みのユーザーを認証して返却する()
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     */
    public function ログインIDが間違っている() 
    {
        $postData = [
            'email' => 'aaa@bbb.com',
            'password' => 'password'
        ];

        $dbData = [
            'email' => 'bbb@ccc.com',
            'password' => 'password'
        ];

        $user = factory(User::class)->create($dbData);
        $url = 'login';

        $this->from($url)->post($url,$postData)
            ->assertRedirect($url);
    }

    /**
     * @test
     */
    public function ログアウトの確認() {
        $this->withoutExceptionHandling();
        $this->login();
        $this->get('logout');
        $this->assertGuest();
    }
}
