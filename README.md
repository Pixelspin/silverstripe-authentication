# Silverstripe Authentication Module

## About
Registration plugin with social logins using the hybridauth library

##Requirements
SilverStripe 3.0.0 or greater

##Installation
```
composer require pixelspin/silverstripe-authentication
```

##Configuring
Info comming soon

##Defining member fields
```
Member:
  hidden_fields:
    - Locale
    - DateFormat
    - TimeFormat
  hidden_fields_registerform:
    - Newsletter
  hidden_fields_accountform:
    - Email
```
    
##Social login
Info comming soon
    
##Spam protection
The register form has spam protection using the spam protection module: https://github.com/silverstripe/silverstripe-spamprotection
Install and configure the spam protection module to enable it.

##Global accessible data
An extension to the sitetree is added with the following methods:
1. AccountPage(); <- Get the account page
2. RegistrationPage(); <- Get the registration page
3. LoginLink(); <- Get the link to the login page
4. LogoutLink(); <- Get the link to logout
5. RemoveAccountLink(); <- Link to remove the logged in users account
6. SocialAuthenticationOptions(); <- Get a list of enabled social authentication options

##Account nav
Include the accountnav template to add a basic account navigation (login, logout, account, register etc)
```
<% include AccountNav %>
```

##Securing pages
you can secure pages by checking the box "logged in members" in the cms or by extending the SecuredPage template

##Would like features
1. More social options like posting to a facebook profile or twitter status updates