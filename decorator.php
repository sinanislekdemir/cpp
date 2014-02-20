<?php

interface Renderer
{
    public function render();
}
    
class DataCollection
{
    protected $data;

    public function __construct($new_data = array())
    {
        $this->data = $new_data;
    }
    
    public function render()
    {
        return $this->data;
    }

    public function setData($new_data)
    {
        $this->data = $new_data;
    }
}

abstract class Decorator
{
    protected $wrapped;

    public function __construct($wrappable)
    {
        $this->wrapped = $wrappable;
    }
}


class JsonDecorator extends Decorator implements Renderer
{
    public function render()
    {
        $output = $this->wrapped->render();
        return json_encode($output);
    }
}

class HTMLDecorator extends Decorator implements Renderer
{
    public function render()
    {
        $output = $this->wrapped->render();
        $body = '';
        foreach($output as $key => $value)
        {
            $body .= "<b>$key : </b> $value <br> \n";
        }
        return $body;
    }
}

$data = array('key' => 'value', 'basic' => 'test');

$data_collection = new DataCollection($data);
$json_render = new JsonDecorator($data_collection);
echo $json_render->render();

echo "\n";

$xml_render = new HTMLDecorator($data_collection);
echo $xml_render->render();
echo "\n";
