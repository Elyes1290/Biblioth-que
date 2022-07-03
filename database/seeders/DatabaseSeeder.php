<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Country;
use App\Models\People;
use App\Models\Book;
use \Faker\Generator;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $countries = Country::all();

        $categories = Category::factory()->count(100)->create();

        $authors = Author::factory()->count(100)->make() 
                    ->each(function ($author) use ($countries) {

                        $author->country_id = $countries->random()->iso;
                        $author->save();

                    });
                    
            
        
        
        $books = Book::factory()->count(100)->make()

                        ->each(function ($book) use ($categories) {

                            $book->category_id = $categories->random()->id;
                            $book->save();    
                        
                        })
                        
                        
                        ->each(function ($book) use ($authors) {

                            $idAuthor = $authors->random()->id;
                            $idBook = $book->isbn;
                            $book->Authors()->attach([$idAuthor],['book_isbn' => $idBook]);

                        });

        $people = People::factory()->count(100)->make()
                        ->each(function ($person) use ($countries) {

                        $person->country_id = $countries->random()->iso;
                        $person->save();


                    })
                        ->each(function ($person) use ($books) {

                            $idBooks = $books->random()->isbn;
                            $person->Books()->attach([$idBooks]);
                    
                    
                        });
        
        
    }
}
