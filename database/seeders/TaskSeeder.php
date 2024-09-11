<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Создание пользователей',
            'description' => '- Задача: Создать 50 пользователей с различными ролями (администратор, разработчик, тестировщик).',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Добавление проектов',
            'description' => '- Задача: Создать 20 проектов с разными названиями, описаниями и статусами (в процессе, завершен, отложен).',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Генерация задач для проектов',
            'description' => '- Задача: Создать 100 задач, распределенных по проектам, с различными приоритетами (низкий, средний, высокий).',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Импортирование технологий',
            'description' => '- Задача: Добавить 10 технологий (JavaScript, PHP, Python, Ruby и т.д.) в базу данных.',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Создание комментариев',
            'description' => '- Задача: Создать 200 комментариев к задачам от различных пользователей.',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Добавление статусов задач',
            'description' => '- Задача: Создать набор статусов для задач (новая, в работе, на проверке, завершена).',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Генерация тестовых данных для багов',
            'description' => '- Задача: Создать 50 багов с описанием, шагами воспроизведения и приоритетом.',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Создание категорий для знаний',
            'description' => '- Задача: Добавить 15 категорий для базы знаний (разработка, тестирование, DevOps и т.д.).',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Добавление событий',
            'description' => '- Задача: Создать 10 событий (вебинары, митинги) с датами и описаниями.',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        Task::create([
            'title' => 'Создание ролей и прав доступа',
            'description' => '- Задача: Добавить роли (гость, пользователь, администратор) и соответствующие права доступа к различным частям приложения.',
            'status' => 'Ожидание',
            'user_id' => 1,
            'category_id' => 1,
        ]);
    }
}
