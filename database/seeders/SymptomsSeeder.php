<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Symptom::create(['name' => 'Febră']);
        Symptom::create(['name' => 'Tuse uscată']);
        Symptom::create(['name' => 'Anosmia (Pierderea mirosului)']);
        Symptom::create(['name' => 'Oboseală']);
        Symptom::create(['name' => 'Dureri musculare']);
        Symptom::create(['name' => 'Dispnee (Dificultate la respirație)']);
        Symptom::create(['name' => 'Durere în gât']);
        Symptom::create(['name' => 'Migrene']);
        Symptom::create(['name' => 'Senzație de disconfort în zona pieptului']);
        Symptom::create(['name' => 'Lipsă gust']);
        Symptom::create(['name' => 'Diaree']);
    }
}
