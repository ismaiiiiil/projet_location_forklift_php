DELIMITER $$
CREATE OR REPLACE TRIGGER on_delelete_machine AFTER DELETE ON machines 
FOR EACH ROW 
BEGIN
    DELETE FROM image_machines WHERE image_machines.id = OLD.id_image;   
    DELETE FROM prix_machines WHERE prix_machines.id = OLD.id_prix;
END$$









-- gestion bénéfices


DELIMITER $$
CREATE OR REPLACE TRIGGER tr_order_insert_bénéfices AFTER INSERT ON orders
FOR EACH ROW
BEGIN 
	IF ( EXISTS(SELECT * FROM bénéfices WHERE date_bénéfices = CURRENT_DATE()) )THEN
    	UPDATE bénéfices 
        SET total_bénéfices = total_bénéfices + NEW.prix ,
        prix_hors_taxe = prix_hors_taxe + NEW.prix 
        WHERE date_bénéfices = CURRENT_DATE() ; 
    ELSE
    	INSERT INTO bénéfices VALUES (NULL, NEW.prix, 0 , NEW.prix, CURRENT_DATE());
    END IF;

END$$

-- -----------------------

DELIMITER $$
CREATE OR REPLACE TRIGGER tr_perte_materiele_insert_pert AFTER INSERT ON pertes_matérielles
FOR EACH ROW
BEGIN 
	IF ( EXISTS(SELECT * FROM bénéfices WHERE date_bénéfices = NEW.date_perte) )THEN
    	UPDATE bénéfices 
        SET total_pert = total_pert + NEW.prix_perte ,
        prix_hors_taxe = prix_hors_taxe - NEW.prix_perte 
        WHERE date_bénéfices =  NEW.date_perte ; 
    ELSE
    	INSERT INTO bénéfices VALUES (NULL, 0, NEW.prix_perte, -NEW.prix_perte,  NEW.date_perte );
    END IF;

END$$


-- Update

DELIMITER $$
CREATE OR REPLACE TRIGGER tr_perte_materiele_update_pert AFTER UPDATE ON pertes_matérielles
FOR EACH ROW
BEGIN 
	IF ( EXISTS(SELECT * FROM bénéfices WHERE date_bénéfices = NEW.date_perte) )THEN
    	UPDATE bénéfices 
        SET total_pert = total_pert - OLD.prix_perte + NEW.prix_perte ,
        prix_hors_taxe = prix_hors_taxe + OLD.prix_perte - NEW.prix_perte 
        WHERE date_bénéfices =  NEW.date_perte ; 
    END IF;

END$$


DELIMITER $$
CREATE OR REPLACE TRIGGER tr_perte_materiele_delete_pert AFTER DELETE ON pertes_matérielles
FOR EACH ROW
BEGIN 
	IF ( EXISTS(SELECT * FROM bénéfices WHERE date_bénéfices = OLD.date_perte) )THEN
    	UPDATE bénéfices 
        SET total_pert = total_pert - OLD.prix_perte  ,
        prix_hors_taxe = prix_hors_taxe + OLD.prix_perte 
        WHERE date_bénéfices =  OLD.date_perte ; 
    END IF;
END$$


DELIMITER $$
CREATE OR REPLACE TRIGGER tr_delete_benefice AFTER DELETE ON bénéfices
FOR EACH ROW
BEGIN 
	-- IF ( EXISTS(SELECT * FROM pertes_matérielles WHERE date_perte = OLD.date_bénéfices) )THEN
    	DELETE FROM pertes_matérielles 
        WHERE date_perte = OLD.date_bénéfices; 
    -- END IF;
END$$


-- ------ Orders ----------
DELIMITER $$
CREATE OR REPLACE TRIGGER tr_add_order_decrement_qte_machine AFTER INSERT on orders
FOR EACH ROW 
BEGIN
	IF ( EXISTS(SELECT * FROM machines WHERE id = NEW.id_machine) )THEN
        UPDATE machines SET
        quantity = quantity - NEW.qte
        WHERE id = NEW.id_machine;
    END IF;

END$$
-- -------------------------------
DELIMITER $$
CREATE OR REPLACE TRIGGER tr_delete_order_increment_qte_machine AFTER DELETE ON orders
FOR EACH ROW 
BEGIN
	IF ( EXISTS(SELECT * FROM machines WHERE id = OLD.id_machine AND OLD.delivrer=0) )THEN
        UPDATE machines SET
        quantity = quantity + OLD.qte
        WHERE id = OLD.id_machine;
    END IF;
END$$


-- ------------ update is delivred -------------------------
-- ------------ update is not delivred -------------------------
DELIMITER $$
CREATE OR REPLACE TRIGGER tr_update_delivred AFTER UPDATE on orders
FOR EACH ROW
BEGIN
	
    IF(NEW.delivrer = 1) THEN
    	UPDATE machines SET
        quantity = quantity + OLD.qte	
        WHERE id = OLD.id_machine;
    
    ELSE 
    	IF( NEW.delivrer = 0) THEN
            UPDATE machines SET
            quantity = quantity - OLD.qte	
            WHERE id = OLD.id_machine;
    	END IF;
    END IF;
END$$


-- client plus fidelity

DELIMITER $$
CREATE OR REPLACE FUNCTION countNbrUserByEmail(mail varchar(30)) RETURNS int(20)
BEGIN

RETURN(SELECT COUNT(*) FROM orders 
        JOIN users ON orders.email_user = users.email
        WHERE users.email = mail);
END$$

SELECT * , countNbrUserByEmail(users.email) nbrOrder FROM users 
ORDER BY nbrOrder DESC
LIMIT 10;