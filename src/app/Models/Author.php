<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    // あなたのテーブルに合わせて修正
    protected $fillable = ['first_name', 'last_name', 'email'];

    public function getDetail()
    {
        // カラム名に合わせて加工
        $txt = 'ID:' . $this->id . ' ' . $this->first_name . ' ' . $this->last_name . ' (' . $this->email . ')';
        return $txt;
    }
}
