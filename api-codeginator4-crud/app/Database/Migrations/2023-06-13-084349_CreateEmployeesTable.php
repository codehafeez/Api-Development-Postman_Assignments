<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateEmployeesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'comment' => 'Primary Key',
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 100,
                'comment' => 'Name',
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 255,
                'comment' => 'Email Address',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('employees', true, ['COMMENT' => 'datatable demo table']);
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
