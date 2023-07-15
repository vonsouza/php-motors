<?php 
/*
Model for reviews... to do
*/

// Insert a review
// Get reviews for a specific inventory item
// Get reviews written by a specific client
// Get a specific review
// Update a specific review
// Delete a specific review

//function to add Review
function addReview($reviewText, $reviewDate, $invId, $clientId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews 
                    (reviewText, reviewDate, invId, clientId)
                VALUES 
                    (:reviewText, :reviewDate, :invId, :clientId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//my work
// Get reviews data based on invId
function getReviewsFromInvId($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $reviewData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewData;
   }

//my work
// Get reviews data based on reviewId
function getReviewsByReviewId($reviewId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);
    $stmt->execute();
    $reviewData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewData;
   }

   //my work
// Get reviews data based on clientId
function getReviewsByClientId($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->execute();
    $reviewData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewData;
   }

   //my work
// Quero o o cliente q comentou (clientId)
function getClientIdFromReview($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $reviewData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewData;
   }

//my work
// Update: find in the table reviews, the given $reviewId and update the $reviewText to the $reviewText given
function updateReviewText($reviewId, $reviewText){
    $db = phpmotorsConnect();
    $sql = "UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText);
    $stmt->bindValue(':reviewId', $reviewId);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}

//my work
// DELETE: find in the table reviews, the given $reviewId and update the $reviewText to the $reviewText given
function deleteReviewId($reviewId) {
    $db = phpmotorsConnect();
    $sql = "DELETE FROM reviews WHERE reviewId = :reviewId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId);
    $stmt->execute();
    $rowsDeleted = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsDeleted;
}

// reviewId  -- automatico ok
// reviewText -- ok
// reviewDate -- acho q não precisa de nada ok
// invId  -- a pegar
// clientId -- a pegar