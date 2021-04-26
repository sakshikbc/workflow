# Welcome to Automation Workflow!


## Prerequisite
Import SQL To Database and configure the Mysql Settings in app\config.php
```bash
mysql -u username -p database_name < workflow.sql
```


```bash
cd workflowapp
composer install
```

Add below line to crontab -e

```bash
crontab -e
* * * * * /usr/bin/curl --silent --compressed http://localhost:8000/cron.php
```



Add your Gmail Credentials for mail client in cron.php

```php
$mail->Username =  '';  // SMTP username

$mail->Password =  '';  // SMTP password
```

Settings : In your Mail Id Set Security -> Turn on Less Secure App


You are ready to go 
```bash
php -S localhost:8000
```

## Execution Steps

- Navigate to index.php
- Click on New Work Flow button
- Add Name and Description of the Workflow
- Select your trigger ( Message , Call or Appointment )
- Click on Add Row  to insert the conditions .
- Add conditions as per your requirement .
- Click on Submit Button .

Your Workflows and Upcoming events will be displayed at index.php .

Thanks