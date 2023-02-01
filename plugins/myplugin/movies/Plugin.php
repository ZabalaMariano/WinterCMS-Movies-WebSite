<?php namespace MyPlugin\Movies;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'MyPlugin\Movies\Components\Actors' => 'actors'
        ];
    }

    public function registerSettings()
    {
    }
}
