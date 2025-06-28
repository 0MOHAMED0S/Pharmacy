<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseaseAdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('disease_advice')->insert([
            ['disease' => 'none', 'advice' => 'Get at least 7–8 hours of sleep daily.'],
            ['disease' => 'none', 'advice' => 'Drink plenty of water throughout the day.'],
            ['disease' => 'none', 'advice' => 'Take breaks from screen time and stretch regularly.'],
            ['disease' => 'none', 'advice' => 'Have regular checkups and health screenings.'],
            ['disease' => 'none', 'advice' => 'Stay socially connected and mentally engaged.'],
            ['disease' => 'heart', 'advice' => 'Avoid trans fats and reduce cholesterol intake.'],
            ['disease' => 'heart', 'advice' => 'Do 30 minutes of aerobic exercise most days.'],
            ['disease' => 'heart', 'advice' => 'Manage stress with yoga or deep breathing.'],
            ['disease' => 'heart', 'advice' => 'Quit smoking and avoid secondhand smoke.'],
            ['disease' => 'heart', 'advice' => 'Take prescribed medications regularly.'],
            ['disease' => 'hypertension', 'advice' => 'Limit caffeine and alcohol consumption.'],
            ['disease' => 'hypertension', 'advice' => 'Practice stress-relieving activities like meditation.'],
            ['disease' => 'hypertension', 'advice' => 'Monitor your blood pressure regularly at home.'],
            ['disease' => 'hypertension', 'advice' => 'Include potassium-rich foods like bananas and spinach.'],
            ['disease' => 'hypertension', 'advice' => 'Maintain a healthy weight through consistent exercise.'],
            ['disease' => 'asthma', 'advice' => 'Always carry your inhaler and use as prescribed.'],
            ['disease' => 'asthma', 'advice' => 'Keep your environment free of dust and mold.'],
            ['disease' => 'asthma', 'advice' => 'Practice breathing exercises daily.'],
            ['disease' => 'asthma', 'advice' => 'Avoid cold air and sudden temperature changes.'],
            ['disease' => 'asthma', 'advice' => 'Stay up-to-date with flu vaccinations.'],
            ['disease' => 'diabetes', 'advice' => 'Eat balanced meals with whole grains and low sugar.'],
            ['disease' => 'diabetes', 'advice' => 'Exercise regularly to maintain healthy glucose levels.'],
            ['disease' => 'diabetes', 'advice' => 'Avoid sugary drinks and processed snacks.'],
            ['disease' => 'diabetes', 'advice' => 'Monitor carbohydrate intake closely.'],
            ['disease' => 'diabetes', 'advice' => 'Have regular foot and eye checkups.'],

        ]);
    }
}
