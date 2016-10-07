<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Application
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // This is the view we want shown
        $this->data['pagebody'] = 'admin';


        //Open materials form
        $this->data['form_open'] = form_open('admin/post');

        // Get list of materials
        $source = $this->Materials->all();

        // Set table headers and parameters
        $items[] = array('Name', 'Rename', 'Delete');
        $data = array('class' => '');

        // Add table rows
        foreach ($source as $record)
        {
            $text_data = array('name' => 'n_' . $record['id']);
            $chk_data = array('name' => 'c_' . $record['id']);

            $items[] = array($record['name'], form_input($text_data), form_checkbox($chk_data));

        }

        // Add new items
        $items[] = array('');
        $items[] = array('Add New Item', '', '');
        $items[] = array(form_input($data), '', '');

        // Submit button
        $items[] = array('', '', form_submit('submit', 'Submit'));

        $this->data['test'] = $this->Materials->get(1);

        //table parameters
//        $params = array(
//            'table_open' => '<table class="table-mat" border="0" cellpadding="2" cellspacing="5">',
//            'cell_start' => '<td class="item-mat>',
//            'cell_alt_start' => '<td class="item-mat">'
//        );
//
//        $this->table->set_template($params);

        //Generate the materials table
        $this->data['mat_table'] = $this->table->generate($items);

        //close form
        $this->data['form_close'] = form_close();


        $this->render();

    }

    /**
     * Elayne Boolsters quote Issue #4
     */
    public function get($id) {
        $this->data['pagebody'] = 'material_single';

        $record = $this->Materials->get($id);
        $this->data = array_merge($this->data, $record);

        $this->render();
    }

    public function clear() {
        $this->session->unset_userdata('materials');
        echo 'materials transactions cleared!';
    }

    public function post()
    {
        var_dump($_POST);

    }

}