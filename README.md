# Geology Museum Custom CMS

This is a sample of a custom application made with Cakephp in the LAMP stack.

To install:
	a)  move the files to your server htdocs. If you please you can install to a sub-folder. Your application will be accessible from http://yourdomain/installation-folder.
	b)  create a database, a user assigned to the database with the appropriate privileges
	c)  import the database using the sql file provided
	d)  turn on mod_rewrite at Apache (httpd.conf file) if not turned on
	
To connect to the database locate the file app/config/database.php and write down the above data in DATABASE_CONFIG array.

That's it! You are now able to see the front-end.

Now you can head off to the back end visiting the url  http://yourdomain/installation-folder/users/login.
For demo purposes you can use the username elisavet and the password letmein.

Enjoy!
