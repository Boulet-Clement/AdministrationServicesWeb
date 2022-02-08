# AdministrationServicesWeb

Se placer dans /DecouverteOAuth
    php -S localhost:8080 
se rendre du http://localhost:8080

## URL 1

https://accounts.google.com/o/oauth2/v2/auth?scope=https://www.googleapis.com/auth/calendar&redirect_uri=http://localhost:8080/&response_type=code&client_id=948500310587-96hjng74irngfnubnkr9cgs3a6cggpjk.apps.googleusercontent.com

## URL 2

https://www.googleapis.com/oauth2/v4/token?code=<CODE>&client_id=948500310587-96hjng74irngfnubnkr9cgs3a6cggpjk.apps.googleusercontent.com&client_secret=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&redirect_uri=http://localhost:8080/script.php&grant_type=authorization_code
