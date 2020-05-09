<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Tests\TestCase;
use App\Http\Requests\CreateTask;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     // テストケースごとにDBをリフレッシュしてマイグレーションを再実行する
     use RefreshDatabase;

     // ここのメソッドではシーダーを実行している
     public function setUp(): void
     {
       parent::setUp();

       // テストケースに実行前にフォルダデータを作成する
       $this->seed('FoldersTableSeeder');
     }

     /**
     * 期限日が日付でない場合はバリデーションエラー
     * @tests
     */
     // 第１引数ーアクセスするURL
     // 第２引数ー入力値
     // postメソッドでタスク作成ルートにアクセスしている
     public function test_due_date_should_be_date()
     {
       $response = $this->post('/1/tasks/create', [
         'title' => 'Sample task',
         'due_date' => 123, //不正なデータ
       ]);

       // assertSessionHasErrorsメソッドでエラーメッセージがあることを確かめる
       $response->assertSessionHasErrors([
         'due_date' => '期限日 には日付を入力してください',
       ]);
     }

     /**
     * 期限日が過去日付の場合はバリデーションエラー
     * @tests
     */

     public function test_due_date_should_not_be_past()
     {

       // 第１引数ーアクセスするURL
       // 第２引数ー入力値
       // postメソッドでタスク作成ルートにアクセスしている
       $response = $this->post('/1/tasks/create', [
         'title' => 'Sample task',
         'due_date' => Carbon::yesterday()->format('Y/m/d'),
       ]);

       $response->assertSessionHasErrors([
         'due_date' => '期限日 には今日以降の日付を入力してください',
       ]);
     }

     public function test_status_should_be_within_defined_numbers()
     {
       $this->seed('TasksTableSeeder');

       $response = $this->post('/folders/1/tasks/1/edit', [
         'title' => 'Sample task',
         'due_date' => Carbon::today()->format('Y/m/d'),
         'status' => 999,
       ]);

       $response->assertSessionHasErrors([
         'status' => '状態 には 未着手、着手中、完了 のいずれかを指定してください',
       ]);
     }
}
