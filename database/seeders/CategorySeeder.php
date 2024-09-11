<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Создание ролей и прав доступа',
        ]);

        Category::create([
            'name' => 'Проектный менеджмент',
        ]);

        Category::create([
            'name' => 'Задачи и требования',
        ]);

        Category::create([
            'name' => 'Технологический стек',
        ]);

        Category::create([
            'name' => 'Обратная связь и комментарии',
        ]);

        Category::create([
            'name' => 'Баги и исправления',
        ]);

        Category::create([
            'name' => 'Знания и документация',
        ]);

        Category::create([
            'name' => 'События и мероприятия',
        ]);

        Category::create([
            'name' => 'Роли и права доступа',
        ]);

        Category::create([
            'name' => 'Тестирование и QA',
        ]);
    }
}
