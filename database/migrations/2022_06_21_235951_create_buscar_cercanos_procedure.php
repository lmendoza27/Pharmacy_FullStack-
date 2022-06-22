<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS get_cercanos;
            CREATE PROCEDURE get_cercanos (IN lat double, IN lon double)
            BEGIN
            SELECT
                nombre,
                dirección,
                6371 * acos(
                    cos(radians( lat )) *
                    cos(radians(latitud)) *
                    cos(radians(longitud) - radians( lon )) +
                    sin(radians( lat )) * sin(radians(latitud))
                    ) AS distancia
            FROM farmacias
            WHERE distancia > 1000
            ORDER BY distancia;
            END ;";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
