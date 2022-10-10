<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'is_private',
        'category_id',
        'image'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public static function rules()
    {
        $categoryTableName  = (new Category())->getTable();
        return [
            'title' => 'alpha_num|required|min:5',
            'text' => 'required|min:5',
            'category_id' => "required|exists:{$categoryTableName},id",
            'is_private' => 'in:0,1',
            'image' => 'image|max:1000',
        ];
    }

    public static function attributesName()
    {
        return [
            'title' => '"Заголовок новости"',
            'text' => '"Текст новости"',
            'category_id' => '"ID Категории"',
            'image' => '"Изображение"',
        ];
    }
}
