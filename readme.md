# My_Book_Store
## A site to manage your library !!
####You need to have PHP5.6+ 
#####Test this project in a LAMP stack please !! 


/!\ HOW TO USE /!\
------------------
LOGIN : admin   
PASSWORD : admin

------------------------------------------------------------  

Plugins and libraries :  
---------------------
* [materialize](http://materializecss.com/)
* [google material icons](https://design.google.com/icons/)
* [jQuery](https://jquery.com/)

------------------------------------------------------------  

Warning : 
---------

First you need to grant some write and read acces to this project : 
```sudo chmod -R 0777 path/to/My_Book_Store```

------------------------------------------------------------  

(Optional) You can change the my_book_store.prod.conf like this :  
```
DocumentRoot path/to/project/
<Directory path/to/project/>
```

After that you can put the .conf file in your apache directory (/etc/apache2/sites-availables) and :  
```
sudo a2ensite display.prod.conf
sudo service apache2 reload
```

If you are want to test the project, go to your /etc/hosts file and add this  :
```127.0.0.1	www.my_book_store.prod```
  
After that you can go to your favorite web navigator and write :


    http://www.my_book_store.prod/

------------------------------------------------------------  