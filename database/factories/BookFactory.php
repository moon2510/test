<?php

use Faker\Generator as Faker;
use App\Book;
use App\Category;

$factory->define(Book::class, function (Faker $faker) {
	$ids = Category::pluck('id');
	return[
		'name' => $faker->word . ' ' . $faker->numberBetween($min = 0, $max = 9999),
		'img' => '/images/default.jpg',
		'author' => $faker->name,
		'published_year' => $faker->year($max = 'now'),
		'describes' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
		'price' => $faker->numberBetween($min = 1000, $max = 1000000),
		'quantity' => $faker->numberBetween($min = 0, $max = 100),
		'category_id' => $faker->randomElement($ids),
	];
});
