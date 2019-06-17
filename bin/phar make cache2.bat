@echo off

del "../../../../common/runtime/cache/app/classes_code.php"

php bin phar/make-cache2
pause