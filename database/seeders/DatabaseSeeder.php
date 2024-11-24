<?php

namespace Database\Seeders;

use App\Http\Controllers\FacultyController;
use App\Models\Board;
use App\Models\Faculty;
use App\Models\Forum;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // id 0 is reserved for university presidency
        $faculty = Faculty::create([
            'id' => '0',
            'name_en' => 'University Presidency',
            'name_ar' => 'راسة الجامعة',
            'description_en' => 'Placeholder description EN',
            'description_ar' => 'Placeholder description AR',
        ]);

        Board::create([
            'id' => '0',
            'faculty_id' => $faculty->id,
            'user_ids' => '[]'
        ]);

        // IT college
        $faculty = Faculty::create([
            'name_en' => 'College of Information Technology',
            'name_ar' => 'كلية تكنولوجيا المعلومات',
            'description_en' => 'Placeholder description for IT college EN',
            'description_ar' => 'Placeholder description for IT college AR',
        ]);

        Forum::create([
            'faculty_id' => $faculty->id,
        ]);

        Board::create([
            'faculty_id' => $faculty->id,
            'user_ids' => '[]'
        ]);

        Post::factory(10)->create();
    }
}
