**SMS Buddy**                                                                       

Aplicación de Facebook que permite actualizar el muro de un usuario            por medio de mensajes de texto

Implementado en PHP 5 y MysQL/PostgreSQL o cualquier BD soportada por ezsQL

Librerías externaS

 - ezSql (http://justinvincent.com/ezsql) para la persistencia en bases de datos por lo que se puede migrar fácilmente a otro proveedor de Base de datos. Para esto se edita el archivo de configuración config.php (https://github.com/ivanrodriguez/SMS-Buddy/blob/master/config.php)

**¿Cómo funciona?**

 1. Existe una aplicación registrada en Facebook, para lo cual se tiene las llaves API e identificadores.
 2. Un usuario autoriza la aplicación y registra el número de teléfono con el cuál quiere enviar los mensajes (por medio de OAuth 2).
 3. SMS Buddy gestiona la obtención de autorización con Facebook.
 4. SMS Buddy agrega un usuario a la aplicación (número de teléfono y llave para hacer peticiones).
 5. SMS Buddy recibe de alguna otra aplicación, el teléfono y mensaje de texto con los que algún usuario quiere actualizar su muro.
 6. SMS Buddy actualiza el estado en el muro si el número de teléfono está registrado en la aplicación.

Como se pueden dar cuenta debe existir una forma más segura de guardar la llave para hacer peticiones a Facebook a nombre del usuario.

¿La recepción de mensajes cómo se hace, qué se necesita?

 1. En las pruebas de SMS Buddy se utilizó una aplicación para Windows que se llama SMS Enabler (http://smsenabler.com/), la cual permite recibir y enviar mensajes SMS desde un teléfono conectado con un cable USB. En SMS Buddy se usa para que cuando reciba un mensaje, llame el script "publica.php" con la información del mensaje y número de teléfono del cual fue enviado.
 2. Existen también otras opciones para implementar la recepción de mensajes de texto. Hay proveedores como Twilio (http://www.twilio.com) o Bluevia (). Aunque estos servicios no son completamente gratuitos. También se puede desarrollar en Android/IPhone una aplicación que cuando reciba los SMS en el teléfono, reenvíe el mensaje al servidor de SMS Buddy. Incluso la aplicación completa se podría portar a Android pero a mí me interesan más las aplicaciones web y la comunicación con Facebook es más sencilla desde una aplicación web que desde una móvil.

Para estas nuevas implementaciones, sólo se debería redefinir la recepción de un mensaje en "publica.php" (https://github.com/ivanrodriguez/SMS-Buddy/blob/master/publica.php):

    $tel = $_POST['sender'];
    $msj = $_POST['text'];

En el caso donde se probó la aplicación, SMS Enabler, ésta llama "publica.php" enviando "sender=NUM_TEL_DEL_REMISOR" y "text=CONTENIDO_DEL_SMS" con la información del SMS.

**Descripción general de los archivoS**

#config.php
Archivo que contiene los datos para configurar SMS Buddy en distintos servidores y con distintas aplicaciones Facebook (direcciones, api keys, etc). Me gusta más la idea de leer esto de un XML o un JSON.

#dispatcher.php
Script que actua como despachador de solicitudes. La idea es que recibe un parámetro que es como una solicitud de atención. Con base en este parámetro, el dispatcher realiza alguna llamada o cálculo. Es como un punto central para comunicarse con los usuarios de la aplicación por medio de sus navegadores web.
 
# clases/ConexionBD.php
Es la interfaz con la base de datos, toma los datos para la conexión de "config.php". Esta clase es la que implementa la librería ezSQL.
Implementa el patrón singleton para quena el objeto se instancie sólo una vez.

# clases/GestorFbApi.php
Gestiona la integración de SMS Buddy con Facebook. Es quien pide los datos de un usuario, publica los mensajes en el muro y muy importante también gestiona el proceso de autorización de la aplicación a travpes de OAuth 2.

#clases/Usuario.php
Clase que representa a un usuario de la aplicación, el atributo "zugriff" es el que contiene la llave para hacer las peticiones pero como dije, es una gran debilidad de la aplicación porque no encripta absolutamente nada y la guarda tal cual en la tabla de la base de datos.

#clases/GestorPersistencia.php
Clase que gestiona la obtención y escritura de datos en la base de datos. Se comunica con la base de datos a través de la clase ConexionBD
