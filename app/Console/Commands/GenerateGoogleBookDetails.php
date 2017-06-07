<?php

namespace App\Console\Commands;

use App\Scrapers\GoogleBookScraper;
use Illuminate\Console\Command;
use App\GoogleBook;
use Isbn\Isbn;

class GenerateGoogleBookDetails extends Command
{

    protected $signature = 'generate:gbook {start} {limit}';


    protected $description = 'Use this command to generate google book details between start ISBN and limit ISBN';


    public function __construct()
    {
        parent::__construct();
    }


    public function isValidISBN10($start, $limit)
    {
        $status = true;
        if (strlen($start) == 9 && strlen($limit) == 9) {
            if (intval($start) > intval($limit)) {
                $this->warn("Start must be smaller than lilmit");
                $status = false;
            }
        } else {
            $this->warn("ISBN part should be 9 digits long");
            $status = false;
        }
        return $status;
    }

    public function handle()
    {

        $isbn = new Isbn();

        $start = $this->argument('start');
        $limit = $this->argument('limit');

        if ($this->isValidISBN10($start, $limit)) {

            for ($isbn_part = intval($start); $isbn_part <= intval($limit); $isbn_part++) {
                $interimISBN = str_pad($isbn_part, 9, '0', STR_PAD_LEFT);
                $isbn_10 = $interimISBN . $isbn->checkDigit->make10($interimISBN);
                $isbn_13 = $isbn->translate->to13($isbn_10);
                GoogleBookScraper::saveGoogleBookData($isbn_10, $isbn_13);
            }

        }
    }
}
