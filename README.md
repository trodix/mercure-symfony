Lancement serveur Mercure:
* avec authentification: http://127.0.0.1/book
  
    JWT_KEY='aVerySecretKey' ADDR='localhost:3000' ALLOW_ANONYMOUS=1 CORS_ALLOWED_ORIGINS=127.0.0.1:8000 ./mercure

* sans authentification: client/index.html

    JWT_KEY='aVerySecretKey' ADDR='localhost:3000' ALLOW_ANONYMOUS=1 CORS_ALLOWED_ORIGINS=* ./mercure