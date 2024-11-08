<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name : The name of the service}';
    protected $description = 'Create a new service class';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");

        if (File::exists($path)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        $stub = $this->getStub();
        $content = str_replace('{{name}}', $name, $stub);

        File::ensureDirectoryExists(app_path('Services'));
        File::put($path, $content);

        $this->info("Service {$name} created successfully.");
    }

    protected function getStub()
    {
        return <<<EOT
        <?php

        namespace App\Services;

        class {{name}}
        {
            //
        }
        EOT;
    }
}
