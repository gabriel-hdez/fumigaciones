<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    //  login
    'login' => array(
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[100]|valid_email'
        ),
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'required'
        )
    ),
     //  recuperar datos
    'recuperar' => array(
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[100]|valid_email'
        ),
    ),
    'confirmar' => array(
        array(
            'field' => 'respuesta',
            'label' => 'respuesta',
            'rules' => 'required'
        ),
    ),
    'clave' => array(
        array(
            'field' => 'clave',
            'label' => 'nueva contraseña',
            'rules' => 'required|matches[confirmar]'
        ),
        array(
            'field' => 'confirmar',
            'label' => 'confirmar contraseña',
            'rules' => 'required|matches[clave]'
        ),
    ),
    //  cambio dolar
    'bolivares' => array(
        array(
            'field' => 'bolivares',
            'label' => 'precio bolivares',
            'rules' => 'required|max_length[20]|decimal'
        )
    ),
    //  usuarios
    'usuario' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'apellido',
            'label' => 'apellido',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[9]|numeric'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[50]|valid_email'
        ),
        array(
            'field' => 'pregunta',
            'label' => 'pregunta',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'respuesta',
            'label' => 'respuesta',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ), 
        array(
            'field' => 'verificar',
            'label' => 'contraseña actual',
            'rules' => 'required'
        ), 
    ),
    //  usuarios
    'usuarios' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'apellido',
            'label' => 'apellido',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[9]|numeric|is_unique[usuarios.cedula]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[50]|valid_email|is_unique[usuarios.correo]'
        ),
        array(
            'field' => 'pregunta',
            'label' => 'pregunta',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'respuesta',
            'label' => 'respuesta',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ), 
    ),
    //  editar usuarios
    'usuarios_editar' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'apellido',
            'label' => 'apellido',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[9]|numeric'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[50]|valid_email'
        ),
        array(
            'field' => 'pregunta',
            'label' => 'pregunta',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'respuesta',
            'label' => 'respuesta',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
    ),
    //  clientes
    'clientes' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'apellido',
            'label' => 'apellido',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[9]|numeric|is_unique[clientes.cedula]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[50]|valid_email|is_unique[clientes.correo]'
        ),
        array(
            'field' => 'tlf',
            'label' => 'telefono',
            'rules' => 'required|exact_length[11]|numeric'
        ),
        array(
            'field' => 'alergias',
            'label' => 'alergias',
            'rules' => 'max_length[50]'
        ),
    ),
    //  editar clientes
    'clientes_editar' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'apellido',
            'label' => 'apellido',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[9]|numeric'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[50]|valid_email'
        ),
        array(
            'field' => 'tlf',
            'label' => 'telefono',
            'rules' => 'required|exact_length[11]|numeric'
        ),
        array(
            'field' => 'alergias',
            'label' => 'alergias',
            'rules' => 'max_length[50]'
        ),
    ),
    //  suministros
    'suministros' => array(
        array(
            'field' => 'suministro',
            'label' => 'suministro',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces|is_unique[suministros.suministro]'
        ),
        array(
            'field' => 'existencia',
            'label' => 'existencia',
            'rules' => 'required|max_length[11]|is_natural_no_zero'
        ),
        array(
            'field' => 'minimo',
            'label' => 'stock minimo',
            'rules' => 'required|max_length[3]|numeric'
        ),
        array(
            'field' => 'costo',
            'label' => 'costo',
            'rules' => 'required|max_length[13]|decimal'
        ),
    ),
    //  editar suministros
    'suministros_editar' => array(
        array(
            'field' => 'suministro',
            'label' => 'suministro',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'existencia',
            'label' => 'existencia',
            'rules' => 'required|max_length[11]|is_natural_no_zero'
        ),
        array(
            'field' => 'minimo',
            'label' => 'stock minimo',
            'rules' => 'required|max_length[3]|numeric'
        ),
        array(
            'field' => 'costo',
            'label' => 'costo',
            'rules' => 'required|max_length[13]|decimal'
        ),
    ),
    // servicios
    'servicios' => array(
        array(
            'field' => 'servicio',
            'label' => 'nombre del servicio',
            'rules' => 'required|max_length[50]|is_unique[servicios.servicio]'
        ),
        array(
            'field' => 'precio',
            'label' => 'precio del servicio',
            'rules' => 'required|max_length[20]|decimal'
        )
    ),
    // editar servicios
    'servicios_editar' => array(
        array(
            'field' => 'servicio',
            'label' => 'nombre del servicio',
            'rules' => 'required|max_length[50]'
        ),
         array(
            'field' => 'precio',
            'label' => 'precio del servicio',
            'rules' => 'required|max_length[20]|decimal'
        )
    ),
    // presupuestos
    'presupuestos' => array(
        array(
            'field' => 'vencimiento',
            'label' => 'fecha de vencimiento',
            'rules' => 'required'
        ),
        array(
            'field' => 'direccion',
            'label' => 'direccion',
            'rules' => 'required'
        ),
        array(
            'field' => 'total_presupuesto',
            'label' => 'total presupuestado',
            'rules' => 'required|max_length[20]|decimal'
        ),
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'apellido',
            'label' => 'apellido',
            'rules' => 'required|max_length[20]|letras'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[9]|numeric'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[50]|valid_email'
        ),
        array(
            'field' => 'tlf',
            'label' => 'telefono',
            'rules' => 'required|exact_length[11]|numeric'
        ),
        array(
            'field' => 'alergias',
            'label' => 'alergias',
            'rules' => 'max_length[50]'
        ),
        
    ),



);