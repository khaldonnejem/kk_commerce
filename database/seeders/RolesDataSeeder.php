<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $ability = [
        // 'key' => 'value',
        'all_categories' => 'All Categories',
        'single_categories' => 'Show Single Categories',
        'add_category' => 'Add Category',
        'delete_categor' => 'Delete Category',
        'edit_category' => 'Edit Category',

        'all_products' => 'All Products ',
        'single_products' => 'Show Single Products',
        'add_product' => 'Add Product',
        'delete_product' => 'Deleter Product',
        'edit_product' => 'Edit Product',

    ];

    public function run()
    {
        $data = [
            ['name' => 'Super Admin'],
            ['name' => 'Category Manager'],
            ['name' => 'Product Manager'],
        ];

        Role::insert($data);

        foreach($this->ability as $code => $name) {
            Ability::create([
                'name' => $name,
                'code' => $code
            ]);
        }

        // //this way its not practical coz you will write this roler 10 times for abilities number
        // Ability::create([
        //     'name' => 'All Categories',
        //     'code' => 'all_categories'
        // ]);

        // Role::create(['name' => 'Super Admin']);
    }
}
