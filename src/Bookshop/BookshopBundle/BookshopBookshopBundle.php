<?php

namespace Bookshop\BookshopBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BookshopBookshopBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
