<?php

/**
 * Set up custom Parent role for Parent zone membership.
 */

namespace Hwale\Core;

class ParentRole
{
    private function addParentRole()
    {
        add_action('init', fn() => add_role('parent', 'Parent', get_role('subscriber')->capabilities));
    }

    public function __construct()
    {
        $this->addParentRole();
    }
}
