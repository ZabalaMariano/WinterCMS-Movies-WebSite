<?php namespace MyPlugin\Movies\Components;

use Cms\Classes\ComponentBase;
use Input;
use Validator;
use Redirect;
use MyPlugin\Movies\Models\Actor;
use Flash;
use ValidationException;
use System\Models\File;

class ActorForm extends ComponentBase
{

    public function componentDetails(){
        return [
            'name' => 'Actor Form',
            'description' => 'Crear nuevo actor desde frontend'
        ];
    }


    // public function onSave(){
    public function onSubmit(){

        $validator = Validator::make(
            $form = Input::all(), [
                'name' => 'required',
                'dob' => 'required'
            ]
        );

        if($validator->fails()){
            throw new ValidationException($validator);
        }

        $name = Input::get('name');

        $actor = new Actor();
        $actor->name = $name;
        $actor->slug = str_slug($name);
        $actor->dob = Input::get('dob');
        $actor->actorimage = Input::file('actorimage');
        $actor->save();

        Flash::success('¡Actor guardado exitosamente!');
    //    return Redirect::back();
    }

    // show image on frontend
    public function onImageUpload(){
        $image = Input::all();
        $file = (new File())->fromPost($image['actorimage']);
        return [
            '#imageResult' => '<div class="my-4"><img src="' . $file->getThumb(150,150,['mode' => 'crop']) . '" /></div>'
        ];
    }

}