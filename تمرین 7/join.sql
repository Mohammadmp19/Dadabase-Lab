SELECT house_no FROM houses 
INNER JOIN tenants ON houses.id=tenants.house_id 
WHERE tenants.firstname LIKE "%علی%";