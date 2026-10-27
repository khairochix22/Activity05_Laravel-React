<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class StartApplicationCommand extends Command
{
    protected $signature = 'app:dev';

    protected $description = 'Start the Laravel API and React frontend';

    public function handle(): int
    {
        $frontendPath = base_path('../react-frontend');

        if (! is_dir($frontendPath)) {
            $this->error("React frontend directory not found: {$frontendPath}");

            return self::FAILURE;
        }

        $backend = new Process(['php', 'artisan', 'serve'], base_path());
        $npm = PHP_OS_FAMILY === 'Windows' ? 'npm.cmd' : 'npm';
        $frontend = new Process([$npm, 'start'], $frontendPath);

        $backend->start();
        $frontend->start();

        $this->info('Laravel API: http://127.0.0.1:8000');
        $this->info('React frontend: http://localhost:3000');

        if (PHP_OS_FAMILY === 'Windows') {
            pclose(popen('start "" "http://localhost:3000"', 'r'));
        }

        $this->line('Press Ctrl+C to stop the development servers.');

        while ($backend->isRunning() && $frontend->isRunning()) {
            usleep(250000);
        }

        $backend->stop();
        $frontend->stop();

        return self::SUCCESS;
    }
}
