<?php

/**
 * Description of User
 *
 * @author James
 */
class App_Model_Producto extends App_Db_Table_Abstract
{

    protected $_name = 'producto';

    const ESTADO_ACTIVO = '1';
    const ESTADO_ELIMINADO = '0';
    const TABLA_SERVICIO = 'producto';
    
    /**
     * @param array $datos
     * @param string $condicion para el caso de actualizacion
     * @return int Identificador de la columna
     */
    private function _guardar($datos, $condicion = NULL) 
    {
        $id = 0;
        if (!empty($datos['idcategoria'])) {
            $id = (int) $datos['idcategoria'];
        } 
        
        unset($datos['idcategoria']);
        $datos = array_intersect_key($datos, array_flip($this->_getCols()));

        if ($id > 0) {
            $condicion = '';
            if (!empty($condicion)) {
                $condicion = ' AND ' . $condicion;
            }

            $cantidad = $this->update($datos, 'idcategoria = ' . $id . $condicion);
            $id = ($cantidad < 1) ? 0 : $id;
        } else {
            $id = $this->insert($datos);
        }
        return $id;
    }

    public function getCategoriaPorId($id) 
    {
        $query = $this->getAdapter()->select()
                ->from($this->_name)
                ->where('idcategoria = ?', $id)                
                ;

        return $this->getAdapter()->fetchRow($query);
    }

    public function listaProductos() 
    {
        $db = $this->getAdapter();
        $query = $db->select()->from(array('p' => $this->_name))
                ->joinInner(array('c' => App_Model_Categoria::TABLA_CATEGORIA), 
                        'p.idcategoria = c.idcategoria', 
                        array('descripcionCate' => 'descripcion'))
                ->where('p.estado = ?', self::ESTADO_ACTIVO)
                        ->order('p.fechaInicio desc')
                        ;
        
        return $this->getAdapter()->fetchAll($query);
        
    }

    public function actualizarDatos($datos) 
    {   
        return $this->_guardar($datos);
    }
    
    public function updateEstado($id, $est, $tipo) 
    {   
        $db = $this->getDefaultAdapter();
        
        $update = ($est == 1)?0:1;
        
        $data = array(            
            'estado'       => $update
            );
        
            
        if ($tipo) 
            $where = $db->quoteInto('(idcategoria = ' . $id . ' OR categoriaPadre = ' . $id .')');
        else { 
            $condicion = 'idcategoria = ' . $id  ;
            $where = $db->quoteInto($condicion);
        }
        $db->update($this->_name, $data, $where);
    }
    

}