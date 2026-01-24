@echo off
REM Script batch pour créer les gabarits de tâches universitaires
REM Usage: double-cliquer sur ce fichier ou l'exécuter depuis l'invite de commande

echo ========================================
echo Creation des gabarits de taches
echo ========================================
echo.

cd /d "%~dp0"
C:\wamp64\bin\php\php8.2.0\php.exe create_university_task_templates.php

echo.
echo ========================================
echo Appuyez sur une touche pour fermer...
pause >nul
