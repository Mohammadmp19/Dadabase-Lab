----> keywords - کلید واژه ها

//جستجو اتاق های دارای یک ویژگی خاص
SELECT * FROM houses WHERE `description` LIKE "% %";

//جستجو اتاق دارای یکی از چندین ویژگی مد نظر
SELECT * FROM houses WHERE `category_id` LIKE "% %" OR `category_id` LIKE "% %";



----> type - نوع

//انتخاب یک نوع خاص
SELECT * FROM categories WHERE type="Restaurants"

//مرتب سازی قیمت صعودی یا نزولی
SELECT * FROM houses  ORDER BY prise type ASC|DESC
