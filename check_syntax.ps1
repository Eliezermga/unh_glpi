$files = Get-ChildItem -Recurse -Include *.php | Where-Object { $_.FullName -notmatch 'vendor|tests' }

$jobs = @()

foreach ($file in $files) {
    $jobs += Start-Job -ScriptBlock { param($f) try { php -l $f } catch { "Error in $f" } } -ArgumentList $file.FullName
}

$results = $jobs | Wait-Job | Receive-Job

$errors = $results | Where-Object { $_ -match "Errors parsing" -or $_ -match "Error in" }

if ($errors) {
    Write-Host "Syntax errors found:"
    $errors | ForEach-Object { Write-Host $_ }
    exit 1
} else {
    Write-Host "All PHP files passed syntax check."
    exit 0
}
