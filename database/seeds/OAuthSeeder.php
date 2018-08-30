<?php
/*
 * This file is part of the cookbook/cms package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Debug\Dumper;
use Carbon\Carbon;

/**
 * OAuthSeeder
 *
 * Populates DB with data for testing
 *
 * @uses        Illuminate\Database\Schema\Blueprint
 * @uses        Illuminate\Database\Seeder
 *
 * @author      Nikola Plavšić <nikolaplavsic@gmail.com>
 * @copyright   Nikola Plavšić <nikolaplavsic@gmail.com>
 * @package     cookbook/cms
 * @since       0.1.0-alpha
 * @version     0.1.0-alpha
 */
class OAuthSeeder extends Seeder
{
    public function run()
    {
        $dumper = new Dumper();
        $bus = App::make('Cookbook\Core\Bus\CommandDispatcher');

        // SCOPES
        DB::table('oauth_scopes')->delete();
        DB::table('oauth_scopes')->insert([
            [
                'id' => 'manage_users',
                'label' => 'Manage Users',
                'description' => 'Allows user to manage other user accounts.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'read_users',
                'label' => 'Read Users',
                'description' => 'Allows user to read other user accounts.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'manage_roles',
                'label' => 'Manage Roles',
                'description' => 'Allows user to manage user rols.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'read_roles',
                'label' => 'Read Roles',
                'description' => 'Allows user to read user rols.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'manage_clients',
                'label' => 'Manage Clients',
                'description' => 'Allows user to manage OAuth clients.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'read_clients',
                'label' => 'Read Clients',
                'description' => 'Allows user to read OAuth clients.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'manage_content_model',
                'label' => 'Manage Content Model',
                'description' => 'Allows user to manage entity types and attributes.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'read_content_model',
                'label' => 'Read Content Model',
                'description' => 'Allows user to read entity types and attributes.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'manage_content',
                'label' => 'Manage Content',
                'description' => 'Allows user to manage all content.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'read_content',
                'label' => 'Read Content',
                'description' => 'Allows user to read all content.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('oauth_grants')->delete();
        DB::table('oauth_grants')->insert([
            [
                'id' => 'password',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'refresh_token',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 'client_credentials',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('roles')->delete();
        DB::table('role_scopes')->delete();
        DB::table('user_roles')->delete();
        DB::table('users')->delete();
        DB::table('oauth_clients')->delete();
        DB::table('oauth_client_scopes')->delete();
        DB::table('oauth_client_grants')->delete();

        // ROLES
        $roles = [
            [
                'name' => 'Administrator',
                'description' => 'Can manage all.',
                'scopes' => [
                    'manage_users',
                    'read_users',
                    'manage_roles',
                    'read_roles',
                    'manage_clients',
                    'read_clients',
                    'manage_content_model',
                    'read_content_model',
                    'manage_content',
                    'read_content'
                ]
            ],
            [
                'name' => 'Editor',
                'description' => 'Can edit only entities.',
                'scopes' => ['manage_content', 'read_content']
            ],
            [
                'name' => 'Developer',
                'description' => 'Can edit only clients and API keys.',
                'scopes' => ['manage_clients', 'read_clients']
            ]
        ];

        $roleResults = [];
        foreach ($roles as $role) {
            try {
                $result = $bus->dispatch(new Cookbook\OAuth2\Commands\Roles\RoleCreateCommand($role));
            } catch (\Cookbook\Core\Exceptions\ValidationException $e) {
                $dumper->dump($e->getErrors());
                return;
            }
            
            $roleResults[] = $result;
        }

        // USERS
        $users = [
            [
                'name' => 'Nikola Plavsic',
                'email' => 'nikolaplavsic@gmail.com',
                'password' => 'secret123',
                'roles' => [
                    [
                        'id' => $roleResults[0]->id,
                        'type' => 'role'
                    ]
                ]
            ],
            [
                'name' => 'Velja Matic',
                'email' => 'veljamatic@gmail.com',
                'password' => 'vekson123',
                'roles' => [
                    [
                        'id' => $roleResults[0]->id,
                        'type' => 'role'
                    ]
                ]
            ],
            [
                'name' => 'Filip Arneric',
                'email' => 'filip@rebellion7.com',
                'password' => 'selasije',
                'roles' => [
                    [
                        'id' => $roleResults[0]->id,
                        'type' => 'role'
                    ]
                ]
            ]
        ];

        $userResults = [];
        foreach ($users as $user) {
            try {
                $result = $bus->dispatch(new Cookbook\OAuth2\Commands\Users\UserCreateCommand($user));
            } catch (\Cookbook\Core\Exceptions\ValidationException $e) {
                $dumper->dump($e->getErrors());
                return;
            }
            $userResults[] = $result;
        }

        // CLIENTS
        $clients = [
            [
                'name' => 'Administration App',
                'scopes' => [
                    'manage_users',
                    'read_users',
                    'manage_roles',
                    'read_roles',
                    'manage_clients',
                    'read_clients',
                    'manage_content_model',
                    'read_content_model',
                    'manage_content',
                    'read_content'
                ],
                'grants' => ['password', 'refresh_token']
            ],
            [
                'name' => 'Frontend App',
                'scopes' => [
                    'read_users',
                    'read_roles',
                    'read_content_model',
                    'read_content'
                ],
                'grants' => ['client_credentials']
            ]
        ];

        $clientResults = [];
        foreach ($clients as $client) {
            try {
                $result = $bus->dispatch(new Cookbook\OAuth2\Commands\Clients\ClientCreateCommand($client));
            } catch (\Cookbook\Core\Exceptions\ValidationException $e) {
                $dumper->dump($e->getErrors());
                return;
            }
            $clientResults[] = $result;
        }
    }
}
