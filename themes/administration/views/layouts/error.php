<?php
/* @var $this Controller */
define('ADMIN_THEME', Yii::app()->theme->baseUrl);
define('ADMIN_THEME_CSS', ADMIN_THEME . '/css');
define('ADMIN_THEME_JS', ADMIN_THEME . '/js');
define('ADMIN_THEME_IMAGES', ADMIN_THEME . '/img');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href='http://fonts.googleapis.com/css?family=Creepster|Audiowide' rel='stylesheet' type='text/css'>

        <style>
            *{
                margin:0;
                padding:0;
            }
            body{
                font-family: helvetica, arial, sans-serif;
                background:url(<?php echo ADMIN_THEME_IMAGES; ?>/error_bg.png) repeat;
                background-color:#212121;
                color:white;
                font-size: 18px;
                padding-bottom:20px;
            }
            .error-code{
                font-family: helvetica, arial, sans-serif;
                font-size: 150px;
                color: white;
                color: rgba(255, 255, 255, 0.98);
                width: 50%;
                text-align: right;
                margin-top: 5%;
                text-shadow: 5px 5px hsl(0, 0%, 25%);
                float: left;
            }
            .not-found{
                width: 47%;
                float: right;
                margin-top: 5%;
                font-size: 50px;
                color: white;
                text-shadow: 2px 2px 5px hsl(0, 0%, 61%);
                padding-top: 30px;
            }
            .not-found strong {
                display: inline-block;
                width: 100px;
            }
            .clear{
                float:none;
                clear:both;
            }
            .content{
                text-align:center;
                line-height: 30px;
            }
            input[type=text]{
                border: hsl(247, 89%, 72%) solid 1px;
                outline: none;
                padding: 5px 3px;
                font-size: 16px;
                border-radius: 8px;
            }
            a{
                text-decoration: none;
                color: #9ECDFF;
                text-shadow: 0px 0px 2px white;
            }
            a:hover{
                color:white;
            }

        </style>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>