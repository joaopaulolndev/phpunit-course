<?php

class CustomSearchEngine {

    public function __construct($googleSearch)
    {
        $this->googlSearch = $googleSearch;
    }

    public function doStuff()
    {
        $this->googlSearch->doGoogleSearch(
            '00000000000000000000000000000000',
            'PHPUnit',
            0,
            1,
            false,
            '',
            false,
            '',
            '',
            ''
          );

          return 'something ...';

    }
}

