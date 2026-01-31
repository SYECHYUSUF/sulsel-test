<?php

namespace Database\Seeders;

use App\Models\Sosmed;
use Illuminate\Database\Seeder;

class SosmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = [
            [
                'id_sosmed' => 1,
                'sosmed' => 'Facebook',
                'judul' => 'Facebook',
                'link_sosmed' => 'https://www.facebook.com/ppidsulsel',
                'icon_sosmed' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>',
                'urutan' => 1,
            ],
            [
                'id_sosmed' => 2,
                'sosmed' => 'Twitter',
                'judul' => 'Twitter',
                'link_sosmed' => 'https://twitter.com/ppidsulsel',
                'icon_sosmed' => '<path d="M4 4l11.733 16h4.267l-11.733 -16z M4 20l6.768 -6.768 M13.232 10.768l6.768 -6.768"></path>',
                'urutan' => 2,
            ],
            [
                'id_sosmed' => 3,
                'sosmed' => 'Instagram',
                'judul' => 'Instagram',
                'link_sosmed' => 'https://www.instagram.com/ppidsulsel',
                'icon_sosmed' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>',
                'urutan' => 3,
            ],
            [
                'id_sosmed' => 4,
                'sosmed' => 'YouTube',
                'judul' => 'YouTube',
                'link_sosmed' => 'https://www.youtube.com/@ppidsulsel',
                'icon_sosmed' => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.14 1 12 1 12s0 3.86.46 5.58a2.78 2.78 0 0 0 1.94 2c1.72.42 8.6.42 8.6.42s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.86 23 12 23 12s0-3.86-.46-5.58z"></path><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"></polygon>',
                'urutan' => 4,
            ],
        ];

        foreach ($socials as $social) {
            Sosmed::updateOrCreate(['id_sosmed' => $social['id_sosmed']], $social);
        }
    }
}
