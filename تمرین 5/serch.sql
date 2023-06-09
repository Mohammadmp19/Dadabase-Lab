SELECT firstname,middlename,lastname,email,contact,house_id,`status`,date_in FROM tenants
WHERE contact LIKE "%searchtext%",email LIKE "%searchtext%",firstname LIKE "%searchtext%",
house_id=int("searchtext")