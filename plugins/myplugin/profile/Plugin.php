<?php namespace MyPlugin\Profile;

use System\Classes\PluginBase;
use Winter\User\Controllers\Users as UsersController;
use Winter\User\Models\User as UserModel;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot(){

        UserModel::extend(function($model){
            $model->addFillable([
                'facebook',
                'bio'
            ]);
        });

        UsersController::extendFormFields(function($form, $model, $context){
            $form->addTabFields([
                'facebook' => [
                    'label' => 'Facebook',
                    'type' => 'text',
                    'tab' => 'Profile'
                ],
                'bio' => [
                    'label' => 'Biografía',
                    'type' => 'textarea',
                    'tab' => 'Profile'
                ]
            ]);
        });
    }
}
