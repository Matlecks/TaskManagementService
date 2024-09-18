<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 *
 * @property int $id
 * @property string $title
 * @property null|string $description
 * @property string $status
 * @property int $user_id
 * @property int $category_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */

class Task extends Model
{
    use HasFactory;

    public $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'status' => 'string',
        'user_id' => 'integer',
        'category_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function attributeLabels(): array
    {
        return [
            'id' => trans('ID'),
            'title' => trans('Название'),
            'description' => trans('Описание'),
            'status' => trans('Статус задачи'),
            'user_id' => trans('Пользователь'),
            'category_id' => trans('Категория'),
            'created_at' => trans('Создано'),
            'updated_at' => trans('Обновлено'),
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
