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
            // Get database configuration
            $db = config('database.connections.mysql');

            // Create output filename
            $filename = 'dump-' . date('Y-m-d_H-i-s') . '.sql';
            $storagePath = storage_path('app/backups/' . $filename);

            // Ensure directory exists
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Build mysqldump command
            $process = new Process([
                'mysqldump',
                '--user=' . $db['username'],
                '--password=' . $db['password'],
                '--host=' . $db['host'],
                $db['database'],
                '--result-file=' . $storagePath
            ]);

            // Set process timeout to 5 minutes
            $process->setTimeout(300);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // Return download response
            return response()->download($storagePath)->deleteFileAfterSend();

        } catch (ProcessFailedException $e) {
            return redirect()->back()
                ->with('error', 'Database dump failed: ' . $e->getMessage());
        }
    }
}
