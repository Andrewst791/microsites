<?php

namespace App\Constants;

enum InputType
{
    case TEXT;
    case NUMBER;
    case CHECKBOX;
    case SELECT;
    case EMAIL;
    case TEXTAREA;
    case RADIO;
}
