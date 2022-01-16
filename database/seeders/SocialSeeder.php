<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socials = [
            [
               'name'=>'facebook',
               'link'=>'https://www.facebook.com/',
            ],
            [
                'name'=>'twitter',
                'link'=>'https://twitter.com/',
            ],
            [
                'name'=>'linkedin',
                'link'=>'https://linkedin.com/',
            ],
            [
               'name'=>'instagram',
               'link'=>'https://www.instagram.com/',
            ],
            [
                'name'=>'youtube',
                'link'=>'https://www.youtube.com/',
            ],
            [
                'name'=>'whatsapp',
                'link'=>'https://wa.me/97450012660/',
            ],
        ];

        foreach ($socials as $key => $social) {
            $social = Social::create($social);
        }
    }
}
