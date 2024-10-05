# Laravel Project with Custom Command

This Laravel project includes a custom Artisan command that automates the process of creating a new Laravel project, initializing a Git repository, and installing NPM dependencies.

## Prerequisites

Make sure the following software is installed on your system:

- **PHP** (>= 8.0)
- **Composer** (Dependency manager for PHP)
- **Node.js & NPM** (Node Package Manager)
- **Git** (Version control system)

### Installation of Prerequisites

You can download and install these prerequisites from the following links:

- [PHP](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/)
- [Git](https://git-scm.com/downloads)

---

## Project Overview

This project introduces a custom Artisan command that simplifies the creation of new Laravel projects. The command automates the following tasks:

1. **Creates a new Laravel project** using `composer create-project`.
2. **Initializes a Git repository** in the project folder.
3. **Installs NPM dependencies** if a `package.json` file is found in the newly created project.

### 1. Installing Laravel

First, create a new Laravel project by running the following command in your terminal:

```bash
composer create-project --prefer-dist laravel/laravel <ProjectName>
