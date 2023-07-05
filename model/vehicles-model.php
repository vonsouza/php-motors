<?php

/*
It is the vehicles model
*/

//function to register client
function regClassification($classificationName)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification 
                    (classificationName)
                VALUES 
                    (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    // $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    // $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId )
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory 
                        (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId )
                    VALUES 
                        (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


function getVehiclesByClassification($classificationName)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}
// function getVehiclesByClassification($classificationName)
// {
//     $db = phpmotorsConnect();
//     $sql = 'SELECT imgId, imgPath, imgName, inventory.invId, inventory.invMake, inventory.invModel, inventory.invPrice, inventory.invThumbnail 
//     FROM images 
//     JOIN inventory ON images.invId = inventory.invId 
//     WHERE imgPath LIKE "%tn__" 
//     AND inventory.invId IN (SELECT invId 
//                             FROM inventory 
//                             WHERE classificationId IN (SELECT classificationId 
//                                                       FROM carclassification 
//                                                       WHERE classificationName = :classificationName))';
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
//     $stmt->execute();
//     $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $vehicles;
// }


function getInvDetails($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }
// function getInvDetails($invId)
// {
//     $db = phpmotorsConnect();
//     $sql = 'SELECT imgId, imgPath, inventory.invId, inventory.invMake, inventory.invModel, inventory.invDescription, inventory.invColor, inventory.invStock, inventory.invPrice
//     FROM images 
//     JOIN inventory ON images.invId = inventory.invId 
//     WHERE imgPath NOT LIKE "%tn__" 
//     AND inventory.invId IN (SELECT invId 
//                             FROM inventory 
//                             WHERE invId = :invId)';
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
//     $stmt->execute();
//     $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $vehicles;
// }

// Get Thumbnail Image from images table. 
function getThumbnailImages($invId) {
    $db = phpmotorsConnect();
    // $sql = 'SELECT imgId, imgPath, inventory.invId
    // FROM images 
    // JOIN inventory ON images.invId = inventory.invId 
    // WHERE imgPath LIKE "%tn__" 
    // AND inventory.invId IN (SELECT invId 
    //                         FROM inventory 
    //                         WHERE invId = :invId)';
    $sql = 'SELECT * FROM images WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }

// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}
