INSERT INTO
	clients (
        clientFirstname
        , clientLastname
        , clientEmail
        , clientPassword
        , comment)
    VALUES (
        "Tony"
        , "Stark"
        , 'tony@starkent.com'
        , "Iam1ronM@n"
        , "I am the real Ironman");
        
UPDATE clients
	SET clientLevel = '3'
    WHERE clientFirstname = "Tony"
    AND clientLastname = "Stark";
    
UPDATE inventory
	SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
    WHERE invId = 12;

SELECT i.invModel, cc.classificationName FROM inventory i
	INNER JOIN carclassification cc
    ON i.classificationId = cc.classificationId
    WHERE cc.classificationName = "SUV";

DELETE FROM inventory WHERE invId = 1;

UPDATE inventory i
	SET i.invImage = CONCAT("/phpmotors",i.invImage)
    AND i.invThumbnail = CONCAT("/phpmotors",i.invThumbnail);
