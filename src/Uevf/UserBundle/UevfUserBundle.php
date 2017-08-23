<?php

namespace Uevf\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UevfUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
