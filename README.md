### BonoBros

# Installation

1. XAMPP installieren
2. Erstelle eine Datei mit der .php Endung, und lege Sie irgendwo ab
In unserem Fall ist es **creds.php** mit dem absoluten Pfad **C:\xampp\php\creds.php**
Die Datei sollte folgenden Inhalt haben
```php
    <?php 
        define('DB_SERVER', "localhost");
        define('DB_USERNAME', "root");
        define('DB_PASSWORD', "");
        define('DB_NAME', "bonobros");
        define("TIMEOUT_DUR","1800");  // in Sekunden
    ?>
```
3. Öffne die **php.ini** mit dem Pfad **C:\xampp\php\php.ini**
4. Finde folgendende Zeile
```
    auto_prepend_file=
```
4. Füge nun den absoluten Pfad zur zuvor erstellten **creds.php** in Anführungszeichen hinzu
```
    auto_prepend_file="C:\xampp\creds.php"
```
5. Nun kannst du in XAMPP MySQL starten und die SQL Datenbank installieren
[1]: https://github.com/KingSeyfo/BonoBros/blob/main/bonobros.sql "SQL Datenbank Dateil"
6. Das wars! Jetzt kannst noch den Apache Server neustarten und alles sollte klappen