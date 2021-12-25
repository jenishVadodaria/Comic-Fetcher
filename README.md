# **XKCD Comic Fetcher** :page_with_curl::repeat::incoming_envelope:

## 📖 Table of Contents

1. [About the Project](#1)
2. [Live Demo ](#2)
3. [Project Overview ](#3)
4. [Built With ](#4)
5. [Project Directory Structure ](#5)
6. [Getting Started ](#6)
7. [What is a Cron job? ](#7)

## :memo: About the Project <a name="1"></a>

This project sends random comics to user through email, for this a user has to subscribe by email id.

A background job (cron job) is used for scheduling the mails. Comic is fetched by making API call to the xkcd url.

XKCD is a webcomic created in 2005 by American author Randall Munroe.

**`LIVE DEMO`** : https://jenishvadodariya08.live <a name="2"></a>

---

## :cloud: Project Overview <a name="3"></a>

&#8594; A user can subscribe with email id from the Homepage of the application. <br />
&#8594; A verification link is sent to the user's mail inbox, this prevents user from entering invalid email id. <br />
&#8594; After successful verification of email id, the user gets subscribed for recieving comics. <br />
&#8594; Now random xkcd comics are sent to user's email , each mail includes an interval of 5 minutes. <br />
&#8594; Emails are sent to user by applying a cron job.[It is a background job for scheduling tasks] <br />
&#8594; User can unsubscribe from the unsubscribe link provided in the mail.

---

## 🛠️ Built With <a name="4"></a>

- `HTML5`

- `CSS3`

- `PHP`

- `MySQL`

---

## 💾 Project Directory Structure <a name="5"></a>

- **`DB`**
  - db.php
- **`cron_job`**
  - xkcd_comic.php
- **`mail`**
  - unsubscribe_user.php
  - valid_user.php
  - verification_mail.php
- **`pages`**
  - homepage.php
  - success_page.php
- **`static\css`**
  - homepage.css
  - success_page.css
- .gitignore

---

## :computer: Getting Started <a name="6"></a>

### &#8594; You need to clone git repository to your local system. For this you will require,

- [VSCode](https://code.visualstudio.com/download "VSCode title") (Not compulsory,can use any other IDE)
- [Git](https://git-scm.com/downloads "Git title")
- [Xampp](https://www.apachefriends.org/download.html "Xampp title")
- [PHP](https://www.php.net/downloads.php "php title")

### &#8594; Install Xampp and start Apache Server and MySQL Server

- For reference : [Xampp Installation](https://www.geeksforgeeks.org/how-to-install-xampp-on-windows/ "Xampp title")

### &#8594; Open Xampp folder in VSCode and go to:

> xampp\htdocs

### &#8594; Type the following command into command line:

```git
git clone https://github.com/rtlearn/php-JenishVadodariya08.git
```

### &#8594; After starting MySQL Server open any browser and go to:

> localhost/phpmyadmin

### &#8594; For Database Connection edit the connection variables in db.php and xkcd_comic.php file:

> Edit: username, servername, password, dbname

### &#8594; Setting Database Table

table name : userdata
userid | email | user_status | subscribed
------- | ------ | ------------ | -----------
varchar | varchar| tinyint(1) | tinyint(1)

### &#8594; Now, for sending mail from localhost we need to edit php.ini and sendmail.ini files.

#### For reference : [Stackoverflow](https://stackoverflow.com/questions/19132171/send-email-from-localhost-running-xammp-in-php-using-gmail-mail-server "Stackoverflow title")

```
auth_username = 'here comes your email id'
auth_password = 'here comes your email id password'
smtp_server = smtp.gmail.com
smtp_port = 25
sendmail_from = 'here comes your email id'
sendmail_path = ""C:\xampp\sendmail\sendmail.exe" -t"
```

## What is Cron Job and how to set it? <a name="7"></a>

#### &#8594; A Cron Job is a Linux command for scheduling a task (command). Cron Jobs allow you to automate specific commands or scripts on your server to complete repetitive tasks automatically.

- [Reference1](https://www.hostinger.in/tutorials/cron-job "Reference1 title")

- [Reference2](https://www.bluehost.com/help/article/cron-job-basics "Reference2 title")

# Thank You!
