<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = array(
            //México
            array('name' => "Aguascalientes",'country_id' => 1),
            array('name' => "Baja California",'country_id' => 1),
            array('name' => "Baja California Sur",'country_id' => 1),
            array('name' => "Campeche",'country_id' => 1),
            array('name' => "Chiapas",'country_id' => 1),
            array('name' => "Chihuahua",'country_id' => 1),
            array('name' => "Coahuila",'country_id' => 1),
            array('name' => "Colima",'country_id' => 1),
            array('name' => "Distrito Federal",'country_id' => 1),
            array('name' => "Durango",'country_id' => 1),
            array('name' => "Estado de Mexico",'country_id' => 1),
            array('name' => "Guanajuato",'country_id' => 1),
            array('name' => "Guerrero",'country_id' => 1),
            array('name' => "Hidalgo",'country_id' => 1),
            array('name' => "Jalisco",'country_id' => 1),
            array('name' => "Mexico",'country_id' => 1),
            array('name' => "Michoacan",'country_id' => 1),
            array('name' => "Morelos",'country_id' => 1),
            array('name' => "Nayarit",'country_id' => 1),
            array('name' => "Nuevo Leon",'country_id' => 1),
            array('name' => "Oaxaca",'country_id' => 1),
            array('name' => "Puebla",'country_id' => 1),
            array('name' => "Queretaro",'country_id' => 1),
            array('name' => "Quintana Roo",'country_id' => 1),
            array('name' => "San Luis Potosi",'country_id' => 1),
            array('name' => "Sinaloa",'country_id' => 1),
            array('name' => "Sonora",'country_id' => 1),
            array('name' => "Tabasco",'country_id' => 1),
            array('name' => "Tamaulipas",'country_id' => 1),
            array('name' => "Tlaxcala",'country_id' => 1),
            array('name' => "Veracruz",'country_id' => 1),
            array('name' => "Yucatan",'country_id' => 1),
            array('name' => "Zacatecas",'country_id' => 1),
            //United Stated
            array('name' => "Alabama",'country_id' => 2),
            array('name' => "Alaska",'country_id' => 2),
            array('name' => "Arizona",'country_id' => 2),
            array('name' => "Arkansas",'country_id' => 2),
            array('name' => "Byram",'country_id' => 2),
            array('name' => "California",'country_id' => 2),
            array('name' => "Cokato",'country_id' => 2),
            array('name' => "Colorado",'country_id' => 2),
            array('name' => "Connecticut",'country_id' => 2),
            array('name' => "Delaware",'country_id' => 2),
            array('name' => "District of Columbia",'country_id' => 2),
            array('name' => "Florida",'country_id' => 2),
            array('name' => "Georgia",'country_id' => 2),
            array('name' => "Hawaii",'country_id' => 2),
            array('name' => "Idaho",'country_id' => 2),
            array('name' => "Illinois",'country_id' => 2),
            array('name' => "Indiana",'country_id' => 2),
            array('name' => "Iowa",'country_id' => 2),
            array('name' => "Kansas",'country_id' => 2),
            array('name' => "Kentucky",'country_id' => 2),
            array('name' => "Louisiana",'country_id' => 2),
            array('name' => "Lowa",'country_id' => 2),
            array('name' => "Maine",'country_id' => 2),
            array('name' => "Maryland",'country_id' => 2),
            array('name' => "Massachusetts",'country_id' => 2),
            array('name' => "Medfield",'country_id' => 2),
            array('name' => "Michigan",'country_id' => 2),
            array('name' => "Minnesota",'country_id' => 2),
            array('name' => "Mississippi",'country_id' => 2),
            array('name' => "Missouri",'country_id' => 2),
            array('name' => "Montana",'country_id' => 2),
            array('name' => "Nebraska",'country_id' => 2),
            array('name' => "Nevada",'country_id' => 2),
            array('name' => "New Hampshire",'country_id' => 2),
            array('name' => "New Jersey",'country_id' => 2),
            array('name' => "New Jersy",'country_id' => 2),
            array('name' => "New Mexico",'country_id' => 2),
            array('name' => "New York",'country_id' => 2),
            array('name' => "North Carolina",'country_id' => 2),
            array('name' => "North Dakota",'country_id' => 2),
            array('name' => "Ohio",'country_id' => 2),
            array('name' => "Oklahoma",'country_id' => 2),
            array('name' => "Ontario",'country_id' => 2),
            array('name' => "Oregon",'country_id' => 2),
            array('name' => "Pennsylvania",'country_id' => 2),
            array('name' => "Ramey",'country_id' => 2),
            array('name' => "Rhode Island",'country_id' => 2),
            array('name' => "South Carolina",'country_id' => 2),
            array('name' => "South Dakota",'country_id' => 2),
            array('name' => "Sublimity",'country_id' => 2),
            array('name' => "Tennessee",'country_id' => 2),
            array('name' => "Texas",'country_id' => 2),
            array('name' => "Trimble",'country_id' => 2),
            array('name' => "Utah",'country_id' => 2),
            array('name' => "Vermont",'country_id' => 2),
            array('name' => "Virginia",'country_id' => 2),
            array('name' => "Washington",'country_id' => 2),
            array('name' => "West Virginia",'country_id' => 2),
            array('name' => "Wisconsin",'country_id' => 2),
            array('name' => "Wyoming",'country_id' => 2),
        );
        State::insert($states);
    }
}
