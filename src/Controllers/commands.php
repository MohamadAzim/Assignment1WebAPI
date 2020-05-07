<?php

//get all items
function getAllShoes($db)
{
    $sql = 'Select * from categories';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get shoes by category
function getShoeCat($db, $shoeCategory)
{
$sql = 'Select * from categories Where shoes_category like :category ';
$stmt = $db->prepare ($sql);
$id = $shoeCategory;
$stmt->bindParam(':category', $id, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Create new item

function createShoe($db,$form_data){
    $sql = 'INSERT INTO categories (`shoes_name`, `shoes_brand`, `shoes_category`)';
    $sql .= 'VALUES (:name, :brand, :category)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $form_data['shoes_name']);
    $stmt->bindParam(':brand', $form_data['shoes_brand']);
    $stmt->bindParam(':category', $form_data['shoes_category']);
    $stmt->execute();
    return $db->lastInsertID(); //Insert last number 
}

//delete product by name
function deletedShoe($db,$shoeName) {
    $sql = ' Delete from categories where shoes_name like :name';
    $stmt = $db->prepare($sql);
    $name = $shoeName;
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    }

//get shoes by id
function getShoe($db, $shoeId)  {
    $sql = 'Select * from categories Where shoes_id = :id ';
    $stmt = $db->prepare ($sql);
    $id = (int) $shoeId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
        
//update product by name
function updatedShoe($db,$form_data,$shoeName) {
    $sql = 'UPDATE categories SET  shoes_brand = :brand , shoes_category = :category WHERE shoes_name = :name ';
    
    $stmt = $db->prepare ($sql);
    $name =$shoeName;

    $stmt->bindParam(':name', $form_data['shoes_name']);
    $stmt->bindParam(':brand', $form_data['shoes_brand']);
    $stmt->bindParam(':category', $form_data['shoes_category']);
    $stmt->execute();

    $sql1 = 'Select shoes_name, shoes_brand, shoes_category  from categories';
    $sql1 .= ' WHERE shoes_name = :name'; 
    $stmt1 = $db->prepare ($sql1);
    $stmt1->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt1->execute();
    return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    } 

    


/*delete product by id
function deleteShoe($db,$shoeId) {
    $sql = ' Delete from categories where shoes_id = :id';
    $stmt = $db->prepare($sql);
    $id = (int)$shoeId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    } */

    /*update product by id
    function updateShoe($db,$form_data,$shoeId) {
        $sql = 'UPDATE categories SET shoes_name = :name , shoes_brand = :brand , shoes_category = :category WHERE shoes_id = :id';
    
        $stmt = $db->prepare ($sql);
        $id = (int) $shoeId;
        
        $stmt->bindParam(':name', $form_data['shoes_name']);
        $stmt->bindParam(':brand', $form_data['shoes_brand']);
        $stmt->bindParam(':category', $form_data['shoes_category']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
      
         $sql1 = 'Select shoes_name, shoes_brand, shoes_category  from categories';
         $sql1 .= ' Where shoes_id = :id'; 
        $stmt1 = $db->prepare ($sql1);
        $stmt1->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt1->execute();
        return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    } */