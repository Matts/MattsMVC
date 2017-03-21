<?php

namespace Matts\Annotations;


/**
 * MattsMVC
 *
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/20/2017
 *
 * @Annotation
 */
class Permission
{
    public $authenticated=false;
    public $roleRequired;

}