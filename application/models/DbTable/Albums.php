<?php

class Application_Model_DbTable_Albums extends Zend_Db_Table_Abstract
{

    protected $_name = 'albums';
    
    public function getAlbum($id){
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if(!row){
            throw new Exception('could not find the id '.$id);
        }
        return $row->toArray();
        
    }
    
    public function addAlbum($author,$title){
        //echo "2222";die;
        $data = array(
          'artist' =>  $author,
           'title' => $title
        );
        $this->insert($data);
    }
    
    public function updateAlbum($id,$author,$title){
        $data = array(
          'artist'=>$author,
          'title'=>$title 
        );
        $this->update($data, 'id = '.(int)$id);
    }
    
    public function deleteAlbum($id){
        $this->delete('id = '.(int)$id);
    }
}

