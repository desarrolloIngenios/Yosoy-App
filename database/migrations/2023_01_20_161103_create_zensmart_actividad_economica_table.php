<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZensmartActividadEconomicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zensmart_actividad_economica', function (Blueprint $table) {
            $table->id();
            $table->string('ciiu219');
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zensmart_actividad_economica');
    }
}

/*

INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('111','Cultivo de cereales (excepto arroz), legumbres y semillas oleaginosas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('112','Cultivo de arroz');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('113','Cultivo de hortalizas, raíces y tubérculos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('114','Cultivo de tabaco');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('115','Cultivo de plantas textiles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('119','Otros cultivos transitorios n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('121','Cultivo de frutas tropicales y subtropicales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('122','Cultivo de plátano y banano');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('123','Cultivo de café');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('124','Cultivo de caña de azúcar');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('125','Cultivo de flor de corte');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('126','Cultivo de palma para aceite (palma africana) y otros frutos oleaginosos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('127','Cultivo de plantas con las que se prepararan bebidas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('128','Cultivo de especias y de plantas aromáticas y medicinales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('129','Otros cultivos permanentes n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('130','Propagación de plantas (actividades de los viveros, excepto viveros forestales)');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('141','Cría de ganado bovino y bufalino');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('142','Cría de caballos y otros equinos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('143','Cría de ovejas y cabras');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('144','Cría de ganado porcino');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('145','Cría de aves de corral');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('149','Cría de otros animales n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('150','Explotación primaria mixta (agrícola y pecuaria)');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('161','Actividades de apoyo a la agricultura');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('162','Actividades de apoyo a la ganadería');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('163','Actividades posteriores a la cosecha');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('164','Tratamiento de semillas para propagación');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('170','Caza ordinaria y mediante trampas y actividades de servicios conexas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('210','Silvicultura y otras actividades forestales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('220','Extracción de madera');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('230','Recolección de productos forestales diferentes a la madera');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('240','Servicios de apoyo a la silvicultura');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('311','Pesca marítima');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('312','Pesca de agua dulce');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('321','Acuicultura marítima');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('322','Acuicultura de agua dulce');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('510','Extracción de hulla (carbón de piedra)');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('520','Extracción de carbón lignito');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('610','Extracción de petróleo crudo');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('620','Extracción de gas natural');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('710','Extracción de minerales de hierro');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('721','Extracción de minerales de uranio y de torio');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('722','Extracción de oro y otros metales preciosos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('723','Extracción de minerales de níquel');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('729','Extracción de otros minerales metalíferos no ferrosos n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('811','Extracción de piedra, arena, arcillas comunes, yeso y anhidrita');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('812','Extracción de arcillas de uso industrial, caliza, caolín y bentonitas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('820','Extracción de esmeraldas, piedras preciosas y semipreciosas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('891','Extracción de minerales para la fabricación de abonos y productos químicos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('892','Extracción de halita (sal)');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('899','Extracción de otros minerales no metálicos n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('910','Actividades de apoyo para la extracción de petróleo y de gas natural');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('990','Actividades de apoyo para otras actividades de explotación de minas y canteras');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1011','Procesamiento y conservación de carne y productos cárnicos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1012','Procesamiento y conservación de pescados, crustáceos y moluscos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1030','Elaboración de aceites y grasas de origen vegetal y animal');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1051','Elaboración de productos de molinería');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1052','Elaboración de almidones y productos derivados del almidón');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1061','Trilla de café');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1062','Descafeinado, tostión y molienda del café');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1063','Elaboración de otros derivados del café');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1071','Elaboración y refinación de azúcar');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1072','Elaboración de panela');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1081','Elaboración de productos de panadería');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1082','Elaboración de cacao, chocolate y productos de confitería');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1083','Elaboración de macarrones, fideos, alcuzcuz y productos farináceos similares');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1084','Elaboración de comidas y platos preparados');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1089','Elaboración de otros productos alimenticios n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1090','Elaboración de alimentos preparados para animales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1101','Destilación, rectificación y mezcla de bebidas alcohólicas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1102','Elaboración de bebidas fermentadas no destiladas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1103','Producción de malta, elaboración de cervezas y otras bebidas malteadas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1104','Elaboración de bebidas no alcohólicas, producción de aguas minerales y de otras aguas embotelladas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1200','Elaboración de productos de tabaco');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1311','Preparación e hilatura de fibras textiles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1312','Tejeduría de productos textiles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1313','Acabado de productos textiles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1391','Fabricación de tejidos de punto y ganchillo');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1392','Confección de artículos con materiales textiles, excepto prendas de vestir');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1393','Fabricación de tapetes y alfombras para pisos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1394','Fabricación de cuerdas, cordeles, cables, bramantes y redes');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1399','Fabricación de otros artículos textiles n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1410','Confección de prendas de vestir, excepto prendas de piel');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1511','Curtido y recurtido de cueros; recurtido y teñido de pieles.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1512','Fabricación de artículos de viaje, bolsos de mano y artículos similares elaborados en cuero, y fabricación de artículos de talabartería y guarnicionería.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1513','Fabricación de artículos de viaje, bolsos de mano y artículos similares; artículos de talabartería y guarnicionería elaborados en otros materiales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1521','Fabricación de calzado de cuero y piel, con cualquier tipo de suela');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1522','Fabricación de otros tipos de calzado, excepto calzado de cuero y piel');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1523','Fabricación de partes del calzado');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1610','Aserrado, acepillado e impregnación de la madera');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1620','Fabricación de hojas de madera para enchapado; fabricación de tableros contrachapados, tableros laminados, tableros de partículas y otros tableros y paneles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1630','Fabricación de partes y piezas de madera, de carpintería y ebanistería para la construcción y para edificios');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1640','Fabricación de recipientes de madera');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1690','Fabricación de otros productos de madera; fabricación de artículos de corcho, cestería y espartería');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1701','Fabricación de pulpas (pastas) celulósicas; papel y cartón');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1702','Fabricación de papel y cartón ondulado (corrugado); fabricación de envases, empaques y de embalajes de papel y cartón.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1709','Fabricación de otros artículos de papel y cartón');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1811','Actividades de impresión');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1812','Actividades de servicios relacionados con la impresión');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1820','Producción de copias a partir de grabaciones originales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1910','Fabricación de productos de hornos de coque');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1921','Fabricación de productos de la refinación del petróleo');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('1922','Actividad de mezcla de combustibles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2011','Fabricación de sustancias y productos químicos básicos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2012','Fabricación de abonos y compuestos inorgánicos nitrogenados');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2013','Fabricación de plásticos en formas primarias');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2014','Fabricación de caucho sintético en formas primarias');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2021','Fabricación de plaguicidas y otros productos químicos de uso agropecuario');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2022','Fabricación de pinturas, barnices y revestimientos similares, tintas para impresión y masillas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2023','Fabricación de jabones y detergentes, preparados para limpiar y pulir; perfumes y preparados de tocador');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2029','Fabricación de otros productos químicos n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2030','Fabricación de fibras sintéticas y artificiales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2100','Fabricación de productos farmacéuticos, sustancias químicas medicinales y productos botánicos de uso farmacéutico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2211','Fabricación de llantas y neumáticos de caucho');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2212','Reencauche de llantas usadas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2219','Fabricación de formas básicas de caucho y otros productos de caucho n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2219','Fabricación de formas básicas de caucho y otros productos de caucho n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2221','Fabricación de formas básicas de plástico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2229','Fabricación de artículos de plástico n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2310','Fabricación de vidrio y productos de vidrio');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2391','Fabricación de productos refractarios');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2392','Fabricación de materiales de arcilla para la construcción');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2393','Fabricación de otros productos de cerámica y porcelana');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2394','Fabricación de cemento, cal y yeso');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2395','Fabricación de artículos de hormigón, cemento y yeso');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2396','Corte, tallado y acabado de la piedra');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2399','Fabricación de otros productos minerales no metálicos n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2410','Industrias básicas de hierro y de acero');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2421','Industrias básicas de metales preciosos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2429','Industrias básicas de otros metales no ferrosos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2431','Fundición de hierro y de acero');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2432','Fundición de metales no ferrosos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2511','Fabricación de productos metálicos para uso estructural');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2512','Fabricación de tanques, depósitos y recipientes de metal, excepto los utilizados para el envase o transporte de mercancías');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2513','Fabricación de generadores de vapor, excepto calderas de agua caliente para calefacción central');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2520','Fabricación de armas y municiones');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2591','Forja, prensado, estampado y laminado de metal; pulvimetalurgia');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2592','Tratamiento y revestimiento de metales; mecanizado');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2593','Fabricación de artículos de cuchillería, herramientas de mano y artículos de ferretería');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2599','Fabricación de otros productos elaborados de metal n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2610','Fabricación de componentes y tableros electrónicos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2620','Fabricación de computadoras y de equipo periférico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2630','Fabricación de equipos de comunicación');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2640','Fabricación de aparatos electrónicos de consumo');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2651','Fabricación de equipo de medición, prueba, navegación y control');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2652','Fabricación de relojes');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2660','Fabricación de equipo de irradiación y equipo electrónico de uso médico y terapéutico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2670','Fabricación de instrumentos ópticos y equipo fotográfico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2680','Fabricación de soportes magnéticos y ópticos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2711','Fabricación de motores, generadores y transformadores eléctricos.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2712','Fabricación de aparatos de distribución y control de la energía eléctrica');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2720','Fabricación de pilas, baterías y acumuladores eléctricos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2731','Fabricación de hilos y cables eléctricos y de fibra óptica');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2732','Fabricación de dispositivos de cableado');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2740','Fabricación de equipos eléctricos de iluminación');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2750','Fabricación de aparatos de uso domestico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2790','Fabricación de otros tipos de equipo eléctrico n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2811','Fabricación de motores, turbinas, y partes para motores de combustión interna');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2812','Fabricación de equipos de potencia hidráulica y neumática');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2813','Fabricación de otras bombas, compresores, grifos y válvulas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2814','Fabricación de cojinetes, engranajes, trenes de engranajes y piezas de transmisión');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2815','Fabricación de hornos, hogares y quemadores industriales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2816','Fabricación de equipo de elevación y manipulación');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2817','Fabricación de maquinaria y equipo de oficina (excepto computadoras y equipo periférico)');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2818','Fabricación de herramientas manuales con motor');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2819','Fabricación de otros tipos de maquinaria y equipo de uso general n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2821','Fabricación de maquinaria agropecuaria y forestal');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2822','Fabricación de máquinas formadoras de metal y de máquinas herramienta');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2823','Fabricación de maquinaria para la metalurgia');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2824','Fabricación de maquinaria para explotación de minas y canteras y para obras de construcción');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2825','Fabricación de maquinaria para la elaboración de alimentos, bebidas y tabaco');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2826','Fabricación de maquinaria para la elaboración de productos textiles, prendas de vestir y cueros');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2829','Fabricación de otros tipos de maquinaria y equipo de uso especial n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2910','Fabricación de vehículos automotores y sus motores');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2920','Fabricación de carrocerías para vehículos automotores; fabricación de remolques y semirremolques');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('2930','Fabricación de partes, piezas (autopartes) y accesorios (lujos) para vehículos automotores');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3011','Construcción de barcos y de estructuras flotantes');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3012','Construcción de embarcaciones de recreo y deporte');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3020','Fabricación de locomotoras y de material rodante para ferrocarriles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3030','Fabricación de aeronaves, naves espaciales y de maquinaria conexa');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3040','Fabricación de vehículos militares de combate');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3091','Fabricación de motocicletas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3092','Fabricación de bicicletas y de sillas de ruedas para personas con discapacidad');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3099','Fabricación de otros tipos de equipo de transporte n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3110','Fabricación de muebles');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3120','Fabricación de colchones y somieres');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3210','Fabricación de joyas, bisutería y artículos conexos');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3220','Fabricación de instrumentos musicales');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3230','Fabricación de artículos y equipo para la práctica del deporte   (excepto prendas de vestir y calzado)');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3240','Fabricación de juegos, juguetes y rompecabezas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3250','Fabricación de instrumentos, aparatos y materiales médicos y odontológicos (incluido mobiliario)');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3290','Otras industrias manufactureras n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3311','Mantenimiento y reparación especializado de productos elaborados en metal');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3312','Mantenimiento y reparación especializado de maquinaria y equipo');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3313','Mantenimiento y reparación especializado de equipo electrónico y óptico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3314','Mantenimiento y reparación especializado de equipo eléctrico');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3315','Mantenimiento y reparación especializado de equipo de transporte, excepto los vehículos automotores, motocicletas y bicicletas');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3319','Mantenimiento y reparación de otros tipos de equipos y sus componentes n.c.p.');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3320','Instalación especializada de maquinaria y equipo industrial');
INSERT INTO zensmart_actividad_economica (ciiu219,descripcion) VALUES ('3511','Generación de energía eléctrica');


*/
