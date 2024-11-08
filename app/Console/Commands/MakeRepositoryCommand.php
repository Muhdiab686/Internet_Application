<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name : The name of the repository}';
    protected $description = 'Create a new repository class';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Repositories/{$name}.php");

        if (File::exists($path)) {
            $this->error("Repository {$name} already exists!");
            return;
        }

        $stub = $this->getStub();
        $content = str_replace('{{name}}', $name, $stub);

        File::ensureDirectoryExists(app_path('Repositories'));
        File::put($path, $content);

        $this->info("Repository {$name} created successfully.");
    }

    protected function getStub()
    {
        return <<<EOT
        <?php

        namespace App\Repositories;

        use App\Interfaces\{{name}}Interface;

        class {{name}}Repository implements {{name}}Interface
        {
            //
        }
        EOT;
    }
}
