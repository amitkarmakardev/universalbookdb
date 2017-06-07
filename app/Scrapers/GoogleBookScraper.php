<?php

namespace App\Scrapers;

use App\Book;
use Isbn\Isbn;

class GoogleBookScraper
{

    public static function saveGoogleBookData($isbn_10, $isbn_13)
    {
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:{$isbn_10}";
        $jsonObj = json_decode(Scraper::getDetails($url));

        if(Book::where('isbn_10', $isbn_10)->first() != null){
            echo "Book {$isbn_10} already exists in database. Skipping....".PHP_EOL;
            return;
        }
        $gbook = new Book();
        $gbook->isbn_10 = $isbn_10;
        $gbook->isbn_13 = $isbn_13;

        if ($jsonObj->totalItems > 0) {

            $book_detail = $jsonObj->items[0];

            $gbook->google_id = $book_detail->id;
            $gbook->title = $book_detail->volumeInfo->title;
            $gbook->publisher = $book_detail->volumeInfo->publisher;
            $gbook->published_date = $book_detail->volumeInfo->publishedDate;
        }

        $gbook->save();
    }
}