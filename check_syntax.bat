@echo off
setlocal enabledelayedexpansion

echo Checking PHP syntax in parallel...

REM Get number of CPU cores
for /f %%i in ('wmic cpu get NumberOfLogicalProcessors /value ^| find "="') do set %%i
set /a NUM_CORES=%NumberOfLogicalProcessors%

REM Find all PHP files excluding vendor and tests, and check syntax
for /f "delims=" %%f in ('dir /b /s *.php ^| findstr /v /c:"vendor\\" /c:"tests\\"') do (
    echo Checking %%f
    php -l "%%f" >nul 2>&1
    if errorlevel 1 (
        echo Syntax error in %%f
        set HAS_ERRORS=1
    )
)

if defined HAS_ERRORS (
    echo Some files have syntax errors.
    exit /b 1
) else (
    echo All PHP files passed syntax check.
    exit /b 0
)
