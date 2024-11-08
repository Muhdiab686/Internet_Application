<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeInterfaceCommand extends Command
{
    protected $signature = 'make:interface {name : The name of the interface}';
    protected $description = 'Create a new interface';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Interfaces/{$name}Interface.php"); // تأكد من إضافة "Interface" في الاسم

        if (File::exists($path)) {
            $this->error("Interface {$name} already exists!");
            return;
        }

        $stub = $this->getStub();
        $content = str_replace('{{name}}', $name, $stub);

        File::ensureDirectoryExists(app_path('Interfaces'));
        File::put($path, $content);

        $this->info("Interface {$name} created successfully.");
    }

    protected function getStub()
    {
        return <<<EOT
<?php

namespace App\Interfaces;

interface {{name}}Interface
{
    //
}
EOT;
    }
}
