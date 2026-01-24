@echo off
REM Script batch pour créer les catégories ITIL universitaires par défaut

set PHP_PATH=

REM Essayer les chemins WAMP courants
if exist "C:\wamp64\bin\php\php8.2.0\php.exe" set PHP_PATH=C:\wamp64\bin\php\php8.2.0\php.exe
if exist "C:\wamp64\bin\php\php8.1.0\php.exe" set PHP_PATH=C:\wamp64\bin\php\php8.1.0\php.exe
if exist "C:\wamp64\bin\php\php8.0.0\php.exe" set PHP_PATH=C:\wamp64\bin\php\php8.0.0\php.exe
if exist "C:\wamp64\bin\php\php7.4.33\php.exe" set PHP_PATH=C:\wamp64\bin\php\php7.4.33\php.exe

if "%PHP_PATH%"=="" (
    echo Erreur: PHP n'a pas ete trouve dans les emplacements WAMP standards.
    echo Veuillez modifier ce script pour specifier le chemin vers PHP.exe
    echo Ou accedez au script via votre navigateur: http://localhost/unh_glpi/create_university_itil_categories.php
    pause
    exit /b 1
)

echo Creation des categories ITIL par defaut pour contexte universitaire...
echo.

cd /d "%~dp0"
"%PHP_PATH%" create_university_itil_categories.php

echo.
pause


