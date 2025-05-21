<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_admin_id_to_keywords extends CI_Migration
{
    public function up()
    {
        // Add admin_id column
        $this->dbforge->add_column('keywords', [
            'admin_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'after' => 'id'
            ]
        ]);

        // Add foreign key constraint
        $this->db->query('ALTER TABLE keywords ADD CONSTRAINT fk_keywords_admin FOREIGN KEY (admin_id) REFERENCES login(id) ON DELETE CASCADE');
    }

    public function down()
    {
        // Remove foreign key constraint
        $this->db->query('ALTER TABLE keywords DROP FOREIGN KEY fk_keywords_admin');

        // Remove admin_id column
        $this->dbforge->drop_column('keywords', 'admin_id');
    }
}
