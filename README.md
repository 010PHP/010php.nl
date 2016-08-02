010PHP.nl Website 
===
The PHP Usergroup of Rotterdam
--
This repository hosts the 010PHP website. This repository is maintained by the 010PHP community. 

Contribution is simple!
==
We'd very much like you to contribute to our awesome community! This can be done in many different ways. Some general guidelines to ensure your contributing is worth your time:

* All outstanding bugs, improvements and feature requests are listed on [**our issue page**](https://github.com/010PHP/010php.nl/issues). Go ahead and find something to work on. Already someone else working on it? No problems, just **collaborate**!
* If you wish to **suggest a feature** you could start by talking it over in our **Slack channel** (010PHP on phpnl.slack.com), go ahead and create a issue asking what others think of it, or just build it and create a PR for it!
* PR, **PR**, PR, **PR**, PR
* Make sure to stick to the PSR guidelines.
* **Create unit tests** where possible, make sure to commit Green Code!

Again, if you are unsure of **ANYTHING**, feel free to **ask** others for help. 

How to contribute
===
We use Symfony, NPM, Bower, Gulp en some other automagically tools. Below is a shot overview on how to use the magic.

 1. Run the vagrant box with `vagrant up` (this will run ansible to provision the vm as well)
 2. Install project dependencies with `composer install`.
 2. Install more project dependencies with `npm install`.
 3. Now uh... install MORE project dependencies `./node_modules/.bin/bower install`.
 4. Now compile the assets. `./node_modules/.bin/gulp` (add `watch` after this command if you want to automagically build your assets during development changes).
 5. Add `192.168.50.20 010php.vm` to your hosts file.
  
Some general guidelines
---
* Code conform PSR2 guidelines.
* Run (and make) unit tests.
* Run PHPMD (still needs implementation...)
* Place static images inside `web/img`.
* Fonts, Javascript and CSS are generated using our `gulpfile.js`.
	* Custom javascript code goes inside `app/Resources/js/app.js`.
	* Custom CSS/LESS code goes inside `app/Resources/less/app.less`.

Last, but not least, please collaborate and make sure to have fun! 
Thank you very much for your help!

[ ![Codeship Status for 010PHP/010php.nl](https://codeship.com/projects/6aafb270-74fc-0133-85a1-52f3970f70f1/status?branch=master)](https://codeship.com/projects/117801)