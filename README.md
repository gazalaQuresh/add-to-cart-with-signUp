steps needed to setup 
1 .clone repo 
2. create db and migrate tables . [command : php artisan migrate]
3. run the application [cmd:php artisan serve]
4.delete product done by admin will remove from cart list also.
5. we have 2 roles [admin, customer].
admin can add delete and update product by login . i have created  seeder class to get login for admin role .

command needed to run seeder class . [php artisan db:seed --class=UsersTableSeeder]

with this login you will get dasboard of product where you can login and add prodcut . 


#customer login 

customer can register by himself . and then login to the platform 

where all product will be there with prize and quanity . customer can add to his cart and can get total to his cart list . 