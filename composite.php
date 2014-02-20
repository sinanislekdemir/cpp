<?php

abstract class FormElement{
    abstract public function render();
}

class TextElement extends FormElement
{
    protected $label;
    public function __construct($new_label)
    {
        $this->label = $new_label;
    }
    public function render()
    {
        return $this->label;
    }
}

class TextInputElement extends FormElement
{
    protected $name, $value;
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return "<input type='text' name='$name' value='$value' />";
    }
}

class Form
{
    protected $elements;

    public function render()
    {
        $code = "";
        foreach($this->elements as $element)
        {
            $code .= $element->render();
        }
        return $code;
    }

    public function addElement(FormElement $element)
    {
        $this->elements[] = $element;
    }
}

$form = new Form();
$form->addElement(new TextElement('Hello metglobal'));
$form->addElement(new TextInputElement('username','User Name'));
echo $form->render();
echo "\n";
