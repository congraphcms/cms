<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Config;
use Congraph\EntityElastic\Repositories\EntityRepositoryContract as EntityElasticRepositoryContract;
use Congraph\Contracts\Eav\EntityRepositoryContract;

class IndexEntities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:entities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index entities from mysql db to elastic';

    /**
     * Entity Elastic Repository
     *
     * @var Congraph\EntityElastic\Repositories\EntityRepositoryContract
     */
    protected $elasticRepository;

    /**
     * Entity Repository
     *
     * @var Congraph\EntityElastic\Repositories\EntityRepositoryContract
     */
    protected $repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EntityElasticRepositoryContract $elasticRepository, EntityRepositoryContract $repository)
    {
        parent::__construct();

        $this->elasticRepository = $elasticRepository;
        $this->repository = $repository;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $limit = 100;
        $this->line('Index entities inited');
        $entities = $this->repository->get([], 0, $limit, ['id']);
        $entitiesMetaArray = $entities->toArray(true, true);
        $total = $entitiesMetaArray['meta']['total'];
        $current = 0;
        $this->info($total);


        while($current < $total) {
            $this->info('handling ' . $current . ' to ' . ($current + $limit) . ' from ' . $total);
            foreach ($entities as $entity) {
                $entityArray = $entity->toArray();
                $this->elasticRepository->create($entityArray, $entity);
                // $this->info($entity->toJson());
            }

            $current += $limit;
            $entities = $this->repository->get([], $current, $limit, ['id']);

        }

        

        // $this->elasticRepository->create();

        // $this->info(json_encode($entitiesArray));

    }
}
