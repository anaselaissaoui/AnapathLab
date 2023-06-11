CREATE DATABASE anapathlab;

USE anapathlab;

CREATE TABLE Chef_de_service (
   chef_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   chef_name VARCHAR(50),
   chef_last_name VARCHAR(50),
   chef_email VARCHAR(50),
   chef_mdp VARCHAR(50),
   chef_phone VARCHAR(50)
);  


CREATE TABLE Major(
   maj_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   maj_name VARCHAR(50),
   maj_last_name VARCHAR(50),
   maj_email VARCHAR(50),
   maj_mdp VARCHAR(50),
   maj_phone VARCHAR(50)
);  
CREATE TABLE Supplier(
   sup_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   sup_name VARCHAR(50),
   sup_email VARCHAR(50),
   sup_phone VARCHAR(50)
);  
CREATE TABLE Order_com(
   ord_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   ord_date VARCHAR(50),
   chef_id INT NOT NULL,
   sup_id INT NOT NULL,
   FOREIGN KEY(chef_id) REFERENCES Chef_de_service(chef_id),
   FOREIGN KEY(sup_id) REFERENCES Supplier(sup_id)
);  
CREATE TABLE Product(
   pro_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   pro_name VARCHAR(50),
   pro_type VARCHAR(50),
   pro_unit VARCHAR(50),
   pro_quant INT,
   pro_techn VARCHAR(200),
   pro_date_exp DATE,
   pro_condition VARCHAR(50),
   maj_id INT NOT NULL,
   FOREIGN KEY(maj_id) REFERENCES Major(maj_id)
);  
CREATE TABLE bolc_produit(
   bloc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   bloc_date_exp DATE,
   bolc_quant_order INT,
   bolc_quant_actu INT,
   pro_id INT NOT NULL,
   ord_id INT NOT NULL,
   FOREIGN KEY(pro_id) REFERENCES Product(pro_id),
   FOREIGN KEY(ord_id) REFERENCES Order_com(ord_id)
);  


INSERT INTO Chef_de_service (chef_name, chef_last_name, chef_email, chef_mdp, chef_phone)
VALUES ('Chef', 'chef', 'chef@gmail.com', 'chefchef', '0649409177');


INSERT INTO Major (maj_name, maj_last_name, maj_email, maj_mdp, maj_phone)
VALUES ('Jane', 'Smith', 'major@gmail.com', 'majormajor', '0673284564');




INSERT INTO product (pro_name, pro_unit, maj_id)
VALUES 
('Acide oxalique', '250g', 1),
('Acide périodique', '100g', 1),
('Acetone', '2,5L', 1),
('Acide nitrique 65%', '2,5L', 1),
('Carbonate de lithium', '500mg', 1),
('Nitrate d\'argent', '25g', 1),
('Alun de Potassium', '500g', 1),
('Acide chlorhydrique', '2,5L', 1),
('Acide Acétique', '1L', 1),
('Ammoniac solution 25%', '2,5L', 1),
('Acide phosphomolybdique', '100g', 1),
('Amunium ferIII sulfates', 'Kg', 1),
('Bleu alcian', '25g', 1),
('Bleu de toluidine', '25g', 1),
('Bleu de methylene', '1L', 1),
('Chlorure d\'Or', '1g', 1),
('CryoRAL', '420ml', 1),
('Eosine poudre', '25g', 1),
('Embedding Matrix for frozen sections', '125ml', 1),
('Ethanol Absolu', '25L', 1),
('Glycérol 98%', '1L', 1),
('Fushine phénique de Zeihl', '1L', 1),
('Ferrocyanure de potassium', '25g', 1),
('GIEMSA', '1L', 1),
('Gélatine', '500g', 1),
('Hématoxyline.C.I poudre', '25g', 1),
('Hématoxyline', '5L', 1),
('PAPANICO OG-6', '1L', 1),
('EA50', '2L', 1),
('Sodium métabolique', '500g', 1),
('Formol 30%', '25L', 1),
('Paraffine', '1Kg', 1),
('Paraffine en sachet', '2kg', 1),
('EUKIT (Partex)', '1L', 1),
('MICRIFIX SPRAY', 'Unité', 1),
('Toluène', '1L', 1),
('Fuchine basique', '25g', 1),
('Fushine acide', '25g', 1),
('Hyposulfite de sodium pur', '250g', 1),
('Rouge congo', '25g', 1),
('Ponceau xylidine', '25g', 1),
('Sodium phosphate dibasic anhydrans 98%', '1Kg', 1),
('Di-sodium tetraborate decahydrate', '1Kg', 1),
('Sodium dihydrogene orthophosphate', '1Kg', 1),
('Sodium hyposulfite', '100g', 1),
('Méthanol', '2,5L', 1),
('Preservative solution', '1L', 1),
('Potassium ferrocyanine 98%', '500g', 1),
('Erythrosine bleu', '25g', 1),
('Sodium metabisulfite', '500g', 1),
('KIT de colorations de perls', 'Unité', 1),
('kit de clorations de reticuline', 'Unité', 1),
('kit de clorations de Trichrome', 'Unité', 1),
('Vert lumière', '25g', 1),
('Eosine Poudre', '25g', 1),
('Gélatine', '500g', 1),
('Fushine Acide', '50g', 1),
('Vert Lumière', '25g', 1),
('Orcéine', '25g', 1),
('Hématoxyline de Harris Poudre', '25g', 1),
('Erythrosine bleu / 25g  +++', '25g', 1),
('Fuschine phéniquée de Ziehl', '25g', 1),
('Cristal de violet', '25g', 1),
('Sulfate d’aluminium', '250g', 1),
('Rouge sirius F3b', '10g', 1),
('Acide chromique 5%', '1L', 1),
('Hématoxylline de Harris liquide prêt à l’emploi', '1L', 1),
('Hématéine poudre', '25g', 1),
('Acide picrique', '500ml', 1),
('PBS PH 7.2 0.15M', '100ml', 1),
('Solution saline', '1L', 1),
('Iodate', '25g', 1),
('Ammoniaque', '1L', 1),
('May Grunwald, en solution pour le microscope ', '1L', 1),
('Sodium hydroxyle', '500g', 1),
('Acide Acétique', '1L', 1),
('PAPANICOLAOU EA50', '1L', 1),
('PAPANICOLAOU OG6', '1L', 1),
('Eau Oxygenée', '1L', 1),
('sodium hydrogenophosphate', '(500g)', 1),
('Aluminum Sulfate', '500g', 1),
('Formol 30%', '20L', 1);





INSERT INTO product (pro_name, pro_unit, maj_id, pro_type)
VALUES 
('Cristalisoir en verre BORA 140 mm', 'Unité', 1, 'Fongible'), 
('Cristalisoir en verre BORA 115 mm', 'Unité', 1, 'Fongible'), 
('Filtres RS', 'Unité', 1, 'Fongible'),
('DIAPATH Bain de coloration', 'Unité', 1, 'Fongible'),
('Lamelles 24x32', 'Unité', 1, 'Fongible'),
('Lamelles 24x40', 'Unité', 1, 'Fongible'),
('Lamelle couvre objet  24x60', 'Unité', 1, 'Fongible'),
('Cassetes Rose', '1Sachet', 1, 'Fongible'),
('Cassetes blanche', '1Sachet', 1, 'Fongible'),
('Cassete jaune', '1Sachet', 1, 'Fongible'),
('Cassete bleu', '1Sachet', 1, 'Fongible'),
('Cassete jaune', '1Sachet', 1,'Fongible' ),
('Tube Eppendorf (1000 µl)', 'Unité', 1, 'Fongible'),
('Tube Eppendorf (100 µl)', 'Unité', 1, 'Fongible'),
('Boites plastiques 5l', 'Unité', 1, 'Fongible'),
('Porte lames de bistouris', 'Unité', 1, 'Fongible'),
('Flacons plastiques  250 ml', 'Unité', 1, 'Fongible'),
('Flacons plastiques  500 ml', 'Unité', 1, 'Fongible'),
('Lames HE chargées positivement', 'Boite de 72', 1, 'Fongible'),
('Lames de microscope slide', 'Cartons de 50 boites', 1, 'Fongible'),
('Papier esuietout', 'Unité', 1, 'Fongible'),
('Lames de rasoir S35', 'Boite de 50', 1, 'Fongible'),
('Gants', 'Unité', 1, 'Fongible');












UPDATE products
JOIN (
    SELECT pro_name, SUM(prod_quantity_bloc) AS total_quantity
    FROM bloc_produit
    GROUP BY pro_name
) AS bloc_totals ON products.pro_name = bloc_totals.pro_name
SET products.pro_quantity = bloc_totals.total_quantity;






CREATE TABLE IF NOT EXISTS actions (
    action_id INT AUTO_INCREMENT PRIMARY KEY,
    action_type VARCHAR(50),
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    user_name VARCHAR(50),
    table_name VARCHAR(50)
);

DELIMITER //
CREATE TRIGGER product_actions_trigger
AFTER INSERT, UPDATE, DELETE ON product
FOR EACH ROW
BEGIN
    SET user_id = 1;
    SET user_name = 'Bacha';

    INSERT INTO actions (action_type, user_id, user_name, table_name)
    VALUES (TRIGGER_EVENT(), user_id, user_name, 'product');
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER supplier_actions_trigger
AFTER INSERT, UPDATE, DELETE ON supplier
FOR EACH ROW
BEGIN
    SET user_id = 1;
    SET user_name = 'Bacha';

    INSERT INTO actions (action_type, user_id, user_name, table_name)
    VALUES (TRIGGER_EVENT(), user_id, user_name, 'supplier');
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER order_com_actions_trigger
AFTER INSERT, UPDATE, DELETE ON order_com
FOR EACH ROW
BEGIN
    SET user_id = 1;
    SET user_name = 'Bacha';

    INSERT INTO actions (action_type, user_id, user_name, table_name)
    VALUES (TRIGGER_EVENT(), user_id, user_name, 'order_com');
END//
DELIMITER ;
