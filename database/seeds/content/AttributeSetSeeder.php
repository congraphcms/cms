<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Congraph\Core\Bus\CommandDispatcher;
use Congraph\Eav\Commands\AttributeSets\AttributeSetCreateCommand;
use Congraph\Core\Exceptions\Exception as CongraphException;
use Illuminate\Support\Debug\Dumper;


class AttributeSetSeeder extends Seeder
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
        $dataPath = __DIR__ . '/data/attributeSets.json';
        $dataJson = file_get_contents($dataPath);
        $data = json_decode($dataJson, true);
        

        try {
            foreach ($data as $item) {
                $command = new AttributeSetCreateCommand($item);
                $bus->dispatch($command);
            }
        } catch (CongraphException $e) {
            $d->dump($e->getErrors());

        }
        
    }
}
