<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Requests\ArticleRequest;

class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(\Backpack\NewsCRUD\app\Models\Article::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin') . '/article');
        $this->crud->setEntityNameStrings('article', 'articles');

        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
        });
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumn('title');
        $this->crud->addColumn([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Status',
            'type'  => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'Not Published', 1 => 'Published']
        ]);
        $this->crud->addColumn([
            // 'name' => 'featured',
            // 'label' => 'Featured',
            // 'type' => 'check',
            'name'  => 'featured',
            'label' => 'Featured',
            'type'  => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'Disabled', 1 => 'Enabled']
        ]);
        $this->crud->addColumn([
            'label' => 'Category',
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('category/' . $related_key . '/show');
                },
            ],
        ]);
        $this->crud->addColumn('tags');

        $this->crud->addFilter([ // select2 filter
            'name' => 'category_id',
            'type' => 'select2',
            'label' => 'Category',
        ], function () {
            return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'category_id', $value);
        });

        $this->crud->addFilter([ // select2_multiple filter
            'name' => 'tags',
            'type' => 'select2_multiple',
            'label' => 'Tags',
        ], function () {
            return \Backpack\NewsCRUD\app\Models\Tag::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($values) { // if the filter is active
            $this->crud->query = $this->crud->query->whereHas('tags', function ($q) use ($values) {
                foreach (json_decode($values) as $key => $value) {
                    if ($key == 0) {
                        $q->where('tags.id', $value);
                    } else {
                        $q->orWhere('tags.id', $value);
                    }
                }
            });
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ArticleRequest::class);
        $this->crud->addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
            'placeholder' => 'Your title here',
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your title, if left empty.',
            // 'disabled' => 'disabled'
        ]);
        $this->crud->addField([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
            'default' => date('Y-m-d'),
        ]);
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'browse',
        ]);
        $this->crud->addField([
            // 'label' => 'Category',
            // 'type' => 'relationship',
            // 'name' => 'category_id',
            // 'entity' => 'category',
            // 'attribute' => 'name',
            // 'inline_create' => true,
            // 'ajax' => true,

            'label'     => 'Category', // Table column heading
            'type'      => 'select2',
            'name'      => 'category_id', // the column that contains the ID of that connected entity;
            'entity'    => 'category', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Category", // foreign key model

        ]);
        $this->crud->addField([
            // 'label' => 'Tags',
            // 'type' => 'relationship',
            // 'name' => 'tags', // the method that defines the relationship in your Model
            // 'entity' => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            // 'inline_create' => ['entity' => 'tag'],
            // 'ajax' => true,

            'label'     => 'Tags', // Table column heading
            'type'      => 'select2_multiple',
            'name'      => 'tags', // the method that defines the relationship in your Model
            'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => 'App\Models\Tag',

        ]);
        $this->crud->addField([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'select2_from_array',
            'options' => [FALSE => 'Pubish Later', TRUE => 'Publish Now'],
            'allows_null' => false,
            'default'     => 'Pubish Later',
            'attributes' => [
                // 'placeholder' => 'Some text when empty',
                'class'       => 'form-control',
                // 'readonly'    => 'readonly',
                // 'disabled'    => 'disabled',
            ], // change the HTML attributes of your input
            'wrapper'   => [
                'class'      => 'form-group col-md-12 col-lg-6'
            ],

        ]);
        $this->crud->addField([
            // 'name' => 'featured',
            // 'label' => 'Featured item',
            // 'type' => 'checkbox',
            'name'        => 'featured',
            'label'       => "Featured item",
            'type'        => 'select2_from_array',
            'options'     => [FALSE => 'Not featured', TRUE => 'Featured'],
            'allows_null' => false,
            'default'     => 'Not Featured',
            // 'name'        => 'status', // the name of the db column
            // 'label'       => 'Status', // the input label
            // 'type'        => 'radio',
            // 'options'     => [
            //     // the key will be stored in the db, the value will be shown as label;
            //     0 => "Draft",
            //     1 => "Published"
            // ],
            'attributes' => [
                // 'placeholder' => 'Some text when empty',
                'class'       => 'form-control',
                // 'readonly'    => 'readonly',
                // 'disabled'    => 'disabled',
            ], // change the HTML attributes of your input
            'wrapper'   => [
                'class'      => 'form-group col-md-12 col-lg-6'
            ],
        ]);
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
        $this->crud->removeField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your title, if left empty.',
            // 'disabled' => 'disabled'
        ]);
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Category model.
     *
     * @return JSON
     */
    public function fetchCategory()
    {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Category::class);
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Tag model.
     *
     * @return JSON
     */
    public function fetchTags()
    {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Tag::class);
    }
}
