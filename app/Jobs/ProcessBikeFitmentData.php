<?php

namespace App\Jobs;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BikeFitmentDataImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessBikeFitmentData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     *
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Job started for file: ' . $this->filePath);

        // Check if the file exists before processing
        if (file_exists($this->filePath)) {
            Log::info('File exists, starting Excel import.');

            try {
                // Process the file using the custom import class with chunk reading
                Excel::import(new BikeFitmentDataImport, $this->filePath);
                Log::info('Excel import completed successfully.');

                // Clean up the file after processing
                unlink($this->filePath);
                Log::info('File deleted after processing.');
            } catch (\Exception $e) {
                Log::error('Error during Excel import: ' . $e->getMessage());
            }
        } else {
            Log::error('File not found at path: ' . $this->filePath);
        }

        Log::info('Job completed for file: ' . $this->filePath);
    }
}
