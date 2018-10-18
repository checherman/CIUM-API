<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ViewClues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        DB::statement("CREATE VIEW `CluesView` AS
			SELECT  distinct
			c.clues,
			c.nombre,
			c.domicilio,
			c.codigoPostal,
			e.nombre as entidad,
			m.nombre as municipio,
			l.nombre as localidad,
			j.nombre as jurisdiccion, 
			j.clave as claveJurisdiccion,
			m.clave as claveMunicipio,
			l.clave as claveLocalidad,
			i.nombre as institucion,
			t.nombre as tipoUnidad,
			s.descripcion as estatus,
			s.clave as estado, 
			tg.nombre as tipologia, 
			pc.numeroLatitud as latitud, 
			pc.numeroLongitud as longitud
			FROM catalogosSSA.clues c
			LEFT JOIN catalogosSSA.entidadesFederativas e ON e.id = c.idEntidad
			LEFT JOIN catalogosSSA.municipios m ON m.id = c.idMunicipio
			LEFT JOIN catalogosSSA.localidades l ON l.id = c.idLocalidad
			LEFT JOIN catalogosSSA.jurisdicciones j ON j.id = c.idJurisdiccion
			LEFT JOIN catalogosSSA.instituciones i ON i.id = c.idInstitucion
			LEFT JOIN catalogosSSA.tiposUnidad t ON t.id = c.idTipoUnidad
			LEFT JOIN catalogosSSA.estatus s ON s.id = c.idEstatus
			LEFT JOIN catalogosSSA.pasoClues pc ON pc.clues = c.clues and pc.region is not null
			LEFT JOIN catalogosSSA.tipologias tg ON tg.id = c.idTipologia
			order by c.clues"
		);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW CluesView");
    }

}
