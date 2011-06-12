Smartysh
==============

Smartysh generates HTML from Smarty templates. It does so without loosing the indent in the final output. Smarty includes helper tools like PSD overlay, temple listing and edit links right in the browser ( in the site your're working with )

## Intro

I'm a HTML/CSS expert. About an year ago I was working on 50+ page design ( yes, more than 50 pages of HTML ). This project needed constant changing so I was asked: "Can't I use javascript or something similar to replace that 1 thing repeating on all 50+ pages?" I said: "No, there is no solution. It's static HTML." So I constantly had to replace manually or do search and replace.

One day, seeing StaticMatic, I started building my own system without HAML. So now here it - Smartysh.

## Install ( there's php+apache included for windows )

Download Smartysh, unpack it to c:\www ( for example ), run c:\www\smartysh\servers\server2go\Server2Go.exe and browse to http://127.0.0.1:8080/ or http://YOUR_IP:8080/ Choose example_site and start reading

Smartysh uses 3 types of templates:

1. layout - the outermost template (head, body);
2. page - html that gets wrapped inside layout;
3. partial - template sniplets like youtube, form elements, images (but there's no size limit ofcourse)

I like the image partial. It can take parameters like alt, width, height and ofcourse source. If you omit height and/or with, it outputs img tag with the correct dimensions.

Send me an e-mail for further instructions: hkirsman@gmail.com Just ask anything that's bothering you. We need to create an FAQ.. ;)