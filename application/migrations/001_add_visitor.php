<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'/third_party/faker/autoload.php';
class Migration_Add_visitor extends CI_Migration {

        public function up(){
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'first_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'last_name' => array(
                               'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'email' => array(
                               'type' => 'VARCHAR',
                                'constraint' => '50',
                        ),
                        'date_of_birth' => array(
                                'type' => 'DATE',
                                'null' => TRUE,
                        ),
                        'random_number' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'created_at' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'updated_at' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('visitors');
                $this->seedData();
        }

        public function down(){
                $this->dbforge->drop_table('visitors');
        }

        public function seedData() {
                $numOfRows = 499;
                $faker = Faker\Factory::create();
                $faker->seed($numOfRows);
                for ($i=0; $i <= $numOfRows; $i++)
                {
                        $data['first_name'] = $faker->firstName;
                        $data['last_name'] = $faker->lastName;
                        $data['email'] = $faker->email;
                        $data['date_of_birth'] = $faker->date('Y-m-d');
                        $data['random_number'] = $faker->randomNumber(5, true);
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $insertBatchData[] = $data;
                } 
                $this->db->insert_batch('visitors', $insertBatchData);
                echo "Migration and Seeder execute successfully.";
        }
}