<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareTask extends Model
{
    protected $fillable = [
      'title', 'share_folder_id', 'due_date', 'updated_at'
    ];

    const STATUS = [
        1 => ['label' => '未着手'],
        2 => ['label' => '着手中'],
        3 => ['label' => '完了'],
      ];
    
      // 状態のラベル
      public function getStatusLabelAttribute()
      {
        // 状態カラムの値を取得
        $status = $this->attributes['status'];
    
        // 定義されなかったら空文字を返す
        if (!isset(self::STATUS[$status])) {
          return '';
        }
    
        return self::STATUS[$status]['label'];
      }
}
