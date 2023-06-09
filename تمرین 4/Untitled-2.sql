----> keywords - کلید واژه ها

//جستجو اتاق های دارای یک کلیدواژه خاص
SELECT * FROM houses WHERE keywords LIKE "% %";

//جستجو اتاق دارای یکی از چندین کلیدواژه مد نظر
SELECT * FROM houses WHERE keywords LIKE "% %" OR keywords LIKE "% %";



----> type - نوع

//انتخاب یک نوع خاص
SELECT * FROM categories WHERE type="Restaurants"

//مرتب سازی قیمت صعودی یا نزولی
SELECT * FROM houses  ORDER BY prise type ASC|DESC
