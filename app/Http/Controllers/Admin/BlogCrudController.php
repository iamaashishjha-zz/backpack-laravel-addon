<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Blog::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blog');
        CRUD::setEntityNameStrings('blog', 'blogs');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $arr = [
            [
                'name'      => 'row_number',
                'type'      => 'row_number',
                'label'     => '#',
                'orderable' => false,
            ],
            [
                'name' => 'title',
                'label' => 'Title',
                'type' => 'text'
            ],
            [
                'name' => 'slug',
                'label' => 'Slug',
                'type'  => 'model_function',
                'function_name' => 'getSlugWithLink',
                'limit' => 500
            ],
            // [
            //     'name'  => 'slug',
            //     'label' => 'URL', // Table column heading
            //     'type'  => 'model_function_attribute',
            //     'function_name' => 'getSlugWithLink', // the method in your Model
            //     // 'function_parameters' => [$one, $two], // pass one/more parameters to that method
            //     // 'attribute' => 'route',
            //     // 'limit' => 100, // Limit the number of characters shown
            // ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'text',
                'limit' => 10
            ],
            [
                'name'      => 'image', // The db column name
                'label'     => 'Blog Image', // Table column heading
                'type'      => 'image',
                'height' => '30px',
                'width'  => '30px',
            ],
            [
                'label'     => 'Tags', // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'blogTags', // the method that defines the relationship in your Model
                'entity'    => 'blogTags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => 'App\Models\BlogTag',

            ],
            [
                'label'     => 'Category', // Table column heading
                'type'      => 'select',
                'name'      => 'blog_category_id', // the column that contains the ID of that connected entity;
                'entity'    => 'blogCategory', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\BlogCategory", // foreign key model
            ],
            [
                'label'     => 'User Id', // Table column heading
                'type'      => 'select',
                'name'      => 'user_id', // the column that contains the ID of that connected entity;
                'entity'    => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\User",
            ],

            // [
            //     'label'     => 'Created By', // Table column heading
            //     'type'      => 'select',
            //     'name'      => 'created_by', // the column that contains the ID of that connected entity;
            //     'entity'    => 'user', // the method that defines the relationship in your Model
            //     'attribute' => 'name', // foreign key attribute that is shown to user
            //     'model'     => "App\Models\User",
            // ],

            // [
            //     'label'     => 'Updated By', // Table column heading
            //     'type'      => 'select',
            //     'name'      => 'updated_by', // the column that contains the ID of that connected entity;
            //     'entity'    => 'user', // the method that defines the relationship in your Model
            //     'attribute' => 'name', // foreign key attribute that is shown to user
            //     'model'     => "App\Models\User",
            // ],

        ];

        $this->crud->addColumns($arr);

        $this->crud->enableBulkActions();
        $this->crud->addFilter(
            [
                'name'  => 'status',
                'type'  => 'select2',
                'label' => 'Status'
            ],
            function () {
                return [
                    '1' => 'In stock',
                    '2' => 'In provider stock',
                    '3' => 'Available upon ordering',
                    '4' => 'Not available',
                ];
            },
            function ($value) {
                $this->crud->addClause('where', 'status', $value);
            }
        );
        $this->crud->addFilter(
            [
                'type'  => 'date_range',
                'name'  => 'from_to',
                'label' => 'Date range'
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'date', '>=', $dates->from);
                $this->crud->addClause('where', 'date', '<=', $dates->to . ' 23:59:59');
            }
        );

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
        CRUD::setValidation(BlogRequest::class);

        $this->crud->enableTabs();
        $this->crud->enableHorizontalTabs();

        $this->crud->setTitle('Create New Blog', 'create'); // set the Title for the create action
        $this->crud->setHeading('New Blog', 'create'); // set the Heading for the create action
        $this->crud->setSubheading('Create new blog Posts', 'create'); // set the Subheading for the create action


        $arr = [
            [
                'name' => 'title',
                'label' => 'Blog Title',
                'type' => 'text',
                'tab' => 'Blog'
            ],

            [
                'name' => 'description',
                'label' => 'Blog Description',
                'type' => 'text',
                'tab' => 'Blog'
            ],
            [
                'name'  => 'content',
                'label' => 'Blog Content',
                'type'  => 'wysiwyg',
                'tab' => 'Blog'
            ],
            [
                'label' => "Image",
                'name' => "image",
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1,
                'tab' => 'Others'
            ],
            [
                'label'     => "Category",
                'type'      => 'select2',
                'name'      => 'blog_category_id', // the db column for the foreign key
                'ajax' => true,
                'inline_create' => true,
                // optional
                'entity'    => 'blogCategory', // the method that defines the relationship in your Model
                'model'     => "App\Models\BlogCategory", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'default'   => 1, // set the default value of the select2
                // also optional
                'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')
                        // ->where('depth', 1)
                        ->get();
                }),
                'tab' => 'Others',
            ],
            [
                'name' => 'blogTags',
                'type' => 'relationship',
                'tab' => 'Others',
            ],

            [
                'name' => 'created_by',
                'label' => 'Created By',
                'type' => 'hidden',
                'default' => backpack_user()->id,
            ],
        ];
        $this->crud->addFields($arr);
        CRUD::addField([
            'view_namespace' => 'star-field-for-backpack::fields',
            'name' => 'rate',
            'type' => 'star',
            'attributes' => [
                // 'placeholder' => 'Some text when empty',
                'class'       => 'form-control',
                // 'readonly'    => 'readonly',
                // 'disabled'    => 'disabled',
            ], // change the HTML attributes of your input
            'wrapper'   => [
                'class'      => 'form-group col-md-12 col-lg-6'
            ],
            'label' => 'Rating', // (optional)
            'count' => 8, // (optional) the max rate count; default value is 5
            'default' => 6, // (optional) the default checked rate on new item creation
            'hint' => 'Cheer up!', // (optional)
            'options' => [ // (optional) customize the look
                'icon' => '★', // (optional) the default icon is ★
                'unchecked_color' => '#ccc', // (optional) the default value is #ccc
                'checked_color' => '#ffc700', // (optional) the default value is #ffc700
                'hover_color' => '#c59b08', // (optional) the default value is #c59b08
            ],
            'tab' => 'Others',
        ]);
        $this->crud->addField([
            'name' => 'signature',
            'label' => 'Please sign here',
            'type' => 'signature',
            'view_namespace' => 'signature-field-for-backpack::fields',
            'attributes' => [
                // 'placeholder' => 'Some text when empty',
                'class'       => 'form-control',
                // 'readonly'    => 'readonly',
                // 'disabled'    => 'disabled',
            ], // change the HTML attributes of your input
            'wrapper'   => [
                'class'      => 'form-group col-md-12 col-lg-6'
            ],
            'tab' => 'Others',
        ]);

        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Blog Title',
            'type' => 'text',
            'tab' => 'Blog'
        ]);
        // dd(BlogRequest::class->id);
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
        // $this->setupCreateOperation();

        $arr = [
            [
                'name' => 'title',
                'label' => 'Blog Title',
                'type' => 'text'
            ],

            [
                'name' => 'description',
                'label' => 'Blog Description',
                'type' => 'text'
            ],

            [
                'name'  => 'content',
                'label' => 'Blog Content',
                'type'  => 'wysiwyg'
            ],
            [
                'label' => "Image",
                'name' => "image",
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1,
            ],
            [
                'label'     => "Category",
                'type'      => 'select2',
                'name'      => 'blog_category_id', // the db column for the foreign key
                // 'ajax' => true,
                // 'inline_create' => true,
                // optional
                'entity'    => 'blogCategory', // the method that defines the relationship in your Model
                'model'     => "App\Models\BlogCategory", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'default'   => 1, // set the default value of the select2
                // also optional
                'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')
                        // ->where('depth', 1)
                        ->get();
                }),
            ],
            [
                'name' => 'blogTags',
                'type' => 'relationship',
            ],
            // [
            //     'name' => 'user_id',
            //     'label' => 'Created By',
            //     'type' => 'hidden',
            //     'entity' => 'user',
            //     'model' => "App\Models\User",
            //     'attribute' => 'name',
            //     'default' => backpack_user()->id,
            // ],

            [
                'name' => 'created_by',
                'label' => 'Created By',
                'type' => 'hidden',
                'default' => backpack_user()->id,
            ],
        ];
        $this->crud->addFields($arr);
    }
}
