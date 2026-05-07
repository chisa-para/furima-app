<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Like;
use App\Models\ItemCategory;

class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_新規登録画面にて名前が未入力の場合「お名前を入力してください」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/register', [
            'user_name' => '', 
            'email' => 'test@example.com',
            'password' => 'Test1234',
            'password_confirmation' => 'Test1234',

        ]);

        $response->assertSessionHasErrors([
        'user_name' => 'お名前を入力してください'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_新規登録画面にてメールアドレスが未入力の場合「メールアドレスを入力してください」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/register', [
            'user_name' => 'テスト太郎', 
            'email' => '',
            'password' => 'Test1234',
            'password_confirmation' => 'Test1234',

        ]);

        $response->assertSessionHasErrors([
        'email' => 'メールアドレスを入力してください'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_新規登録画面にてパスワードが未入力の場合「パスワードを入力してください」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/register', [
            'user_name' => 'テスト太郎', 
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => '',

        ]);

        $response->assertSessionHasErrors([
        'password' => 'パスワードを入力してください'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_新規登録画面にてパスワードが7文字以下の場合「パスワードは8文字以上で入力してください」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/register', [
            'user_name' => 'テスト太郎', 
            'email' => 'test@example.com',
            'password' => 'Test123',
            'password_confirmation' => 'Test123',

        ]);

        $response->assertSessionHasErrors([
        'password' => 'パスワードは8文字以上で入力してください'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_新規登録画面にてパスワードが確認用パスワードと一致しない場合「パスワードと一致しません」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/register', [
            'user_name' => 'テスト太郎', 
            'email' => 'test@example.com',
            'password' => 'Test1234',
            'password_confirmation' => '1234Test',

        ]);

        $response->assertSessionHasErrors([
        'password_confirmation' => 'パスワードと一致しません'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_全ての項目が入力されている場合、会員情報が登録され、登録されたメールアドレスに確認メールが送信される()
    {
        Notification::fake();

        $response = $this->post('/register', [
            'user_name' => 'テスト太郎', 
            'email' => 'test@example.com',
            'password' => 'Test1234',
            'password_confirmation' => 'Test1234',

        ]);

        if ($response->status() !== 302) {
        $response->dump(); 
        }

        $response->assertStatus(200);
    
        $this->assertDatabaseHas('users', [
            'user_name' => 'テスト太郎', 
            'email' => 'test@example.com',
        ]);

        $user = User::where('email', 'test@example.com')->first();

        Notification::assertSentTo(
        $user,
        VerifyEmail::class
    );
    }

    public function test_メール認証誘導画面で「認証はこちらから」ボタンを押下するとメール認証サイトに遷移する()
    {
    
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect('/mypage/profile');
    
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function test_メール認証サイトのメール認証を完了すると、プロフィール設定画面に遷移する()
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($url);

        $this->assertNotNull($user->fresh()->email_verified_at);

        $response->assertRedirect('/mypage/profile');
    }

    public function test_ログイン画面にてメールアドレスが未入力の場合「メールアドレスを入力してください」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'Test1234',

        ]);

        $response->assertSessionHasErrors([
        'email' => 'メールアドレスを入力してください'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_ログイン画面にてパスワードが未入力の場合「パスワードを入力してください」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => '',

        ]);

        $response->assertSessionHasErrors([
        'password' => 'パスワードを入力してください'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_ログイン画面にて誤った情報を入力した場合「ログイン情報が登録されていません」というバリデーションメッセージが表示される()
    {
        $response = $this->post('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrong1234',
        ]);

        $response->assertSessionHasErrors([
        'email' => 'ログイン情報が登録されていません'
        ]);
    
        $response->assertStatus(302); 
    }

    public function test_ログイン画面にて正しい情報が入力された場合、ログイン処理が実行される()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('test1234'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'test1234',
        ]);

        $this->assertAuthenticatedAs($user);
    
        $response->assertRedirect('/');
    }

    public function test_ログアウト処理が実行される()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();

        $response->assertRedirect('/');
    }

    public function test_商品一覧画面にて全商品を取得できる()
    {
        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $condition = Condition::factory()->create();

        $item = Item::create([
            'item_image' => 'test.jpg',
            'item_name' => '出品した商品',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => $seller->id,
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
        ]);

        $this->assertDatabaseHas('items', $item->toArray());
    }

    public function test_商品一覧画面にて購入済み商品は「SOLD」と表示される()
    {
        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $buyer = User::factory()->create([
            'id' => '1',
        ]);

        $condition = Condition::factory()->create();

        $item = Item::create([
            'item_image' => 'test.jpg',
            'item_name' => '売却済みの商品',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => $seller->id,
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            'buyer_id' => $buyer->id,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SOLD');
    }

    public function test_商品一覧画面にて自分が出品した商品は表示されない()
    {
        
        $me = User::factory()->create([
            'id' => '1'
        ]);
        $someoneElse = User::factory()->create([
            'id' => '2'
        ]);

        $condition = Condition::factory()->create();

        $myProduct = Item::create([
            'item_image' => 'test.jpg',
            'item_name' => '私の出品物',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => $me->id,
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
        ]);

        $otherProduct = Item::create([
            'item_image' => 'test2.jpg',
            'item_name' => '他人の出品物',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => $someoneElse->id,
            'item_detail' => 'テスト用の商品２です',
            'condition_id' => '1',
        ]);

        $response = $this->actingAs($me)->get('/');

        $response->assertStatus(200);

        $response->assertSee('他人の出品物');

        $response->assertDontSee('私の出品物');
    }

    public function test_マイリスト一覧画面にていいねした商品だけが表示される()
    {
        $me = User::factory()->create([
            'id'=>'1'
        ]);

        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $condition = Condition::factory()->create();

        $likedItem = Item::create([
            'id'=>'1',
            'item_image' => 'test.jpg',
            'item_name' => 'お気に入り商品',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => $seller->id,
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            ]);

        $notLikedItem = Item::create([
            'id'=>'2',
            'item_image' => 'test2.jpg',
            'item_name' => 'お気に入りしていない商品',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => $seller->id,
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            ]);

        Like::create(['like_user_id' => $me->id, 'like_item_id' => $likedItem->id]);

        $this->actingAs($me)
             ->get(route('items', ['page' => 'mylist']))
             ->assertSee('お気に入り')
             ->assertDontSee('お気に入りしていない商品');
    }

    public function test_マイリスト一覧画面にて購入済み商品は「SOLD」と表示される()
    {
        $me = User::factory()->create([
            'id'=>'1'
        ]);

        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $buyer = User::factory()->create([
            'id' => '3',
        ]);

        $condition = Condition::factory()->create();

        $soldItem = Item::create([
            'id'=>'1',
            'item_image' => 'test.jpg',
            'item_name' => '売却済み商品',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => '2',
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            'buyer_id' => '3'
        ]);

        Like::create(['like_user_id' => $me->id, 'like_item_id' => $soldItem->id]);

        $this->actingAs($me)
             ->get(route('items', ['page' => 'mylist']))
             ->assertSee('売却済み商品','SOLD');
    }

    public function test_マイリスト一覧画面にて未認証の場合は何も表示されない()
    {
        $me = User::factory()->create([
            'id'=>'1'
        ]);

        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $condition = Condition::factory()->create();

        $likedItem = Item::create([
            'id'=>'1',
            'item_image' => 'test.jpg',
            'item_name' => 'お気に入り商品',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => '2',
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            ]);

        Like::create(['like_user_id' => $me->id, 'like_item_id' => $likedItem->id]);

        $this->get(route('items', ['page' => 'mylist']))
             ->assertDontSee('お気に入り商品');
    }

    public function test_商品検索機能にて「商品名」で部分一致検索ができる()
    {
        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $condition = Condition::factory()->create();

        $Item1 = Item::create([
            'id'=>'1',
            'item_image' => 'test.jpg',
            'item_name' => 'Laravel本',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => '2',
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            ]);
        
        $Item2 = Item::create([
            'id'=>'2',
            'item_image' => 'test.jpg',
            'item_name' => 'PHPの本',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => '2',
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            ]);

        $Item3 = Item::create([
            'id'=>'3',
            'item_image' => 'test.jpg',
            'item_name' => 'JavaScript',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => '2',
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
            ]);

        $response = $this->get(route('items', ['keyword' => '本']));

        $response->assertStatus(200);
        $response->assertSee('Laravel本');
        $response->assertSee('PHPの本');
        $response->assertDontSee('JavaScript');
    }

    public function test_商品検索機能にて検索状態がマイリストでも保持されている()
    {
        $user = User::factory()->create();
        $keyword = '検索ワード';
        
        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $condition = Condition::factory()->create();

        $Item1 = Item::create([
            'id'=>'1',
            'item_image' => 'test.jpg',
            'item_name' => 'Laravel本',
            'brand_name' => 'テスト工房',
            'item_price' => '500',
            'seller_id' => '2',
            'item_detail' => 'テスト用の商品です',
            'condition_id' => '1',
        ]);

        $response = $this->actingAs($user)
                         ->get(route('items', ['page' => 'mylist', 'keyword' => $keyword]));

        $response->assertStatus(200);

        $response->dump();
        $response->assertSee($keyword);
    }

    public function test_商品詳細画面にて必要な情報が取得される()
    {
        // 1. 準備：詳細な情報を設定して商品を作成
        
        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $condition = Condition::factory()->create();

        $item = Item::create([
            'id'=>'1',
            'item_image' => 'test.jpg',
            'item_name' => 'Laravel本',
            'brand_name' => 'テスト工房',
            'item_price' => '5000',
            'seller_id' => '2',
            'item_detail' => 'これは商品の説明文です。',
            'condition_id' => '1',
        ]);

    // 2. 実行：詳細画面へアクセス
        $response = $this->get(route('item.detail', ['item_id' => $item->id]));

    // 3. 検証：各情報が表示されているか
        $response->assertStatus(200);
        $response->dump();
        $response->assertSee('Laravel本');
        $response->assertSee('5,000'); // カンマ区切りなどのフォーマットも確認
        $response->assertSee('これは商品の説明文です。');
    }

    public function test_商品詳細画面にて複数選択されたカテゴリが表示されている()
    {
        $cat1 = Category::create(['category_content' => 'ファッション']);
        $cat2 = Category::create(['category_content' => 'メンズ']);
    
        $seller = User::factory()->create([
            'id' => '2',
        ]);

        $condition = Condition::factory()->create();

        $item = Item::create([
            'id'=>'1',
            'item_image' => 'test.jpg',
            'item_name' => 'Laravel本',
            'brand_name' => 'テスト工房',
            'item_price' => '5000',
            'seller_id' => '2',
            'item_detail' => 'これは商品の説明文です。',
            'condition_id' => '1',
        ]);
    
    // 中間テーブルに紐付け（attach）
        $item->categories()->attach([$cat1->id, $cat2->id]);

    // 2. 実行
        $response = $this->get(route('item.detail', ['item_id' => $item->id]));

    // 3. 検証：両方のカテゴリ名が出ているか
        $response->assertSee('ファッション');
        $response->assertSee('メンズ');
    }

    

    

}
