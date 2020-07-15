<i>Realizar un servicio API con PHP, sin framework, es más sencillo de lo que parece, con “cuatro líneas de código” ya podemos tener funcionando un servicio que reciba un POST con datos, aunque una versión muy sencilla que no realice apenas acciones ...</i>


En este y sucesivos artículos voy a realizar paso a paso el desarrollo de una sencilla API en PHP sin framework, que reciba un JSON y devuelva resultados.

Vamos a realizar una gestión sencilla de coches, tenemos unas marcas y unos modelos de coches con sus características, crearemos una aplicación CRUD, listado, alta, modificación y borrado a través de la API de las marcas, pero estos ejemplos no tendrán interface web o mobile, solo serán datos que se envían y reciben a través de una API.

En <b>api-cars-full</b> esta el proyecto completo de la API<br>
En <b>api-cars-chapters</b> esta la API desglosada por capítulos que corresponden a un artículo en <a href="https://netveloper.com">netveloper.com</a>

Listado de artículos en los que he divido la API en PHP explicada paso a paso
<ul>
<li><b>1 -</b> <a href="https://www.netveloper.com//crear-una-api-en-php-primeros-pasos-index.php" target=_blank>1 - Crear una API en PHP, Primeros pasos, index.php</a>
<li><b>2 -</b> <a href="https://www.netveloper.com//crear-una-api-en-php-añadiendo-funcionalidades" target=_blank>2 - Crear una API en PHP, añadiendo funcionalidades</a>
<li><b>3 -</b> <a href="https://www.netveloper.com//crear-una-api-en-php-clases-de-validacion-y-rutas" target=_blank>3 - Crear una API en PHP, clases de validación y rutas</a>
<li><b>4 -</b> <a href="https://www.netveloper.com//crear-una-api-en-php-clase-de-mensajes" target=_blank>4 - Crear una API en PHP, clase de mensajes</a>
<li><b>5 -</b><a href="https://www.netveloper.com//crear-una-api-en-php-listar-marcas-y-coches" target=_blank>5 - Crear una API en PHP, listar marcas y coches</a>
</ul>
Para probar la API utilizaremos la aplicación Postman. Aquí tenéis un artículo donde explica como utilizarlo, <a href="/probar-apis-con-postman" target="_blank">Probar APIs con Postman</a>.

<br><br>
<b>Recordar que no es una API REST y solo recibe por el método POST. En desarrollo (09/07/2020) convertir esta API en una API REST que acepta peticiones GET POST PUT y DELETE</b>, calculo que a final de la semana que viene podre publicar el código.

