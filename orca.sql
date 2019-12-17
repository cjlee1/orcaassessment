-- Get a list of owners, and the names of all the horses that they own.

SELECT OWNER.Name, HORSE.Name
FROM  OWNER INNER JOIN OwnerOnHorse ON OWNER.Id = OwnerOnHorse.OwnerId   INNER JOIN HORSE ON HORSE.Id = OwnerOnHorse.HorseId
Group By Owner.name

-- Get a list of horses, and the names of all the Jockeys who ride them.

SELECT HORSE.Name, JOCKEY.Name
FROM   JOCKEY INNER JOIN JockeyOnHorse ON JOCKEY.Id = JockeyOnHorse.JockeyID  INNER JOIN HORSE ON HORSE.Id = JockeyOnHorse.HorseID

-- Get a list of all the Jockeys who ride for owner with the ID 1234.

SELECT JOCKEY.Name
FROM  JOCKEY INNER JOIN JockeyOnHorse ON JOCKEY.Id = JockeyOnHorse.JockeyID 
    INNER JOIN HORSE ON HORSE.Id = JockeyOnHorse.HorseID 
    INNER JOIN  OwnerOnHorse ON HORSE.Id = OwnerOnHorse.HouseID 
    
WHERE OwnerOnHorse.OwnerId = 1234;

-- Get a list of all Jockey photo URLs for the horse with ID 23.

-- *Under the assumption that AssetTableName refers to the asset Table name so Jockey, Owner or ID. We can 
-- * assume we are using the JOCKEY table and JOckey id and that AssetTableName= "Jockey"

 SELECT AssetPhotos.PhotoURL
 FROM AssetPhotos INNER JOIN JockeyOnHorse ON AssetPhotos.AssetId = JockeyOnHorse.JockeyID  
 WHERE AssetPhotos.AssetTableName="JOCKEY" AND JockeyOnHorse.HorseID = 23;

-- If a Jockey has no photo, provide a default of “/default.png”

 SELECT COALESCE(AssetPhotos.PhotoURL,“/default.png”  )
 FROM AssetPhotos INNER JOIN JockeyOnHorse ON AssetPhotos.AssetId = JockeyOnHorse.JockeyID  
 WHERE AssetPhotos.AssetTableName="JOCKEY" AND JockeyOnHorse.HorseID = 23 ;

-- #2.5 Get a list of photo URLs of all “Arabian” breed horses associated with the owner email “careers@northorca.com”

*didn't add in COALESCE() because I wasn't sure if you wanted that
SELECT AssetPhotos.PhotoURL
FROM  AssetPhotos INNER JOIN OwnerOnHorse ON AssetPhotos.AssetId = OwnerOnHorse.HorseID 
    INNER JOIN HORSE ON HORSE.Id = OwnerOnHorse.HorseId 
    INNER JOIN OWNER ON OWNER.Id = OwnerOnHorse.OwnerId
WHERE OWNER.email = “careers@northorca.com”  AND HORSE.Breed = "Arabian";