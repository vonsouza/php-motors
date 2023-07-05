-- enhancement2: Von Souza

--Query  INSERT
INSERT INTO 
    clients 
        (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
    VALUES 
        ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman.');


--2. Query UPDATE
UPDATE 
    clients 
        SET 
            clientLevel = 3
        WHERE
            clientId = 1;

--3. Query UPDATE
UPDATE 
    inventory 
        SET 
            invDescription = replace(invDescription, 'small interiors', 'spacious interiors')
        WHERE
            invId = 12;

--4. Query SELECT
SELECT 
    i.invModel, c.classificationName
FROM 
    inventory i
INNER JOIN
    carClassification c ON i.classificationId = c.classificationId
WHERE 
    i.classificationId = 1;

--5. Query  DELETE
DELETE FROM inventory 
WHERE 
    invId = 1;

--6. Query UPDATE
UPDATE 
    inventory 
        SET 
            invImage = concat('/phpmotors', invImage), 
            invThumbnail = concat('/phpmotors', invThumbnail);