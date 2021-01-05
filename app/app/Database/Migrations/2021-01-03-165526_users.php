<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
      $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false,
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique'            => TRUE
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'           => '255',
            ],
          
            'gender'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
            ],
            'status'       => [
                'type'           => 'TINYINT',
                'default' => 0,
            ],
            'created_at'       => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'       => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');  
    }

    //--------------------------------------------------------------------

    public function down()
    {
         $this->dbforge->drop_table('users');
    }
}
