<h1>Trabajo Practico Final de Programación Web Dinámica</h1>
<h3>Consigna:</h3>
<h4>Objetivo:</h4>
<p>El objetivo del trabajo es integrar los conceptos vistos en la materia. Se espera que el
alumno implemente una tienda On-Line que tendrá 2 vistas: una vista “pública” y otra
“privada”.</p>
<p>Desde la vista pública se tiene acceso a la información de la tienda: dirección, medios
de contacto, descripción y toda aquella información que crea importante desplegar.
Además se podrá acceder a la vista privada de la aplicación, a partir del ingreso de un
usuario y contraseña válida.</p>
<p>Desde la vista privada, luego de concretar el proceso de autenticación y dependiendo los
roles con el que cuenta el usuario que ingresa al sistema, se van a poder realizar
diferentes operaciones. Los roles iniciales son: cliente, depósito y administrador.</p>
<h4>Pautas Básicas:</h4>
<ol>
  <li>La aplicación debe ser desarrollada sobre una arquitectura MVC (Modelo-VistaControl) utilizando PHP como lenguaje de programación. Se propone una
estructura de directorio inicial como la que se visualiza en la Ilustración 2.</li>
  <li> Se debe utilizar la Base de Datos bdcarritocompras otorgada por la cátedra.
Realizar el MOR de las tablas del modelo de base de datos de la Ilustración 1.
Verificar la estructura de las tablas y realizar las modificaciones que crea
necesarias.</li>
  <li>La aplicación tendrá páginas públicas y otras restringidas, que sólo podrán ser
accedidas a partir de un usuario y contraseña. Utilizar el módulo de autenticación
implementado en TP5. La aplicación debe tener como mínimo los siguientes
roles: cliente, depósito y administrador.</li>
  <li>El menú de la aplicación debe ser un menú dinámico que pueda ser gestionado
por el administrador de la aplicación. Las tablas de la base de datos vinculadas a
esta información son: menu y menurol.</li>
  <li>Cualquier usuario que tenga más de un rol asignado, puede cambiar de rol según
  lo desee.</li>
  <li>Desde la aplicación un usuario con rol Cliente podrá:
    <ul>
      <li>Gestionar los datos de su cuenta, como cambiar su e-mail y contraseña.</li>
      <li>Realizar la compra de uno o más productos con stock suficiente.</li>
    </ul>
  </li>
  
  <li>Desde la aplicación un usuario con rol Deposito podrá:
    <ul>
      <li>Crear nuevos productos y administrar los existentes.</li>
      <li>Acceder a los procedimientos que permite el cambio de estado de los
    productos.</li>
      <li>Modificar el stock de los productos.</li>
    </ul>
  </li>
  <li>Desde la aplicación un usuario con rol Administrador podrá:
    <ul>
      <li> Crear nuevos usuarios al sistema, asignar los roles correspondientes y
  actualizar la información que se requiera.</li>
      <li>Gestionar y administrar nuevos roles e ítem del menú. Vinculando item del
  menú al rol según corresponda</li>
    </ul>
  </li>
</ol>

<h2>GRUPO 11 </h2>
<h4>Alumnos:</h4> 
<ul>
  <li>Benitez Franco FAI-1696</li>
  <li>Corrales Abigail FAI-4251</li>
  <li>Vidal Santiago FAI-1722</li>
  <li>Quiñiñiren Melani FAI-886</li>
</ul>
