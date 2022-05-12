<?php

Breadcrumbs::for('inicio', function ($trail) {
    $trail->push('Inicio', url('/'));
});

/*home*/
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Administración', route('home'));
});
/*estadios*/
Breadcrumbs::for('estadios', function ($trail) {
    $trail->parent('home');
    $trail->push('Estadios', route('estadios'));
});
Breadcrumbs::for('crearEstadio', function ($trail) {
    $trail->parent('estadios');
    $trail->push('Crear estadio', route('crearEstadio'));
});

Breadcrumbs::for('estadiosEditar', function ($trail,$estadio) {
    $trail->parent('estadios');
    $trail->push('Actualizar '.$estadio->nombre, route('estadiosEditar',$estadio->id));
});
/*usuarios*/
Breadcrumbs::for('usuarios', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('usuarios'));
});
Breadcrumbs::for('crearUsuario', function ($trail) {
    $trail->parent('usuarios');
    $trail->push('Crear usuario', route('crearUsuario'));
});
Breadcrumbs::for('editarUsuario', function ($trail,$usuario) {
    $trail->parent('usuarios');
    $trail->push('Actualizar '.$usuario->email, route('editarUsuario',$usuario->id));
});

/*seguridades*/
/*roles*/
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles'));
});

/*Campeonato*/
Breadcrumbs::for('campeonatos', function ($trail) {
    $trail->parent('home');
    $trail->push('Campeonatos', route('campeonatos'));
});
Breadcrumbs::for('crearCampeonato', function ($trail) {
    $trail->parent('campeonatos');
    $trail->push('Crear campeonato', route('crearCampeonato'));
});
Breadcrumbs::for('actualizarCampeonato', function ($trail,$campeonato) {
    $trail->parent('campeonatos');
    $trail->push('Actualizar campeonato '.$campeonato->nombre, route('actualizarCampeonato',$campeonato));
});

/*serieries*/

Breadcrumbs::for('series', function ($trail,$genero) {
    $trail->parent('campeonatos');
    $trail->push('Series en categoria '.$genero->generoEquipo->nombre, route('series',$genero->id));
});

/*Asignacion menu*/
Breadcrumbs::for('asignacion-menu', function ($trail,$asignacion) {
    $trail->parent('campeonatos');
     $trail->push('Serie '. $asignacion->unoGeneroSerie->serie->nombre,route('series',$asignacion->unoGeneroSerie->genero->id));
    $trail->push('Asignacion '.$asignacion->equipos->nombre, route('asignacion',$asignacion->id));
});

Breadcrumbs::for('nomina-menu', function ($trail,$asignacion) {
    $trail->parent('asignacion-menu',$asignacion);  
    $trail->push('Nomina '.$asignacion->equipos->nombre, route('asignacion',$asignacion->id));
});

// Equipos en serie
Breadcrumbs::for('asignarEquiposAserie', function ($trail,$generoSerie) {
    $trail->parent('series',$generoSerie->genero);
    $trail->push('Equipos en serie '.$generoSerie->serie->nombre, route('asignarEquiposAserie',$generoSerie->id));
});


/*Equipos*/
Breadcrumbs::for('categorias', function ($trail) {
    $trail->parent('home');
    $trail->push('Categorias', route('categorias'));
});

Breadcrumbs::for('Nomina-equipos-jugador', function ($trail,$equipo) {
    $trail->parent('categorias');
    $trail->push('Nómina Jugadores', route('listado-jugadores-nomina',$equipo->id));
});

Breadcrumbs::for('Crear-equipos-jugador', function ($trail,$equipo) {
    $trail->parent('Nomina-equipos-jugador',$equipo);
    $trail->push('Crear Jugadores', route('crear-jugador-equipo',$equipo->id));
});

Breadcrumbs::for('editar-foto-equipos-jugador', function ($trail,$equipo) {
    $trail->parent('Nomina-equipos-jugador',$equipo);
    $trail->push('Editar foto jugadores', route('actualizar-foto-jugador',$equipo->id));
});

Breadcrumbs::for('vista-jugador', function ($trail,$equipo) {
    $trail->parent('Nomina-equipos-jugador',$equipo);
    $trail->push('Vista jugador', route('vista-jugador',$equipo->id));
});

Breadcrumbs::for('equipos', function ($trail,$generos) {   
     $trail->parent('categorias');
    $trail->push('Categorias Tipo ' . $generos->nombre, route('equipos',$generos->id));
});

Breadcrumbs::for('crear-equipos', function ($trail,$generos) {   
     $trail->parent('categorias');
     $trail->push('Equipos Tipo ' . $generos->nombre, route('equipos',$generos->id));
    $trail->push('Crear Equipo Tipo ' . $generos->nombre, route('crear-equipos',$generos->id));
});
Breadcrumbs::for('editar-equipos', function ($trail,$equipo) {       
    $trail->parent('categorias');
    $trail->push('Equipos Tipo ' . $equipo->genero->nombre, route('equipos',$equipo->genero->id));

});
Breadcrumbs::for('mis-equipos', function ($trail) {       
   $trail->parent('home');
    $trail->push('Mis Equipos', route('mis-equipos'));     
});
Breadcrumbs::for('editar-mi-equipo', function ($trail,$equipo) {       
   $trail->parent('home');
    $trail->push('Mis Equipos', route('mis-equipos')); 
    $trail->push('Editar Equipo'.' '.$equipo->nombre, route('editar-mi-equipo',$equipo->id));     
});

/*etapas y genero serie*/
Breadcrumbs::for('etapas-serie-genero', function ($trail,$serieGenero) {
    $trail->parent('series',$serieGenero->genero);
    $trail->push('Etapas serie '.$serieGenero->serie->nombre, route('etapas-serie',$serieGenero->id));
});

Breadcrumbs::for('fechas-etapa', function ($trail,$etapaSerie) {
    $trail->parent('etapas-serie-genero',$etapaSerie->generoSerie);
    $trail->push('Fechas etapa  '.$etapaSerie->generoSerie->serie->nombre, route('fechas-etapa',$etapaSerie->id));
});

Breadcrumbs::for('fecha-etapa', function ($trail,$fecha) {
    $trail->parent('fechas-etapa',$fecha->etapaSerie);
    $trail->push('Fechas'. ' '. $fecha->fechaInicio , route('fecha',$fecha->id));
});

Breadcrumbs::for('alineacion', function ($trail,$partido) {
    $trail->parent('fecha-etapa',$partido->fecha);
    $trail->push('Alineacion ', route('alineacion',[$partido->id,$partido->id]));
});

/*nominas*/
Breadcrumbs::for('nomina-mi-equipo', function ($trail,$equipo) {       
   $trail->parent('home');
    $trail->push('Mis Equipos', route('mis-equipos')); 
    $trail->push('Nomina '.' '.$equipo->nombre, route('nomina',$equipo->id));     
});

Breadcrumbs::for('nomina-jugadores-representante', function ($trail,$equipo) {       
   $trail->parent('home');
    $trail->push('Mis Equipos', route('mis-equipos')); 
    $trail->push('Nómina  '.' '.$equipo->nombre, route('nomina',$equipo->id));     
});

Breadcrumbs::for('crear-jugadores-equipo', function ($trail,$equipo) {       
   $trail->parent('home');
    $trail->push('Mis Equipos', route('mis-equipos'));
    $trail->push('Nómina  '.' '.$equipo->nombre, route('nomina',Crypt::encryptString($equipo->id))); 
    $trail->push('Nuevo jugador de '.' '.$equipo->nombre, route('crear-jugador',$equipo->id));     
});

Breadcrumbs::for('editar-foto-jugador', function ($trail,$equipo) {       
   $trail->parent('home');
    $trail->push('Mis Equipos', route('mis-equipos'));
    $trail->push('Nómina  '.' '.$equipo->nombre, route('nomina',Crypt::encryptString($equipo->id))); 
    $trail->push('Editar imagen del jugador ', route('editar-foto-jugador',$equipo->id));     
});

/*representante ver mis campeonatos*/


Breadcrumbs::for('ver-mis-campeonatos', function ($trail) {       
   $trail->parent('home');
    $trail->push('Mis Campeonatos', route('listar-mis-equipo'));    
});

Breadcrumbs::for('ver-asignacion-campeonatos', function ($trail,$asignacion) {       
   $trail->parent('ver-mis-campeonatos');
    $trail->push('Asignación campeonato ', route('mi-menu-equipo',Crypt::encryptString($asignacion->id)));    
});
Breadcrumbs::for('craer-asignacion-campeonatos', function ($trail,$asignacion) {       
   $trail->parent('ver-asignacion-campeonatos',$asignacion);
    $trail->push('Asignación Jugador ', route('asignacion-nomina',$asignacion->id));    
});


// acerca de nosotros
Breadcrumbs::for('nosotrosAdmin', function ($trail) {       
    $trail->parent('home');
     $trail->push('Acerca de nosotros', route('nosotrosAdmin'));    
 });

//  noticias
Breadcrumbs::for('noticiasAdmin', function ($trail) {       
    $trail->parent('home');
     $trail->push('Noticias', route('noticiasAdmin'));    
 });
 Breadcrumbs::for('crearNoticiaAdmin', function ($trail) {       
    $trail->parent('noticiasAdmin');
     $trail->push('Nueva noticia', route('crearNoticiaAdmin'));    
 });

 Breadcrumbs::for('editarNoticia', function ($trail,$n) {       
    $trail->parent('noticiasAdmin');
     $trail->push('Editar noticia', route('editarNoticia',$n->id));    
 });

 