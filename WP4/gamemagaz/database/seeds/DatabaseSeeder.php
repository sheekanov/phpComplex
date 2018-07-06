<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //добавление настройки для email в таблицу settings
        $orderEmail = new \App\Setting();
        $orderEmail->name = 'order_email';
        $orderEmail->value = 'sheekanov@gmail.com';
        $orderEmail->save();
    }
}
