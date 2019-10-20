<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class SiteConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $model = config('lq.site_config_class');

        $model::updateOrCreate(
            ['name' => 'MAIL_DRIVER'],
            [
                'name' => 'MAIL_DRIVER',
                'data' => 'smtp',
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'dropdown',
                    'values' => ['smtp', 'sendmail', 'mailgun', 'mandrill', 'ses', 'sparkpost', 'log', 'array'],
                    'defualt' => 'smtp',
                    'isMultiple' => false,
                ],
            ]
        );

        $model::updateOrCreate(
            ['name' => 'MAIL_HOST'],
            [
                'name' => 'MAIL_HOST',
                'data' => 'smtp.gmail.com',
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'text',
                ],
            ]
        );

        $model::updateOrCreate(
            ['name' => 'MAIL_PORT'],
            [
                'name' => 'MAIL_PORT',
                'data' => 587,
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'integer',
                ],
            ]
        );

        $model::updateOrCreate(
            ['name' => 'MAIL_FROM_ADDRESS'],
            [
                'name' => 'MAIL_FROM_ADDRESS',
                'data' => 'developerrupeshranjan@gmail.com',
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'text',
                ],
            ]
        );

        $model::updateOrCreate(
            ['name' => 'MAIL_FROM_NAME'],
            [
                'name' => 'MAIL_FROM_NAME',
                'data' => 'Example',
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'text',
                ],
            ]
        );

        $model::updateOrCreate(
            ['name' => 'MAIL_ENCRYPTION'],
            [
                'name' => 'MAIL_ENCRYPTION',
                'data' => 'tls',
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'text',
                ],
            ]
        );

        $model::updateOrCreate(
            ['name' => 'MAIL_USERNAME'],
            [
                'name' => 'MAIL_USERNAME',
                'data' => 'developerrupeshranjan@gmail.com',
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'text',
                    'secure' => false,
                ],
            ]
        );

        $model::updateOrCreate(
            ['name' => 'MAIL_PASSWORD'],
            [
                'name' => 'MAIL_PASSWORD',
                'data' => Crypt::encrypt('fhujvjnofexyssvj'),
                'config_group' => 'Email Configurations',
                'options' => [
                    'type' => 'text',
                    'secure' => true,
                ],
            ]
        );

        /*
         * General data
         */
        $model::updateOrCreate(
            ['name' => 'LOGO'],
            [
                'data' => '',
                'config_group' => 'General',
                'options' => [
                    'type' => 'file',
                    'fileType' => 'image',
                    'thumbnails' => [['width' => 450, 'height' => 300]],
                ],
                'autoload' => '1',
            ]
        );
        $model::updateOrCreate(
            ['name' => 'LOGO_HIGHLIGHT'],
            [
                'data' => '',
                'config_group' => 'General',
                'options' => [
                    'type' => 'file',
                    'fileType' => 'image',
                    'thumbnails' => [['width' => 450, 'height' => 300]],
                ],
                'autoload' => '1',
            ]
        );

        $model::updateOrCreate(
            ['name' => 'APPLICATION_NAME'],
            [
                'data' => 'Singsys',
                'config_group' => 'General',
                'options' => [
                    'type' => 'text',
                ],
                'autoload' => '1',
            ]
        );

        $model::updateOrCreate(
            ['name' => 'FIREBASE_API_KEY'],
            [
                'data' => 'AIzaSyC4B9AOGk6IXdREl46m8HU3StT1I6QaStY',
                'config_group' => 'Push Notification',
                'options' => [
                    'type' => 'text',
                ],
                'autoload' => '1',
            ]
        );

        $model::updateOrCreate(
            ['name' => 'FIREBASE_SERVER_KEY'],
            [
                'data' => 'AAAAP2_l6h0:APA91bGIaDldmJYHK2taoBp_fLDG6nyiVKtIHSLsFWLALFEChVMfVVeCftN2-GXsWkPFiL_-a9rbYF6wMWpOaigjZJvlebwoLWP9QviGjw_s865A4nCEOEO13hDA1FG4v4ou2mQNyqyT',
                'config_group' => 'Push Notification',
                'options' => [
                    'type' => 'textarea',
                ],
                'autoload' => '1',
            ]
        );

        $model::updateOrCreate(
            ['name' => 'FIREBASE_SENDER_ID'],
            [
                'data' => '272460278301',
                'config_group' => 'Push Notification',
                'options' => [
                    'type' => 'text',
                ],
                'autoload' => '1',
            ]
        );
    }
}
