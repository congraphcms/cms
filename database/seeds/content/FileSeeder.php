<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Congraph\Core\Bus\CommandDispatcher;
use Congraph\Filesystem\Commands\Files\FileCreateCommand;
use Congraph\Core\Exceptions\Exception as CongraphException;
use Illuminate\Support\Debug\Dumper;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class FileSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        $d = new Dumper();
        $bus = App::make(CommandDispatcher::class);
        $dataPath = __DIR__ . '/data/files.json';
        $dataJson = file_get_contents($dataPath);
        $data = json_decode($dataJson, true);


        try {
            foreach ($data as $filename) {
                $path = realpath(__DIR__ . '/data/files/' . $filename);
                $finfo = finfo_open( FILEINFO_MIME );
                $mime = finfo_file($finfo, $path );
                $mimeParts = explode(';', $mime);
                $mime = array_shift($mimeParts);
                $size = filesize($path);
                $params = [
                    'file' => new UploadedFile( $path, $filename, $mime, $size, null, true)
		        ];
                $command = new FileCreateCommand($params);
                $bus->dispatch($command);
            }
        } catch (CongraphException $e) {
            $d->dump($e->getErrors());
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
