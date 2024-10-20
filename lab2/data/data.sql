INSERT INTO hotels (name, address, phone, email) VALUES
    ('Cora Hotel', 'Rox Blvd 59161', '991-871-8534', 'chotel0@hao123.com'),
    ('Edmund Hotel', 'Zike Ave', '124-165-6415 ', 'ehotel1@oakley.com'),
    ('Caren Hotel', 'Nicasia Ave', '896-656-3578 ', 'cgwynn2@hp.com'),
    ('Felicity Hotel', 'Rondo Blvd', '221-447-0143', 'fbaulch3@skyrock.com'),
    ('Worth Hotel', 'Brook Rd', '664-132-7761', 'wcristofori4@scientificamerican.com'),
    ('Cris Hotel', 'Rio Ave', '284-712-8844', 'csteinhammer5@creativecommons.org'),
    ('Vic Hotel', 'Bryant Rd', '163-305-4076', 'vcraik6@adobe.com'),
    ('Ilene Hotel', 'Brook Ave', '744-334-6805', 'iboggis7@quantcast.com'),
    ('Bryant Hotel', 'Rio Ave', '459-853-5816', 'bkaygill8@microsoft.com'),
    ('Roch Hotel', 'Nicasia Ave', '412-771-9271', 'rbennen9@amazon.co.uk');

NSERT INTO Guests ( id, first_name, last_name, email, phone, address ) VALUES 
     (1, 'Wiatt', 'Bettley', 'wbettley0@ning.com', '911-837-1821', '49 Waywood Parkway'), 
     (2, 'Noami', 'Heineken', 'nheineken1@bloglines.com', '290-514-4115', '0 Debra Center'), 
     (3, 'Venus', 'Garralts', 'vgarralts2@home.ph', '746-750-8154', '7 Dawn Terrace'), 
     (4, 'Skipton', 'Kerton', 'skerton3@mayoclinic.com', '591-954-9427', '5 Quincy Crossing'), 
     (5, 'Lek', 'Tropman', 'ltropman4@sciencedaily.com', '727-792-6674', '6510 Butman Hill'), 
    (6, 'Lawton', 'Bickardke', 'lbickardke5@sina.com', '652-880-5715', '94 Knutson Road'), 
    (7, 'Charley', 'Greenies', 'cgreenies6@hao123.com', '672-866-6131', '50154 Ronald Regan 
Place'), 
    (8, 'Mariska', 'Taylot', 'mtaylpt7@jalbum.net', '287-245-3032', '9446 Shasta Place'), 
    (9, 'Riobard', 'Moncaster', 'rmoncaster8@ehow.com', '930-349-1030', '7 Miller Park'), 
    (10, 'Harmoniel', 'McPhaden', 'hmcphaden9@toplist.cz.com', '515-883,4485', '27 Tomscot 
Street'); 

INSERT INTO Rooms ( id, hotel_id, room_number, room_type, price, status ) VALUES  
  ( 1, 10, 1, 'Single', '$1000', 'Available'), 
 
  ( 2, 9, 2, 'Family', '$3000', 'Pending'), 
  ( 3, 8, 3, 'Single', '$1000', 'Unavailable' ),  
  (4, 7, 4, 'Single', '$1000', 'Available'), 
  ( 5, 6, 5, 'Family', '$3000', 'Pending' ), 
  ( 6, 5, 6, 'Family', '$3000', 'Available'), 
  ( 7, 4, 7, 'Single', '$1000', 'Pending'), 
  ( 8, 3, 8, 'Family', '$3000', 'Unavailable'), 
  ( 9, 2, 9, 'Single', '$1000', 'Available'), 
  ( 10, 1, 10, 'Family', '$3000', 'Pending'); 

INSERT INTO bookings (id, guest_id, room_id, check_in_date, check_out_date, booking_date, 
total_amount) VALUES  
    (1, 10, 1, '2014-10-15', '2014-10-16', '2014-09-06', 1000.00), 
    (2, 9, 2, '2003-12-23', '2003-12-26', '2003-11-16', 3000.00), 
    (3, 8, 3, '2005-03-27', '2005-03-29', '2005-03-18', 2500.00), 
    (4, 7, 4, '2006-04-06', '2006-04-08', '2006-04-29', 2000.00), 
    (5, 6, 5, '2008-08-24', '2008-08-27', '2008-07-27', 2500.00), 
    (6, 5, 6, '2009-01-25', '2009-01-28', '2008-12-30', 3000.00), 
    (7, 4, 7, '2005-02-12', '2005-02-15', '2005-01-29', 3000.00), 
    (8, 3, 8, '2005-05-28', '2005-06-01', '2005-05-25', 5000.00), 
    (9, 2, 9, '2012-07-14', '2012-07-16', '2012-07-01', 4000.00), 
    (10, 1, 10, '2006-09-03', '2006-09-03', '2006-08-25', 5000.00); 

INSERT INTO employee ( id, hotel_id, first_name, last_name, position, phone, email ) 
VALUES  
      ( 1, 10, 'Jen', 'Morville', 'Manager', '414-635-4893', 'jmorville0@fastcompany.com'), 
      (2, 9, 'Amberly', 'Wolfe', 'Front Desk Clerk', '503-841-0461', 'awolfe1@myspace.com'), 
      (3, 8, 'Malachi', 'Masserel', 'Manager', '543-281-3592', 'mmasserel2@si.edu'), 
      (4, 7, 'Joyan', 'Brigstock', 'Chef', '883-223-3717', 'jbrigstock3@cam.ac.uk'), 
      (5, 6, 'Corene', 'Ewer', 'Chef', '124-223-5072', 'cewer4@phoca.cz'), 
      (6, 5, 'Evania', 'Hebblewhite', 'Chef', '523-147-3439', 'ehebblewhite5@xinhuanet.com'), 
     (7, 4, 'Catharine', 'Brickmann', 'Chef', '395-966-1228', 'cbrickmann6@icq.com'), 
     (8, 3, 'Rhonda', 'Van Bruggen', 'Manager', '318-769-3678', 'rvanbruggen7@blinklist.com'), 
      (9, 2, 'Lance', 'Oran', 'Concierge', '836-947-3657', 'loran8@ocn.ne.ip'), 
      (10, 1, 'Almeda', 'Giacobazzi', 'Manager', '823-607-7989', 'agiacobazzi9@cpanel.net'); 

INSERT INTO Payments ( id, booking_id, payment_date, amount, payment_method ) VALUES  
  ( 1, 10, '2006-09-03', '$5000', 'Debit Card' ), 
  ( 2, 9, '2012-07-01', '$4000', 'Cash'), 
  ( 3, 8, '2005-05-25', '$5000', 'Debit Card' ), 
  ( 4, 7, '2005-01-29', '$3000', 'Cash' ), 
  ( 5, 6, '2008-12-30', '$3000', 'Online Payment'), 
  ( 6, 5, '2008-07-27', '$2500', 'Cash'), 
  ( 7, 4, '2006-04-29', '$2000', 'Cash'), 
( 8, 3, '2005-03-18', '$2500', 'Cash'), 
( 9, 2, '2003-11-16', '$3000', 'Debit Card'), 
( 10, 1, '2014-09-06', '$1000', 'Cash'); 