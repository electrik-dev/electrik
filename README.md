# Electrik

Electrik is a robust, fully-featured open-source starter kit designed to accelerate the development of your next SaaS application. Built on Laravel and enhanced with Livewire, Tailwind CSS, and the custom Electrik Slate UI, it offers a ready-to-use foundation for SaaS platforms with a focus on ease of use and extensibility.


[![CI/CD workflow](https://github.com/electrikhq/electrik/actions/workflows/ci.yml/badge.svg)](https://github.com/electrikhq/electrik/actions/workflows/ci.yml) ![GitHub tag (latest SemVer pre-release)](https://img.shields.io/github/v/tag/electrikhq/electrik?include_prereleases) ![Packagist Downloads](https://img.shields.io/packagist/dt/electrik/electrik)  ![GitHub commit activity](https://img.shields.io/github/commit-activity/m/electrikhq/electrik) ![GitHub](https://img.shields.io/github/license/electrikhq/electrik) 

**IMPORTANT NOTE**

>Since Laravel 11 has been released, I am working on making Electrik compatible with L11.x. Currently, the packages Electrik uses as dependencies; some of them have not released 11x support. Hence, the current version 3.x of Electik is unstable. Till the time this issue is not resolved, I would suggest you either wait for the full 11.x support of use L9.x

<br/>

![Dashboard](art/dashboard.png "Dashboard after succeffsulll installation").

## 🌟 Features
Electrik simplifies SaaS development with these core functionalities:

Team Management: Build applications that support multiple users and teams out of the box.
Subscription Billing: Integrated Stripe support for handling recurring billing.
User Management: Robust user management capabilities to handle different user roles and permissions.
Profile Management: Allow users to manage their profiles effortlessly.
Scalable Dashboard: A minimalistic yet expandable dashboard.
Open Source: Fully open source and free for both personal and commercial use.

## 🚀 Quick Start

Getting started with Electrik is straightforward:

Electrik is meant to be used on a fresh laravel installation. It does not support integration with existing laravel applications. 

To install electrik to your project, use the following steps:

1. Create a fresh laravel application
```bash
composer create-project laravel/laravel <awesome-saas-project> --prefer-dist
```

2. Requiire Electrik via composer
```bash
composer require electrik/electrik
```

3. Install Electrik
```bash
php artisan electrik:install
```

4. Start Artisan
```bash
php artisan serve
```

That's all! Now goto [https://localhost:8000/dashboard](https://localhost:8000/dashboard) and enjoy!


## Why another Starter kit?

It's true that there are a lot of starter kits available for SaaS applications. They all have great features. What saperates Electrik from any other start-kit out there is that its 100% open source. Electrik does not have tired pricing or pro features like almost every other start-kit out there provides and then asks for a premium for this. Electrik will always stay open source and free. Even for commerial usage.

## What's the catch?

There is no catch :)

## 🙏 Sponsors
Special thanks to our sponsors who made this project possible:

* [Netsouls](https://www.studionetsouls.com/)
* [Quick Brown Fox](https://qbf.company)
* [Arkreach](https://arkreach.com)
* [Digital Ocean](https://m.do.co/c/c7b14ea05587)
