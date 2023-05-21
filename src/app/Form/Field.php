<?php

namespace App\Form;

class Field
{
    public function __construct(public $model, public $attribute, public $type = 'text')
    {
    }

    public function __toString()
    {
        return sprintf(
            '
        <div class="mb-3">
        <label  class="form-label">%s</label>
        <input type="%s" name="%s" class="form-control %s" value="%s">
        </div>
        <div class = "%s">%s</div>
        ',
            ucwords($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'text-danger' : '',
            $this->model->getFirstError($this->attribute)

        );
    }

    public function setPassword()
    {
        $this->type = 'password';
        return $this;
    }

    public function setEmail()
    {
        $this->type = 'email';
        return $this;
    }
}
