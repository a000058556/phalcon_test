# Phalcon練習(in windows)
## PHP(7.4.30)、Phalcon(4.1.2)、Apache(2.4)


## 網頁架構：

```
test
|__ index.html
|__ .htaccess
|__ cache
|__ public
|   |__ css
|   |__ files
|   |__ img
|   |__ js
|   |__ temp
|   |__ .htaccess
|   |__ index.php
|   
|__ app
    |__ config
    |   |__ config.php
    |   |__ loader.php
    |   |__ router.php
    |   |__ services.php
    | 
    |__ controllers
    |   |__ ControllerBase.php
    |   |__ IndexController.php
    |   |__ SignupController.php
    |   |__ TestController.php
    |   |__ ApiController.php (建立api:取cars資料庫資料)
    |   |__ StorkController.php (建立api:取外部資料)
    |
    |__ models
    |   |__ Users.php
    |   |__ Cars.php
    |
    |__ library
    |__ migrations
    |
    |__ views
        |__ index
        |   |__ index.phtml
        |
        |__ layouts
        |
        |__ signup
        |   |__ index.phtml
        |   |__ register.phtml
        |
        |__ test
        |   |__ index.phtml
        |   |__ edit.phtml
        |   |__ new.phtml
        |
        |__ index.phtml

```

<p align="right">(<a href="#top">back to top</a>)</p>