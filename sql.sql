DELIMITER $$
CREATE TRIGGER on_delelete_machine AFTER DELETE ON machines 
FOR EACH ROW 
BEGIN
    DELETE FROM image_machines WHERE image_machines.id = OLD.id_image;   
    DELETE FROM prix_machines WHERE prix_machines.id = OLD.id_prix;
END$$