<?php

// extends class Model
class PersonM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tb_product
  public function add_product($name,$price,$image,$desc){

    if(empty($name) || empty($price) || empty($image) || empty($desc)){
      return $this->empty_response();
    }else{
      $data     = array(
        "name"  =>$name,
        "price" =>$price,
        "image" =>$image, 
        "desc"  =>$desc
      );

      $insert = $this->db->insert("tb_product", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data product ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data product gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data product
  public function all_product(){

    $all = $this->db->get("tb_product")->result();
    $response['status']=200;
    $response['error']=false;
    $response['product']=$all;
    return $response;

  }

  // hapus data product
  public function delete_product($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_product");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data product dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data product gagal dihapus.';
        return $response;
      }
    }

  }

  // update product
  public function update_product($id,$name,$price,$image,$desc){

    if($id == '' || empty($name) || empty($price) || empty($image) || empty($desc)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set      = array(
        "name"  =>$name,
        "price" =>$price,
        "image" =>$image,
        "desc"  =>$desc
      );

      $this->db->where($where);
      $update = $this->db->update("tb_product",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data product diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data product gagal diubah.';
        return $response;
      }
    }

  }

}

?>
