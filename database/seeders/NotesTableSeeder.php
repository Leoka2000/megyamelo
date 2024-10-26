<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NotesTableSeeder extends Seeder
{
    public function run()
    {
        $sqlFile = database_path('mydb/mydb.sql');
        $sql = file_get_contents($sqlFile);

        $lines = explode("\n", $sql);
        $insertData = [];
        $inInsertBlock = false;
        $currentInsert = '';
        $totalRows = 0;
        $totalLines = count($lines);

        $this->command->info("Total lines in SQL file: " . $totalLines);

        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);
            
            if (strpos($line, "INSERT INTO `notes`") === 0) {
                $inInsertBlock = true;
                $currentInsert = $line;
                $this->command->info("Found INSERT statement at line " . ($lineNumber + 1));
                continue;
            }

            if ($inInsertBlock) {
                $currentInsert .= ' ' . $line;
                if (substr($line, -1) === ';') {
                    $inInsertBlock = false;
                    $this->parseInsertStatement($currentInsert, $insertData, $totalRows);
                    $this->command->info("End of INSERT block at line " . ($lineNumber + 1) . ". Total rows so far: " . $totalRows);
                }
            }
        }

        $this->command->info("Total rows parsed from SQL: " . $totalRows);

        $requiredFields = ['id', 'user_id', 'name', 'email', 'university', 'photo', 'degree', 'area', 'description', 'cv', 'accept', 'referral', 'linkedin', 'other_links', 'is_published', 'heart_count', 'created_at', 'updated_at'];

        $insertedCount = 0;
        foreach ($insertData as $data) {
            if (count($data) >= count($requiredFields)) {
                $noteData = array_combine($requiredFields, $data);
                $noteData = array_map(function($value) {
                    return $value === 'NULL' ? null : trim($value, "'");
                }, $noteData);

                $user = User::firstOrCreate(
                    ['email' => $noteData['email']],
                    [
                        'name' => $noteData['name'],
                        'password' => Hash::make(Str::random(10)),
                        'email_verified_at' => now(),
                    ]
                );
                
                $noteData['user_id'] = $user->id;
                
                Note::create($noteData);
                $insertedCount++;
            } else {
                $this->command->warn("Skipping row due to insufficient fields: " . implode(', ', $data));
            }
        }

        $this->command->info('Seeded ' . $insertedCount . ' notes.');
    }

    private function parseInsertStatement($insert, &$insertData, &$totalRows)
    {
        preg_match('/\((.*?)\) VALUES\s*(.*)/s', $insert, $matches);
        if (count($matches) === 3) {
            $values = $matches[2];
            $rows = explode('),', $values);
            foreach ($rows as $row) {
                $row = trim($row, '() ;');
                $columns = str_getcsv($row, ',', "'");
                $insertData[] = $columns;
                $totalRows++;
            }
        }
    }
}