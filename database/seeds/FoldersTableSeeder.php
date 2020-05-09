<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $user = DB::table('users')->first();
// "プライベート""仕事""旅行"というフォルダを作成
      $titles = ['プライベート','仕事','旅行'];

// データを挿入する”タイトル”"作成日""更新日"を用意
      foreach ($titles as $title) {
        DB::table('folders')->insert([
          'title' => $title,
          'user_id' => $user->id,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
    }
}
