<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include productsProc.php file
include __DIR__ . '/commands.php';

//read or show ALL table products
$app->get('/showshoes', function (Request $request, Response $response, array $arg){
  $data = getAllShoes($this->db);
  return $this->response->withJson(array('data' => $data), 200);
});

//read or show table products by filtering the categories
$app->get('/filtering/[{category}]', function ($request, $response, $args){
    
  $shoeCategory = $args['category'];
$data = getShoeCat($this->db,$shoeCategory);
if (empty($data)) {
  return $this->response->withJson(array('error' => 'no data'), 404);
}
 return $this->response->withJson(array('data' => $data), 200);
});

//read or show table products by  ID
$app->get('/filter/[{id}]', function ($request, $response, $args){
    
    $shoeId = $args['id'];
   if (!is_numeric($shoeId)) {
      return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
  $data = getShoe($this->db,$shoeId);
  if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 404);
 }
   return $this->response->withJson(array('data' => $data), 200);
});

//add or create new shoes
$app->post('/categories/add', function ($request, $response, $args) {
  $form_data = $request->getParsedBody();
  $data = createShoe($this->db, $form_data);
  if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
  }
  return $this->response->withJson(array('add data' => 'success'), 201);
  }
);

//delete shoes by name
$app->delete('/delete/[{name}]', function ($request, $response, $args){
  $shoeName = $args['name'];
$data = deletedshoe($this->db,$shoeName);
if (empty($data)) 
 return $this->response->withJson(array('data' => "Data deleted successfully"), 200);
});

//put or edit table products by name
$app->put('/edit/[{name}]', function ($request,  $response,  $args){
  $shoeName = $args['name'];
  $form_data=$request->getParsedBody();
  
$data=updatedShoe($this->db,$form_data,$shoeName);
if (empty($data)) {
  return $this->response->withJson(array('error' => 'No DATA Found'), 500);
}
return $this->response->withJson(array('data' => $data), 200);
}); 


/*delete shoes by ID
$app->delete('/shoedel/[{id}]', function ($request, $response, $args){
  $shoeId = $args['id'];
 if (!is_numeric($shoeId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
 }
$data = deleteshoe($this->db,$shoeId);
if ($data <= 0) {
  return $this->response->withJson(array('error' => 'no data found'), 500);
}
 return $this->response->withJson(array('data' => "Data already deleted"), 200);
}); */

/*//put or edit table shoes by ID
$app->put('/catput/[{id}]', function ($request,  $response,  $args){
  $shoeId = $args['id'];
  $form_data=$request->getParsedBody();
 if (!is_numeric($shoeId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
 }

 $data=updateShoe($this->db,$form_data,$shoeId);

return $this->response->withJson(array('data' => $data), 200);
}); */