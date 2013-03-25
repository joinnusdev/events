<?php

/**
 * Description of User
 *
 * @author James
 */
class App_Model_Categoria extends App_Db_Table_Abstract
{

    protected $_name = 'categoria';

    const ESTADO_ACTIVO = '1';
    const ESTADO_ELIMINADO = '0';
    const TABLA_SERVICIO = 'categoria';
    
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

    public function listarCategorias() 
    {
        $db = $this->getAdapter();
        $query = $db->select()->from(array('cp' => $this->_name), 
            array('nombrePapa' => 'cp.descripcion', 'cp.idcategoria', 
                'cathija' => 'ch.idcategoria', 'padre' => 'ch.categoriaPadre', 
                'ch.descripcion', 'ch.estado'
                ))->joinInner(array('ch' => $this->_name), 
                    'cp.idcategoria = ch.categoriaPadre', array())            
            ;
        $queryPadre = $db->select()->from(array('cx' => $this->_name), 
            array('cx.descripcion', 'cx.idcategoria', 'cx.idcategoria', 
                'cx.categoriaPadre', 'cx.descripcion', 'cx.estado'))
            ->where('cx.categoriaPadre IS NULL')            
            ;
      
        $queryfinal = $db->select()->union(array($query, $queryPadre))
            ->order('idcategoria')
            ->order('padre ASC')
            ->order('cathija');        
//echo $queryfinal;exit;
        return $this->getAdapter()->fetchAll($queryfinal);
        
    }

    public function actualizarDatos($datos) 
    {   
        return $this->_guardar($datos);
    }    
    

}