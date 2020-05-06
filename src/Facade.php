<?php

namespace Interficie\SpanishID\Facades;

use Illuminate\Support\Facades\Facade as OriginalFacade;

class Facade extends OriginalFacade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SpanishID'; // the IoC binding.
    }
}
