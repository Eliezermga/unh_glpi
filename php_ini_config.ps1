$phpini = 'C:\wamp64\bin\php\php8.4.0\php.ini'
$lines = Get-Content $phpini
$modified = $false

# 1. curl.cainfo
for ($i = 0; $i -lt $lines.Count; $i++) {
    if ($lines[$i] -match '^\s*;?curl\.cainfo') {
        $lines[$i] = 'curl.cainfo = "C:/wamp64/bin/php/php8.4.0/extras/ssl/cacert.pem"'
        $modified = $true
        break
    }
}

# 2. openssl.cafile
for ($i = 0; $i -lt $lines.Count; $i++) {
    if ($lines[$i] -match '^\s*;?openssl\.cafile') {
        $lines[$i] = 'openssl.cafile = "C:/wamp64/bin/php/php8.4.0/extras/ssl/cacert.pem"'
        $modified = $true
        break
    }
}

# 3. date.timezone
for ($i = 0; $i -lt $lines.Count; $i++) {
    if ($lines[$i] -match '^\s*;?date\.timezone') {
        $lines[$i] = 'date.timezone = "Africa/Kinshasa"'
        $modified = $true
        break
    }
}

# 4. session.cookie_httponly
for ($i = 0; $i -lt $lines.Count; $i++) {
    if ($lines[$i] -match '^\s*;?session\.cookie_httponly') {
        $lines[$i] = 'session.cookie_httponly = 1'
        $modified = $true
        break
    }
}

Set-Content -Path $phpini -Value $lines -Encoding UTF8
Write-Host "✅ php.ini configured"
