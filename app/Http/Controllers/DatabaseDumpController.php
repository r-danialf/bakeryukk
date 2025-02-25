<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DatabaseDumpController extends Controller
{
    public function dump()
    {
        try {
            $db = config('database.connections.mysql');

            $filename = 'dump-' . date('Y-m-d_H-i-s') . '.sql';
            $storagePath = storage_path('app/backups/' . $filename);

            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            $command = "mysqldump --user={$db['username']} --password={$db['password']} --host=127.0.0.1 --port=3306 {$db['database']} > {$storagePath}";
            exec($command, $output, $return_var);
            \Log::info('MySQL Dump Output: ' . implode("\n", $output));

            if ($return_var !== 0) {
                return redirect()->back()->with('error', 'Database dump failed.');
            }

            return response()->download($storagePath)->deleteFileAfterSend();

        } catch (ProcessFailedException $e) {
            return redirect()->back()
                ->with('error', 'Database dump failed: ' . $e->getMessage());
        }
    }
}
