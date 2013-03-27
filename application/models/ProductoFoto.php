<?php

/**
 * Description of User
 *
 * @author James
 */
class App_Model_ProductoFoto extends App_Db_Table_Abstract
{

    protected $_name = 'productofoto';
    
    const TABLA_FOTO = 'productofoto';
    
    /**
     * @param array $datos
     * @param string $condicion para el caso de actualizacion
     * @return int Identificador de la columna
     */
    private function _guardar($datos, $condicion = NULL) 
    {
        $id = 0;
        if (!empty($datos['idproductoFoto'])) {
            $id = (int) $datos['idproductoFoto'];
        } 
        
        unset($datos['idproductoFoto']);
        $datos = array_intersect_key($datos, array_flip($this->_getCols()));

        if ($id > 0) {
            $condicion = '';
            if (!empty($condicion)) {
                $condicion = ' AND ' . $condicion;
            }

            $cantidad = $this->update($datos, 'idproductoFoto = ' . $id . $condicion);
            $id = ($cantidad < 1) ? 0 : $id;
        } else {
            $id = $this->insert($datos);
        }
        return $id;
    }

    public function actualizarDatos($datos) 
    {   
        return $this->_guardar($datos);
    }
    
    public function getFotosProducto($idProducto) 
    {
        $query = $this->getAdapter()->select()
                ->from($this->_name)
                ->where('idproducto = ?', $idProducto)
                ;

        return $this->getAdapter()->fetchAll($query);
    }
    

}