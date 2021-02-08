<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

//--------------------------------------------------------------------- CREAR
    public function create($data)
    {
        if ($this->db->insert($data['table'], $data['data'])) 
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function multi_create($data)
    {
        if ($this->db->insert_batch($data['table'], $data['data'])) 
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
//--------------------------------------------------------------------- LEER O SELECCIONAR
    public function read($data)
    {
        $this->db->select($data['select']);
        $this->db->from($data['table']);
        //-----------------------------------------------   JOIN
        if (isset($data['join'])) 
        {
            foreach ($data['join'] as $key => $value) 
            {
                $this->db->join($key , $value);
            }
        }
        //-----------------------------------------------   WHERE
        if (isset($data['where'])) 
        {
            $this->db->where($data['where']); 
        }
        //-----------------------------------------------   LIKE
        if (isset($data['like'])) 
        {
            $this->db->like($data['like']);
        }
        //-----------------------------------------------   ORDER
        if (isset($data['order'])) 
        {
            $this->db->order_by($data['order']);
        }
        //-----------------------------------------------   LIMIT
        if (isset($data['limit'])) 
        {
            foreach ($data['limit'] as $key => $value) 
            {
                $this->db->limit($key , $value); 
            }
        }
        //-----------------------------------------------   GET
        $query = $this->db->get();
        //-----------------------------------------------   DEVOLUCION DE RESULTADOS
        if($data['return'] == 'query')
        {
            $query->result();
            return $this->db->last_query($query);
        }
        elseif($data['return'] == 'check')
        {
            if ($query->num_rows() > 0) 
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        elseif($data['return'] == 'row')
        {
            return $query->row(); 
        }
        elseif($data['return'] == 'row_array')
        {
            return $query->row_array(); 
        }
        elseif($data['return'] == 'result')
        {
            return $query->result();
        }
        elseif($data['return'] == 'result_array')
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }  
    }
//--------------------------------------------------------------------- CANTIDAD MAXIMA
    public function count_max($data)
    {
    	$query = $this->db->count_all_results($data['count']);
    	return $query;
    }
//--------------------------------------------------------------------- CANTIDAD MAXIMA MIENTRAS
    public function count_max_where($data)
    {
        $this->db->like($data['param'], $data['count']);
        $this->db->from($data['table']);
        $query = $this->db->count_all_results();
        //$query = $this->db->count_all_results($data['count']);
        return $query;
    }
//--------------------------------------------------------------------- EDITAR
    public function edit($data)
    {
        if ($this->db->update($data['table'], $data['set'], $data['where'])) 
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }    
    }
//--------------------------------------------------------------------- ELIMINAR
    public function erase($data)
    {
        if ($this->db->delete($data['table'] , $data['where'])) 
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
//--------------------------------------------------------------------- AUTENTICACION DE USUARIOS
    public function login($data)
    {
        $this->db->where('correo =', $data['correo']);
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0) 
        {            
            $this->db->select('*');
            $this->db->from('usuarios');
            $this->db->where('usuarios.correo =', $data['correo']);
            $this->db->join('bitacora', 'bitacora.id_tabla = usuarios.id_usuario');
            $this->db->where('bitacora.tabla =', 'usuarios');
            $this->db->where('bitacora.estado >=', '1');
            $query = $this->db->get();

            if ($query->num_rows() > 0) 
            {
                return $query->row();
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }
//--------------------------------------------------------------------- QUERY PERSONALIZADO
    public function query_sql($data)
    {
        if ($query = $this->db->query($data['sql']))
        {
            
            return $query;
        }
        else
        {
            $error = $this->db->error();
            return $error;
            // $this->db->last_query($query);
            // return $query;
            //return FALSE;
        }
    }
    
//--------------------------------------------------------------------- DATATABLES PAGINATION Y BUSQUEDA SERVER-SIDE
    public function make_query($data)
    {
        $this->db->select($data['select']);
        $this->db->from($data['table']);
        if (isset($data['join'])) 
        {
            foreach ($data['join'] as $key => $value) 
            {
                $this->db->join($key , $value);
            }
        }
        if (isset($data['where'])) 
        {
            $this->db->where($data['where']); 
        }
        if(isset( $_POST['search']['value'] ))
        {
            $this->db->like($data['like'] , $_POST['search']['value']);
            if(isset($data['or_like']))
            {
                foreach ($data['or_like'] as $key => $value) 
                {
                    $this->db->or_like($key , $_POST['search']['value']);
                }
            }
            // $this->db->like($data['like']);
            // if(isset($data['or_like']))
            // {
            //     $this->db->or_like($data['or_like']);
            // }
        }
        if (isset( $_POST['order'] )) 
        {
            $this->db->order_by($data['order_column'][$_POST['order']['0']['column']] , $_POST['order']['0']['dir']);
        } 
        else 
        {
            if(isset($data['order_column']))
            {
                $this->db->order_by($data['order_column'] , $data['order_column'] );
            }
        }
    }

    public function make_datatables($data)
    {
        $this->make_query($data);
        if($_POST['length'] != -1)
        {
            $this->db->limit($_POST['length'] , $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data($data)
    {
        $this->make_query($data);
        $query = $this->db->get();
        return $query->num_rows(); 
    }

    public function get_all_data($data)
    {
        $this->db->select($data['select']);
        $this->db->from($data['table']);
        $this->db->get();
        $query = $this->db->count_all_results();
        return $query; 
    }
}
//return $this->db->last_query($query);
//var_dump($query);
//echo $this->db->last_query();
//die();