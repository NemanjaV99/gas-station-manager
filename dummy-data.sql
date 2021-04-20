
-- Insert into Fuel -------------------------
INSERT INTO `fuel` (`ID_FUEL`, `NAME`) 
	VALUES (NULL, 'Benzin95'), 
		   (NULL, 'Benzin98'),
		   (NULL, 'Dizel'), 
           (NULL, 'Plin');
           
-- --------------------------------------------

-- Insert into Gas_Station --------------------------
INSERT INTO `gas_station` (`ID_GAS_STATION`, `NAME`) 
	VALUES (NULL, 'Pumpa A'),
		   (NULL, 'Pumpa B'), 
           (NULL, 'Pumpa C');
           
-- --------------------------------------------

-- Insert into Gas_Station_Fuel -------------------
INSERT INTO `gas_station_fuel` (`ID_GAS_STATION_FUEL`, `ID_GAS_STATION`, `ID_FUEL`, `AMOUNT_LITER`) 
	VALUES (NULL, '1', '1', '5000'), 
           (NULL, '2', '1', '4500'), 
           (NULL, '3', '1', '5200'), 
           (NULL, '1', '2', '4600'), 
           (NULL, '2', '2', '5000'), 
           (NULL, '3', '2', '4800'), 
           (NULL, '1', '3', '5300'), 
           (NULL, '2', '3', '4900'), 
           (NULL, '3', '3', '5000'), 
           (NULL, '1', '4', '3500'), 
           (NULL, '2', '4', '4000'), 
           (NULL, '3', '4', '4200');

-- ----------------------------------------------

-- Insert into Employee ---------------------------
INSERT INTO `employee` (`ID_EMPLOYEE`, `NAME`, `SURNAME`, `EXPERIENCE`, `SALARY`, `VACATION_DAYS`, `ID_GAS_STATION`) 
	VALUES (NULL, 'Pero', 'Peric', '10', '750' ,'25', '1'), 
		   (NULL, 'Stefan', 'Stefanovic', '6', '700', '10', '3'), 
           (NULL, 'Marko', 'Markovic', '5', '650', '10', '3'), 
           (NULL, 'Dejan', 'Petrovic', '3', '550', '5', '2'), 
           (NULL, 'Mladen', 'Mladenovic', '7', '700','15', '1'), 
           (NULL, 'Petar', 'Petrovic', '9', '750', '10', '2'), 
           (NULL, 'Milan', 'Peric', '2', '550', '5', '3'), 
           (NULL, 'David', 'Stefanovic', '1', '500', '5', '1'),
           (NULL, 'Goran', 'Maric', '5', '650', '10', '1'), 
           (NULL, 'Dragan', 'Markovic', '2', '550', '10', '2');
           
-- -----------------------------------------------

           