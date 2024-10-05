<?php

namespace App\Console\Commands;
use Symfony\Component\Process\Process;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:project {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Laravel project with the specified name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
          // Get the project name from the argument
          $name = $this->argument('name');

          // Step 1: Check if the directory already exists
          if (File::exists(base_path($name))) {
              $this->error("Directory '$name' already exists.");
              return Command::FAILURE;
          }
  
          // Step 2: Create the Laravel project using Composer
          $this->info('Creating new Laravel project...');
          $this->runProcess(['composer', 'create-project', '--prefer-dist', 'laravel/laravel', $name]);
  
          // Step 3: Change to the new project directory
          $projectPath = base_path($name);
          chdir($projectPath);
  
          // Step 4: Initialize Git repository
          $this->info('Initializing Git repository...');
          $this->runProcess(['git', 'init']);
  
          // Step 5: Install NPM packages if package.json exists
          if (File::exists($projectPath . '/package.json')) {
              $this->info('Installing NPM packages...');
              $this->runProcess(['npm', 'install']);
          }
  
          // Step 6: Completion message
          $this->info('Laravel project setup complete!');
  
          return Command::SUCCESS;
    }

    protected function runProcess(array $command)
    {
        $process = new Process($command);
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (!$process->isSuccessful()) {
            $this->error('Error running: ' . implode(' ', $command));
            exit(1);
        }
    }
}
