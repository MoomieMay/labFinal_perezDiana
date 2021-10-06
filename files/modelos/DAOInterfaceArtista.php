<?php

/*
/**
 *
 * @author dianaperez
 */
interface DAOInterfaceArtista{
       
    /**guarda los datos del objeto como un nuevo registro
     * @param Usuario $objeto
     * @return bool retorne true si inserto el registro
     */
    public function alta ($objeto): bool;
    
    /**elimina el objeto de la bd
     * @param Usuario $objeto
     * @return bool retorna true si se elimino el registro
     */
    public function baja($objeto): bool;
    
    /**Replica los datos del objeto actual
     * @param Usuario $objeto
     * @return bool retorna true si se actualizo el registro
     */
    public function modificar($objeto): bool;
    
    /**
     * busca en la bd el registro por el id y lo guarda en el objeto
     * @param int $id
     * @return \Usuario objeto instanciado
     */
    public function cargar($id): Artista;
    
    /** lista los registros de la tabla usuarios
     * @param JSON $filtros los campos se deben correponder con los definidos en el json
     * @return array arreglo con registros encontrados, sino arreglo vacio    
     */
    public function listar($filtros): array;  
      
}