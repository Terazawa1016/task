<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
  protected $fillable = [
    'user_id', 'title', 'update_at'
    ];
  public function tasks()
  {
// hasManyメソッドでフォルダテーブルとタスクテーブルの関連性をたどって
// 紐づくリストを取得
// 第１引数が関連するモデル名、第２が関連テーブルのカラム名,
// 第３はhasManyが定義されている側主キーのカラムの名前
    return $this->hasMany('App\Task', 'folder_id', 'id');
  }

}
