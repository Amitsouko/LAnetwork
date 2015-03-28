<?php

namespace Lan\ProfileBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LanProfileBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
