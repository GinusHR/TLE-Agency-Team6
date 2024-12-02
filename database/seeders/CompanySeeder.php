<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Albert Heijn',
                'logo' => null,
                'image' => null,
                'homepage_url' => 'https://www.ah.nl/',
                'about_us_url' => 'https://www.ah.nl/over-ah',
                'contact_url' => 'https://werk.ah.nl/',
                'description' => 'Bij Albert Heijn geloven we dat eten en drinken een essentiële rol speelt in het oplossen van de grote uitdagingen in de maatschappij. Het levert een belangrijke bijdrage aan een gezonde levensstijl, het verbindt mensen met elkaar en draagt bij aan een beter klimaat en daarmee een duurzame samenleving. Daarom hebben wij bij Albert Heijn een missie: Samen beter eten bereikbaar maken. Voor iedereen.',
                'login_code' => '048118392',
                'password' => bcrypt('0000'),
            ],
            [
                'name' => 'McDonalds',
                'logo' => null,
                'image' => null,
                'homepage_url' => 'https://www.mcdonalds.com/nl/nl-nl.html',
                'about_us_url' => 'https://www.mcdonalds.com/nl/nl-nl/over-ons.html',
                'contact_url' => 'https://www.mcdonalds.com/nl/nl-nl/werkenbij.html',
                'description' => 'Wist je dat McDonald’s de grootste restaurantketen ter wereld is? Hierdoor hebben we een indrukwekkende geschiedenis. Maar wij kijken liever naar onze toekomst. Nieuwe restaurants, betere producten en duurzaam ondernemen. Wil je meer weten over McDonald’s? Lees verder!',
                'login_code' => '2198410',
                'password' => bcrypt('0000'),
            ],
        ];
        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
