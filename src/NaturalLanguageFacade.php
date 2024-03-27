<?php

namespace Coxlr\NaturalLanguage;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Coxlr\NaturalLanguage\NaturalLanguage
 */
class NaturalLanguageFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-natural-language';
    }
}
