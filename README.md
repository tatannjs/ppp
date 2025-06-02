# Portfolio Étudiant BUT Informatique

Ce projet est un portfolio personnel développé dans le cadre du BUT Informatique. Il présente les compétences acquises au cours des trois années de formation, réparties par année, ainsi que des projets, expériences et informations personnelles.

## 🧰 Stack technique

- PHP avec composants Symfony (Routing, HTTP Foundation, etc.)
- Twig (moteur de template)
- Composer (gestionnaire de dépendances)
- CSS personnalisé (Responsive, layout fixe à planètes latérales)

## 🚀 Structure du projet
├── public/ # Point d’entrée (index.php, assets)
├── src/
│ ├── Controller/ # Contrôleurs MVC (ex: StudyController)
│ └── Router/ # Fichier de routes PHP
├── templates/ # Fichiers Twig (views)
│ ├── base.html.twig
│ ├── home.html.twig
│ └── studies.html.twig
├── assets/ # Images, CSS
├── composer.json
└── README.md


## 📦 Installation

1. Clone le dépôt :
   ```bash
   git clone https://github.com/tatannjs/ppp.git
   cd ppp
   ```

2. Installe les dépendances :
    ```bash
    composer install --optimize-autoloader --no-dev
    ```

3. Lance le serveur PHP local :
    ```bash
    php -S localhost:8000 -t public
    ```

4. Accède au site :
    http://localhost:8000

🔒 Sécurité & Confidentialité

Certaines sections du site contiennent des informations personnelles (photos, parcours, etc.).
Ces éléments sont exclus de la licence open source et ne doivent en aucun cas être republiés ou réutilisés.

    Le code est sous licence MIT (voir ci-dessous).

    Le contenu personnel ne peut être réutilisé sans autorisation.

📄 Licence

Ce projet est sous licence MIT.

⚠️ Attention : Les contenus personnels (nom, photos, biographie, etc.) ne sont pas couverts par cette licence.

Voir le fichier LICENSE pour plus d'informations.

© 2025 Ethan EVEILLEAUX – Tous droits réservés.


