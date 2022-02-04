<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogTagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogTagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogTagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\BlogTag::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blog-tag');
        CRUD::setEntityNameStrings('blog tag', 'blog tags');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BlogTagRequest::class);


        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Enter Tag name"
        ]);
        // CRUD::field('created_by')->type('text')->model('App\Models\User')->attribute('name')->entity('user');
        // CRUD::field('created_by')->type('hidden')->attributes(['disabled' => 'disabled'])->model('App\Models\User')->attribute('name')->entity('user');
        // CRUD::field('created_by')->type('select2')->attributes(['disabled' => 'disabled'])->model('App\Models\User')->attribute('name')->entity('user');
        // $this->crud->addField([
        //     'label' => "Created By",
        //     'type' => "select",
        //     'name' => 'created_by',
        //     'entity' => 'user',
        //     'attribute' => 'name',
        //     'model' => "App\Models\BlogTag",
        // ]);
        // // 1-n relationship




        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
