# 2bdm

## ABOUT
The offical 2bdm architect's sutdio's website

![wordpress](https://img.shields.io/badge/wordpress-v6.7-0678BE.svg?style=flat-square)
![php](https://img.shields.io/badge/PHP-v8.2-828cb7.svg?style=flat-square)
![Node](https://img.shields.io/badge/node-v18-644D31.svg?style=flat-square)
![composer](https://img.shields.io/badge/composer-v2-126E75.svg?style=flat-square)

# GETTING STARTED

* [Back-end installation](#back-end-install)
* [Front-end installation](#front-end-install)
* [Deployment](#how-to-deploy)
* [Other](#other)


## HOW TO INSTALL THE PROJECT

### BACK-END INSTALL
#### 1.1_ Clone the website project from your directory :
```
git clone git@github.com:Rapkalin/2bdm.git
```

#### 1.2_ Install the backend dependencies form the root directory:
```
composer install
```

#### 1.3_ Copy the .env.sample file, rename it to .env and complete the needed variables:
```
# production / local
_ENV=local

# LOCAL CONFIG
DATABASE_HOST=your-database-host
DATABASE_NAME=your-database-name
DATABASE_USER=your-database-user
DATABASE_PASSWORD=your-database-password

WP_SITEURL=http://2bdm.local/
WP_CONTENT_URL=http://2bdm.local/

# USED FOR DATABASE IMPORT SCRIPTS
PROD_HOST=your-prod-host
PROD_USER=your-prod-user
PROD_SITEURL=your-prod-url
DATABASE_PROD_HOST=your-prod-db-host
DATABASE_PROD_NAME=your-prod-db-name
DATABASE_PROD_USER=your-prod-db-user
DATABASE_PROD_PASSWORD=your-prod-db-password
```

#### 1.5_ Configure your vHost
- ServerName: 2bdm.local
- Directory: your-directory-name/website
```
  <VirtualHost *:80>
    ServerName 2bdm.local
    DocumentRoot "/path/to/your/site/2bdm/website"
    ServerAlias 2bdm.local.*
    <Directory "/path/to/your/site/2bdm/website">
      Options Includes FollowSymLinks
      AllowOverride All
    </Directory>
 </VirtualHost>
```

### FRONT-END INSTALL
- TBD

### HOW TO DEPLOY
To use the auto-deploy using Github Workflows please follow the below instructions:
- Commit and push your branch (feature/xxx)
- Merge your branch (feature/xxx) to develop and push => this will push on preprod env.
```
  git checkout develop
  git merge origin/feature/xxx
  git push
```

- If validated then merge develop into main and push
```
  git checkout main
  git merge origin/develop
  git push
```

- Then create the new tag from main and add a detailed comment (-a)
```
  git tag -a x.x.x
```

- Push the new tag, this will deploy the new tag automatically to prod
```
  git push --tags
```

### OTHER
This directory replace the wordpress-core/wp-content native Wordpress directory.
This is where you will find all the plugins, themes etc:
- W3 Super Cache: this plugin install a few files and directories:
  - cache
  - w3tc-config
  - advanced-cache.php
- Languages: directory that handle the translations of your website. It is created by Wordpress when you configure the default language of your Wordpress website.
- Uploads: contains all the website's media files
- Plugins and themes: where are all the plugins & themes and custom plugins
