@ECHO OFF
START http://localhost:8010
START "" /B cmd /k "cd backend && php -S localhost:1300 -t ."
timeout 1 >NUL
START "" /B cmd /k "cd frontend && npm run serve"
timeout 1 >NUL
echo Server started