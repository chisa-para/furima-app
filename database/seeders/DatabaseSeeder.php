<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ItemCategoriesTableSeeder::class);

        $directories = [
            'seeders/images' => 'images',
            'seeders/items' => 'items',
        ];

        foreach ($directories as $sourceDir => $destDir) {
            Storage::disk('public')->makeDirectory($destDir);

            $sourcePath = database_path($sourceDir);

            if (File::exists($sourcePath)) {
                $files = File::files($sourcePath);
                
                foreach ($files as $file) {

                    $fileName = $file->getFilename();
                    $destination = storage_path("app/public/{$destDir}/{$fileName}");

                    File::copy($file->getRealPath(), $destination);
                }
            }
        }
    }
}
