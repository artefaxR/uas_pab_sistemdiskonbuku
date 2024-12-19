<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'quantity', 'discount', 'total_price'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
